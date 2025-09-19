<?php

namespace App\Livewire\Instructor\Courses;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class PromotionalVideo extends Component
{
    use WithFileUploads;

    public $course;

    #[Validate('required','mimeTypes:video/*')]
    public $video;

    public function save()
    {
        $this->validate();

        // Si ya hay un video, eliminar el anterior
        if ($this->course->video_path) {
            \Storage::delete($this->course->video_path);
        }

        $this->course->video_path = $this->video->store('courses/promotional-videos');
        $this->course->save();

        // Flash session para el banner
        session()->flash('message', 'Video promocional actualizado con éxito!');

        return $this->redirectRoute('instructor.courses.video',$this->course, true, true);

    }

    public function render()
    {
        return view('livewire.instructor.courses.promotional-video');
    }
}
