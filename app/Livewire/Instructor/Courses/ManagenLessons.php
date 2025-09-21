<?php

namespace App\Livewire\Instructor\Courses;

use Livewire\Component;

class ManagenLessons extends Component
{
    public $section;
    public $lesson;
    public $lessonCreate = [
        'open' => false,
        'name' => null,
        'slug' => null,
        'platform' => 1,
        'video_path' => null,
        'video_original_name' => null,

    ];


    public function render()
    {
        return view('livewire.instructor.courses.managen-lessons');
    }
}
