@if(count($breadcrumb) > 0)
    <nav class="text-md font-medium text-on-surface dark:text-on-surface-dark" aria-label="breadcrumb">
        <ol class="flex flex-wrap items-center gap-1">
            @foreach($breadcrumb as $item)
                <li>
                    <div class="flex items-center justify-center gap-1">
                        {{-- Ícono: casa para el primero, flecha para los demás --}}
                        @if($loop->first)

                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true"
                                 stroke-width="2" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                            </svg>
                        @endif

                        {{-- Enlace clickeable o texto plano --}}
                        @if(isset($item['url']) && !empty($item['url']) && $item['url'] !== '#')
                            {{-- Enlace clickeable --}}
                            <a href="{{ $item['url'] }}"
                               class="hover:text-on-surface-strong dark:hover:text-on-surface-dark-strong hover:underline transition-colors duration-200">
                                {{ $item['name'] }}
                            </a>
                        @else
                            {{-- Texto no clickeable (página actual) --}}
                            <span class="text-on-surface-strong dark:text-on-surface-dark-strong font-medium">
                                {{ $item['name'] }}
                            </span>
                        @endif
                    </div>
                </li>
            @endforeach
        </ol>
    </nav>
@endif
