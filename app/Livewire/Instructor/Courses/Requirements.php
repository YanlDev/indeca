<?php

namespace App\Livewire\Instructor\Courses;

use App\Models\Course;
use App\Models\Requirement;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Requirements extends Component
{
    public $course;
    public $requierements;

    #[Validate('required|string|max:255')]
    public $name;

    public function mount()
    {
        $this->requierements = Requirement::where('course_id', $this->course->id)
            ->orderBy('position', 'asc')
            ->get()->toArray();
    }



    public function store()
    {
        $this->validate();

        try {

            $this->course->requirements()->create(['name' => $this->name]);

            $this->requierements = Requirement::where('course_id', $this->course->id)
                ->orderBy('position', 'asc')
                ->get()->toArray();

            $this->reset('name');

            $this->dispatch('refresh-sortable');

            $this->dispatch('banner-success', 'Requerimiento agregada correctamente.');

        } catch (\Exception $e) {

            $this->dispatch('banner-error', 'Error al agregar el requerimiento. Inténtelo de nuevo.');

        }
    }

    public function update()
    {
        $this->validate(['requierements.*.name' => 'required|string|max:255']);

        try {
            foreach ($this->requierements as $requierement) {
                Requirement::find($requierement['id'])->update(['name' => $requierement['name']]);
            }

            $this->dispatch('banner-success', 'Requerimientos actualizadas correctamente.');

        } catch (\Exception $e) {

            $this->dispatch('banner-error', 'Error al actualizar los requerimientos. Inténtelo de nuevo.');
        }
    }

    public function destroy($requirementId)
    {
        try {
            $requirement = Requirement::where('id', $requirementId)
                ->where('course_id', $this->course->id)
                ->first();

            if (!$requirementId) {
                $this->dispatch('banner-error', 'El requerimiento no existe o no pertenece a este curso.');
                return;
            }

            $requirementName = $requirement->name;
            $requirement->delete();

            $this->requierements = Requirement::where('course_id', $this->course->id)
                ->orderBy('position', 'asc')
                ->get()->toArray();

            $this->dispatch('refresh-sortable');
            $this->dispatch('banner-success', "Requerimiento \"{$requirementName}\" eliminado correctamente.");

        } catch (\Exception $e) {
            $this->dispatch('banner-error', 'Error al eliminar la el requerimiento. Inténtelo de nuevo.');
        }
    }

    public function sortRequirements($data)
    {
        try {
            foreach ($data as $index => $requerimentslId) {
                Requirement::find($requerimentslId)->update(['position' => $index + 1]);
            }

            $this->requierements = Requirement::where('course_id', $this->course->id)
                ->orderBy('position', 'asc')
                ->get()->toArray();

        } catch (\Exception $e) {
            $this->dispatch('banner-error', 'Error al actualizar el orden.');
        }
    }

    public function render()
    {
        return view('livewire.instructor.courses.requirements');
    }


}
