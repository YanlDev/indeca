<div>
    <h2 class="text-2xl font-semibold">
        Video promocional
    </h2>
    <hr class="mt-2 mb-6">
    <div class="grid grid-cols-2 gap-6">
        <div class="col-span-1">
            @if($course->video_path)
                <video controls class="aspect-video">
                    <source src="{{\Illuminate\Support\Facades\Storage::url($course->video_path)}}">
                </video>
            @else
                <figure>
                    <img src="{{$course->image}}" alt="{{$course->title}}" class="aspect-video w-full object-cover">
                </figure>
            @endif
        </div>
        <div class="col-span-1">
            <form wire:submit="save">
                <p>Especicaciones del video</p>

                <x-progress-indicator wire:model="video"/>

                <div class="flex justify-end">
                    <button>
                        Subir video
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
