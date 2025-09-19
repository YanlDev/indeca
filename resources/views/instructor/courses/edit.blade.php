<x-instructor-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-on-surface-strong dark:text-on-surface-dark-strong leading-tight">
            Curso: {{ $course->title }}
        </h1>
    </x-slot>

    <x-container class="py-6 lg:py-8">

        <x-instructor.course-sidebar :course="$course">
            <form action="{{ route('instructor.courses.update', $course) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  novalidate>
                @csrf
                @method('PUT')

                <!-- Información básica -->
                <section class="mb-8">
                    <header class="mb-6">
                        <h2 class="text-xl font-semibold text-on-surface-strong dark:text-on-surface-dark-strong">
                            Información del curso
                        </h2>
                        <div class="mt-2 h-px bg-outline dark:bg-outline-dark"></div>
                    </header>

                    <x-validation-errors class="mb-6"/>

                    <!-- Título del curso -->
                    <div class="mb-6">
                        <x-label for="title"
                                 class="mb-2 block text-sm font-medium text-on-surface-strong dark:text-on-surface-dark-strong">
                            Título del curso
                            <span class="text-red-500 ml-1" aria-label="campo requerido">*</span>
                        </x-label>
                        <x-input
                            id="title"
                            name="title"
                            class="w-full"
                            value="{{ old('title', $course->title) }}"
                            required
                            aria-describedby="title-help"/>
                        <p id="title-help" class="mt-1 text-xs text-on-surface/70 dark:text-on-surface-dark/70">
                            Un título claro y descriptivo ayuda a los estudiantes a encontrar tu curso
                        </p>
                    </div>

                    <!-- Slug del curso (solo si no está publicado) -->
                    @empty($course->published_at)
                        <div class="mb-6">
                            <x-label for="slug"
                                     class="mb-2 block text-sm font-medium text-on-surface-strong dark:text-on-surface-dark-strong">
                                Slug del curso
                                <span class="text-red-500 ml-1" aria-label="campo requerido">*</span>
                            </x-label>
                            <x-input
                                id="slug"
                                name="slug"
                                class="w-full"
                                value="{{ old('slug', $course->slug) }}"
                                required
                                aria-describedby="slug-help"/>
                            <p id="slug-help" class="mt-1 text-xs text-on-surface/70 dark:text-on-surface-dark/70">
                                URL única del curso (no se puede cambiar después de publicar)
                            </p>
                        </div>
                    @endempty

                    <!-- Resumen del curso -->
                    <div class="mb-6">
                        <x-label for="summary"
                                 class="mb-2 block text-sm font-medium text-on-surface-strong dark:text-on-surface-dark-strong">
                            Resumen del curso
                        </x-label>
                        <x-textarea
                            id="summary"
                            name="summary"
                            rows="4"
                            class="w-full"
                            aria-describedby="summary-help">{{ old('summary', $course->summary) }}</x-textarea>
                        <p id="summary-help" class="mt-1 text-xs text-on-surface/70 dark:text-on-surface-dark/70">
                            Resume brevemente de qué trata tu curso y qué aprenderán los estudiantes
                        </p>
                    </div>

                    <!-- Descripción detallada del curso (con CKEditor) -->
                    <div class="mb-6 ckeditor">
                        <x-label for="description"
                                 class="mb-2 block text-sm font-medium text-on-surface-strong dark:text-on-surface-dark-strong">
                            Descripción detallada del curso
                        </x-label>
                        <div class="border border-outline rounded-radius dark:border-outline-dark">
                                                <textarea
                                                    id="description"
                                                    name="description"
                                                    class="w-full min-h-[200px] p-3 border-0 rounded-radius resize-none focus:outline-none"
                                                    aria-describedby="description-help">{{ old('description', $course->description) }}</textarea>
                        </div>
                        <p id="description-help" class="mt-1 text-xs text-on-surface/70 dark:text-on-surface-dark/70">
                            Proporciona una descripción completa del curso, objetivos de aprendizaje, requisitos previos
                            y contenido detallado
                        </p>
                    </div>

                    <!-- Configuración del curso -->
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 sm:gap-6 mb-8">

                        <!-- Categoría -->
                        <div>
                            <x-label for="category_id"
                                     class="mb-2 block text-sm font-medium text-on-surface-strong dark:text-on-surface-dark-strong">
                                Categoría
                                <span class="text-red-500 ml-1" aria-label="campo requerido">*</span>
                            </x-label>
                            <x-select id="category_id" name="category_id" class="w-full" required
                                      aria-describedby="category-help">
                                <option value="">Selecciona una categoría</option>
                                @foreach($categories as $category)
                                    <option
                                        value="{{ $category->id }}" @selected(old('category_id', $course->category_id) == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </x-select>
                            <p id="category-help" class="mt-1 text-xs text-on-surface/70 dark:text-on-surface-dark/70">
                                Clasifica tu curso por tema
                            </p>
                        </div>

                        <!-- Nivel -->
                        <div>
                            <x-label for="level_id"
                                     class="mb-2 block text-sm font-medium text-on-surface-strong dark:text-on-surface-dark-strong">
                                Nivel de dificultad
                                <span class="text-red-500 ml-1" aria-label="campo requerido">*</span>
                            </x-label>
                            <x-select id="level_id" name="level_id" class="w-full" required
                                      aria-describedby="level-help">
                                <option value="">Selecciona el nivel</option>
                                @foreach($levels as $level)
                                    <option
                                        value="{{ $level->id }}" @selected(old('level_id', $course->level_id) == $level->id)>
                                        {{ $level->name }}
                                    </option>
                                @endforeach
                            </x-select>
                            <p id="level-help" class="mt-1 text-xs text-on-surface/70 dark:text-on-surface-dark/70">
                                Indica la dificultad del contenido
                            </p>
                        </div>

                        <!-- Precio -->
                        <div class="md:col-span-2 xl:col-span-1">
                            <x-label for="price_id"
                                     class="mb-2 block text-sm font-medium text-on-surface-strong dark:text-on-surface-dark-strong">
                                Modelo de precio
                                <span class="text-red-500 ml-1" aria-label="campo requerido">*</span>
                            </x-label>
                            <x-select id="price_id" name="price_id" class="w-full" required
                                      aria-describedby="price-help">
                                <option value="">Selecciona el precio</option>
                                @foreach($prices as $price)
                                    <option
                                        value="{{ $price->id }}" @selected(old('price_id', $course->price_id) == $price->id)>
                                        @if($price->value == 0)
                                            Gratis
                                        @else
                                            ${{ number_format($price->value, 2) }} USD - (Nivel {{ $loop->iteration }})
                                        @endif
                                    </option>
                                @endforeach
                            </x-select>
                            <p id="price-help" class="mt-1 text-xs text-on-surface/70 dark:text-on-surface-dark/70">
                                Define si el curso será gratuito o de pago
                            </p>
                        </div>

                    </div>
                </section>

                <!-- Imagen del curso -->
                <section class="mb-8">
                    <header class="mb-6">
                        <h2 class="text-xl font-semibold text-on-surface-strong dark:text-on-surface-dark-strong">
                            Imagen del curso
                        </h2>
                        <div class="mt-2 h-px bg-outline dark:bg-outline-dark"></div>
                    </header>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                        <!-- Vista previa actual -->
                        <div>
                            <h3 class="text-sm font-medium text-on-surface-strong mb-3 dark:text-on-surface-dark-strong">
                                Vista previa actual
                            </h3>
                            <figure
                                class="border border-outline rounded-radius overflow-hidden dark:border-outline-dark">
                                <img class="w-full aspect-video object-cover"
                                     src="{{ $course->image }}"
                                     alt="Imagen actual del curso {{ $course->title }}"
                                     id="imgPreview"
                                >
                            </figure>
                        </div>

                        <!-- Subida de nueva imagen -->
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-sm font-medium text-on-surface-strong mb-3 dark:text-on-surface-dark-strong">
                                    Cambiar imagen
                                </h3>

                                <div
                                    class="bg-surface-alt border-2 border-dashed border-outline rounded-radius p-6 text-center dark:bg-surface-dark-alt dark:border-outline-dark">
                                    <div class="mb-4">
                                        <i class="fas fa-cloud-upload-alt text-2xl text-on-surface/50 dark:text-on-surface-dark/50"
                                           aria-hidden="true"></i>
                                    </div>
                                    <x-label for="image" class="cursor-pointer">
                                                            <span
                                                                class="text-sm font-medium text-primary hover:text-primary/80 dark:text-primary-dark dark:hover:text-primary-dark/80">
                                                                Selecciona una imagen
                                                            </span>
                                        <input type="file"
                                               id="image"
                                               name="image"
                                               accept="image/*"
                                               class="sr-only"
                                               onchange="preview_image(event,'#imgPreview')"
                                               aria-describedby="image-help">
                                    </x-label>
                                    <p class="text-xs text-on-surface/70 mt-1 dark:text-on-surface-dark/70">
                                        o arrastra y suelta aquí
                                    </p>
                                </div>

                                <div id="image-help"
                                     class="mt-3 text-xs text-on-surface/70 space-y-1 dark:text-on-surface-dark/70">
                                    <p><strong>Recomendaciones:</strong></p>
                                    <ul class="list-disc list-inside space-y-1 ml-2">
                                        <li>Formato: JPG, PNG o WebP</li>
                                        <li>Resolución mínima: 1280x720px</li>
                                        <li>Aspecto: 16:9 (recomendado)</li>
                                        <li>Tamaño máximo: 2MB</li>
                                        <li>Imagen clara y atractiva que represente el contenido</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>

                <!-- Botones de acción -->
                <footer
                    class="flex flex-col sm:flex-row justify-between gap-4 pt-6 border-t border-outline dark:border-outline-dark">
                    <a href="{{ route('instructor.courses.index') }}"
                       class="order-2 sm:order-1 inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-on-surface bg-surface-alt border border-outline rounded-radius hover:bg-surface-alt/80 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors duration-200 dark:bg-surface-dark-alt dark:text-on-surface-dark dark:border-outline-dark dark:hover:bg-surface-dark-alt/80">
                        <i class="fas fa-arrow-left mr-2" aria-hidden="true"></i>
                        Volver a la lista
                    </a>

                    <button type="submit"
                            class="order-1 sm:order-2 inline-flex items-center justify-center px-6 py-2 text-sm font-medium bg-primary text-on-primary rounded-radius hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors duration-200 dark:bg-primary-dark dark:text-on-primary-dark dark:hover:bg-primary-dark/90">
                        <i class="fas fa-save mr-2" aria-hidden="true"></i>
                        Guardar cambios
                    </button>
                </footer>

            </form>
        </x-instructor.course-sidebar>

    </x-container>

    @push('js')
        <script type="importmap">
            {
                "imports": {
                    "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.js",
                    "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.3.1/"
                }
            }
        </script>

        <script type="module">
            import {
                ClassicEditor,
                Essentials,
                Bold,
                Italic,
                Font,
                Paragraph,
                Heading,
                List,
                Link,
                BlockQuote,
                Table,
                MediaEmbed,
                PasteFromOffice,
                Alignment,
                Indent,
                RemoveFormat,
                SourceEditing
            } from 'ckeditor5';

            ClassicEditor
                .create(document.querySelector('#description'), {
                    plugins: [
                        Essentials,
                        Bold,
                        Italic,
                        Font,
                        Paragraph,
                        Heading,
                        List,
                        Link,
                        BlockQuote,
                        Table,
                        MediaEmbed,
                        PasteFromOffice,
                        Alignment,
                        Indent,
                        RemoveFormat,
                        SourceEditing
                    ],
                    toolbar: {
                        items: [
                            'heading',
                            '|',
                            'bold',
                            'italic',
                            'fontSize',
                            'fontColor',
                            'fontBackgroundColor',
                            '|',
                            'alignment',
                            'numberedList',
                            'bulletedList',
                            '|',
                            'outdent',
                            'indent',
                            '|',
                            'link',
                            'blockQuote',
                            'insertTable',
                            'mediaEmbed',
                            '|',
                            'removeFormat',
                            'sourceEditing',
                            '|',
                            'undo',
                            'redo'
                        ]
                    },
                    heading: {
                        options: [
                            { model: 'paragraph', title: 'Párrafo', class: 'ck-heading_paragraph' },
                            { model: 'heading2', view: 'h2', title: 'Título principal', class: 'ck-heading_heading2' },
                            { model: 'heading3', view: 'h3', title: 'Subtítulo', class: 'ck-heading_heading3' },
                            { model: 'heading4', view: 'h4', title: 'Título menor', class: 'ck-heading_heading4' }
                        ]
                    },
                    fontSize: {
                        options: ['tiny', 'small', 'default', 'big', 'huge']
                    },
                    link: {
                        decorators: {
                            openInNewTab: {
                                mode: 'manual',
                                label: 'Abrir en nueva pestaña',
                                attributes: {
                                    target: '_blank',
                                    rel: 'noopener noreferrer'
                                }
                            }
                        }
                    },
                    table: {
                        contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                    },
                    language: 'es',
                    placeholder: 'Escribe aquí la descripción completa de tu curso...'
                })
                .then(editor => {

                    // Validación del formulario
                    const form = document.querySelector('form');
                    if (form) {
                        form.addEventListener('submit', function(e) {
                            const content = editor.getData();
                            if (content.trim() === '') {
                                e.preventDefault();
                                alert('Por favor, completa la descripción del curso.');
                                editor.ui.view.editable.element.focus();
                                return false;
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error al inicializar CKEditor:', error);
                });
        </script>

        <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.css">
    @endpush
</x-instructor-layout>
