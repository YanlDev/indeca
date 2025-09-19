<section>

    <header class="mb-6">
        <h2 class="text-2xl font-semibold text-on-surface dark:text-on-surface-dark">
            Metas del Curso
        </h2>
        <hr class="mt-2 border-outline dark:border-outline-dark">
    </header>

    <ul class="space-y-2">
        @foreach($goals as $index => $goal)
            <li wire:key="goal-{{$goal['id']}}">
                <x-input wire:model="goals.{{$index}}.name" class="w-full"/>
            </li>
        @endforeach
    </ul>

    <div class="flex justify-end">
        <button wire:click="update" class="btn">
            Actualizar
        </button>
    </div>

    <form wire:submit="store">
        <div class="bg-gra-100 rounded-lg shadow-md p-4">
            <x-label class="mb-2">
                Nueva meta
            </x-label>
            <x-input wire:model="name"  class="w-full mb-4" placeholder="Ingrese nombre de la meta" />
            <x-input-error for="name"/>
            <div class="flex justify-end">
                <button class="btn">
                    Agregar meta
                </button>
            </div>
        </div>
    </form>

</section>
