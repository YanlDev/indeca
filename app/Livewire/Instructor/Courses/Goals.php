<?php

namespace App\Livewire\Instructor\Courses;

use App\Models\Course;
use App\Models\Goal;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Goals extends Component
{
    public $course;

    public $goals;

    #[Validate('required|string|max:255')]
    public $name;

    public function mount(){
        $this->goals = Goal::where('course_id', $this->course->id)
            ->orderBy('position','asc')
            ->get()->toArray();
    }

    public function store()
    {
        $this->validate();

        try {

            $this->course->goals()->create(['name' => $this->name]);
            $this->goals = Goal::where('course_id', $this->course->id)
                ->orderBy('position','asc')
                ->get()->toArray();

            $this->reset('name');

            $this->dispatch('refresh-sortable');

            // ✅ NUEVO: Notificación de éxito al usuario
            // Antes: El usuario no sabía si la acción fue exitosa
            // Ahora: Aparece un banner verde con mensaje de confirmación
            $this->dispatch('banner-success', 'Meta agregada correctamente.');

        } catch (\Exception $e) {
            // ✅ NUEVO: Manejo de errores
            // Si algo falla (BD caída, validación, etc.), mostramos error
            // en lugar de que la aplicación se rompa
            $this->dispatch('banner-error', 'Error al agregar la meta. Inténtelo de nuevo.');

            // 💡 OPCIONAL: También podrías loggear el error para debugging:
            // \Log::error('Error al crear meta: ' . $e->getMessage());
        }
    }

    public function update()
    {
        $this->validate(['goals.*.name' => 'required|string|max:255']);

        /*
         * 🔄 COMPARACIÓN: ANTES vs AHORA
         *
         * ANTES (código original):
         * ------------------------
         * foreach ($this->goals as $goal){
         *     Goal::find($goal['id'])->update(['name' => $goal['name']]);
         * }
         *
         * PROBLEMAS del código anterior:
         * ❌ Si una meta fallaba, las otras no se actualizaban
         * ❌ No había feedback para el usuario
         * ❌ Posibles errores de BD no se manejaban
         */

        try {
            // ✅ MANTENIDO: Misma lógica de actualización (funciona bien)
            foreach ($this->goals as $goal){
                Goal::find($goal['id'])->update(['name' => $goal['name']]);
            }

            // ✅ NUEVO: Notificación de éxito
            $this->dispatch('banner-success', 'Metas actualizadas correctamente.');

        } catch (\Exception $e) {
            // ✅ NUEVO: Si algo falla durante la actualización
            $this->dispatch('banner-error', 'Error al actualizar las metas. Inténtelo de nuevo.');
        }
    }

    public function destroy($goalId)
    {
        try {
            // 🔍 DEBUG: Verificar qué datos tenemos
            \Log::info('Eliminando meta', [
                'goalId' => $goalId,
                'course_id' => $this->course->id,
                'user_id' => auth()->id()
            ]);

            // Verificar que la meta existe
            $goalExists = Goal::find($goalId);
            if (!$goalExists) {
                $this->dispatch('banner-error', 'La meta no existe en la base de datos.');
                return;
            }

            // 🔍 DEBUG: Verificar a qué curso pertenece
            \Log::info('Meta encontrada', [
                'goal_course_id' => $goalExists->course_id,
                'expected_course_id' => $this->course->id,
                'goal_name' => $goalExists->name
            ]);

            // Verificar que pertenece al curso actual
            $goal = Goal::where('id', $goalId)
                ->where('course_id', $this->course->id)
                ->first();

            if (!$goal) {
                $this->dispatch('banner-error', "Meta pertenece al curso {$goalExists->course_id}, no al curso {$this->course->id}");
                return;
            }

            $goalName = $goal->name;
            $goal->delete();

            // Actualizar la lista
            $this->goals = Goal::where('course_id', $this->course->id)
                ->orderBy('position','asc')
                ->get()->toArray();

            $this->dispatch('banner-success', "Meta \"{$goalName}\" eliminada correctamente.");

        } catch (\Exception $e) {
            \Log::error('Error al eliminar meta: ' . $e->getMessage());
            $this->dispatch('banner-error', 'Error al eliminar la meta: ' . $e->getMessage());
        }
    }

    public function sortGoals($data)
    {
        try {
            foreach ($data as $index => $goalId) {
                Goal::find($goalId)->update(['position' => $index + 1]);
            }

            // ✅ Simplemente recargar después de actualizar BD
            $this->goals = Goal::where('course_id', $this->course->id)
                ->orderBy('position','asc')
                ->get()->toArray();

//            $this->dispatch('banner-success', 'Orden actualizado correctamente.');

        } catch (\Exception $e) {
            $this->dispatch('banner-error', 'Error al actualizar el orden.');
        }
    }

    public function render()
    {
        return view('livewire.instructor.courses.goals');
    }
}
