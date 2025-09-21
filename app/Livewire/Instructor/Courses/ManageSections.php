<?php

namespace App\Livewire\Instructor\Courses;

use App\Models\Course;
use App\Models\Section;
use Livewire\Component;

class ManageSections extends Component
{
    public $course;
    public $name;
    public $sections;
    public $sectionEdit = [
        'id' => null,
        'name' => null,
    ];
    public $sectionPositionCreate = [];


    public function mount()
    {
        $this->sections = Section::where('course_id', $this->course->id)
            ->orderBy('position', 'asc')
            ->get();
    }

    public function getSections()
    {
        $this->sections = Section::where('course_id', $this->course->id)
            ->with('lessons')
            ->orderBy('position', 'asc')
            ->get();
    }

    public function store()
    {

        try {
            $this->validate(['name' => 'required|string|max:255']);

            // Verificar que el usuario puede modificar este curso
            if ($this->course->user_id !== auth()->id()) {
                $this->dispatch('banner-error', 'No tienes permiso para modificar este curso.');
                return;
            }

            $this->course->sections()->create([
                'name' => $this->name
            ]);

            $this->getSections();

            $this->dispatch('banner-success', 'Sección agregada correctamente.');
            $this->reset(['name']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Errores de validación se manejan automáticamente por Livewire
            $this->dispatch('banner-error', 'Por favor revisa los datos ingresados.');
        } catch (\Exception $e) {
            $this->dispatch('banner-error', 'Error al agregar la sección. Inténtelo de nuevo.');
            \Log::error('Error al crear sección: ' . $e->getMessage());
        }
    }

    public function storePosition($sectionId)
    {
        $this->validate(["sectionPositionCreate.{$sectionId}.name" => 'required|string|max:255']);

        $section = Section::find($sectionId);
        $position = $section->position;


        Section::where('course_id', $this->course->id)
            ->where('position', '>=', $position)
            ->increment('position');

        $this->course->sections()->create([
            'name' => $this->sectionPositionCreate[$sectionId]['name'],
            'position' => $position
        ]);

        $this->getSections();

        $this->sectionPositionCreate[$sectionId] = [];
        $this->dispatch('close-section-form-' . $sectionId);
        $this->dispatch('banner-success', 'Sección agregada en la posición especificada.');

    }


    /*
     * 🔧 CORREGIDO: Método edit() con validación de autorización
     *
     * ANTES: No verificaba que la sección pertenezca al curso
     * AHORA: Verificación de seguridad agregada
     */
    public function edit(Section $section)
    {
        // Verificar que la sección pertenece al curso actual
        if ($section->course_id !== $this->course->id) {
            $this->dispatch('banner-error', 'Sección no encontrada o no autorizada.');
            return;
        }

        $this->sectionEdit = [
            'id' => $section->id,
            'name' => $section->name
        ];
    }

    public function update()
    {
        try {
            $this->validate(['sectionEdit.name' => 'required|string|max:255']);

            if (!$this->sectionEdit['id']) {
                $this->dispatch('banner-error', 'No hay ninguna sección seleccionada para editar.');
                return;
            }

            $section = Section::where('id', $this->sectionEdit['id'])
                ->where('course_id', $this->course->id)
                ->first();

            if (!$section) {
                $this->dispatch('banner-error', 'Sección no encontrada o no autorizada.');
                $this->reset('sectionEdit');
                return;
            }

            $section->update(['name' => $this->sectionEdit['name']]);

            $this->reset('sectionEdit');

            $this->getSections();

            $this->dispatch('banner-success', 'Sección actualizada correctamente.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('banner-error', 'El nombre de la sección es requerido.');
        } catch (\Exception $e) {
            $this->dispatch('banner-error', 'Error al actualizar la sección. Inténtelo de nuevo.');
            \Log::error('Error al actualizar sección: ' . $e->getMessage());
        }
    }

    public function destroy($sectionId)
    {
        try {
            $sectionId = (int)$sectionId;


            $section = Section::where('id', $sectionId)
                ->where('course_id', $this->course->id)
                ->first();

            if (!$section) {
                $this->dispatch('banner-error', 'Sección no encontrada o no autorizada.');
                return;
            }

            $sectionName = $section->name;
            $sectionPosition = $section->position;

            // Eliminar la sección
            $section->delete();

            // Reorganizar posiciones de las secciones restantes
            Section::where('course_id', $this->course->id)
                ->where('position', '>', $sectionPosition)
                ->decrement('position');

            // Actualizar la lista
            $this->getSections();

            $this->dispatch('banner-success', "Sección \"{$sectionName}\" eliminada correctamente.");

        } catch (\Exception $e) {
            $this->dispatch('banner-error', 'Error al eliminar la sección. Inténtelo de nuevo.');
            \Log::error('Error al eliminar sección: ' . $e->getMessage());
        }
    }

    /*
     * 🆕 NUEVO: Método cancelEdit() para mejor UX
     *
     * FUNCIONALIDAD: Cancelar edición con un método específico
     */
    public function cancelEdit()
    {
        $this->reset('sectionEdit');
        $this->dispatch('banner-info', 'Edición cancelada.');
    }

    public function sortSections($sorts)
    {
        foreach ($sorts as $index => $sectionId) {
            Section::find($sectionId)->update(['position' => $index + 1]);
        }
        $this->getSections();

    }


    public function render()
    {
        return view('livewire.instructor.courses.manage-sections');
    }
}
