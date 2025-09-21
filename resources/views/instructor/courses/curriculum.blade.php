<x-instructor-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-on-surface-strong dark:text-on-surface-dark-strong leading-tight">
            Curso: {{ $course->title }}
        </h1>
    </x-slot>

    <x-container class="py-6 lg:py-8">
        <x-instructor.course-sidebar :course="$course">
            @livewire('instructor.courses.manage-sections',['course'=>$course],key('manage-sections'.$course->id))
        </x-instructor.course-sidebar>
    </x-container>
</x-instructor-layout>
