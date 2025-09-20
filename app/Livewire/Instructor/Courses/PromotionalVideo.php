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

        /*
         * 🔄 COMPARACIÓN: ANTES vs AHORA
         *
         * ANTES (usando session flash):
         * -----------------------------
         * // Si ya hay un video, eliminar el anterior
         * if ($this->course->video_path) {
         *     \Storage::delete($this->course->video_path);
         * }
         *
         * $this->course->video_path = $this->video->store('courses/promotional-videos');
         * $this->course->save();
         *
         * // Flash session para el banner
         * session()->flash('message', 'Video promocional actualizado con éxito!');
         *
         * return $this->redirectRoute('instructor.courses.video',$this->course, true, true);
         *
         * PROBLEMAS del código anterior:
         * ❌ No maneja errores (¿qué pasa si falla el storage?)
         * ❌ No maneja errores de BD al guardar
         * ❌ Usa session flash en lugar del sistema unificado
         * ❌ Si falla después del redirect, el usuario no ve el error
         */

        try {
            // ✅ MEJORADO: Manejo de errores para eliminación de archivo anterior
            if ($this->course->video_path) {
                try {
                    \Storage::delete($this->course->video_path);
                } catch (\Exception $e) {
                    // Si falla eliminar el archivo anterior, continuamos
                    // pero podríamos loggear el error
                    \Log::warning('Error al eliminar video anterior: ' . $e->getMessage());
                }
            }

            // ✅ MEJORADO: Subida de archivo con manejo de errores
            $videoPath = $this->video->store('courses/promotional-videos');

            if (!$videoPath) {
                throw new \Exception('Error al subir el archivo de video');
            }

            // ✅ MEJORADO: Actualización de BD con manejo de errores
            $this->course->video_path = $videoPath;
            $this->course->save();

            // ✅ NUEVO: Usar dispatch en lugar de session flash
            // Ventajas:
            // - Consistente con el resto de la aplicación
            // - Funciona mejor con Livewire
            // - Más inmediato (no depende de redirects)
            $this->dispatch('banner-success', 'Video promocional actualizado con éxito!');

            // ✅ MEJORADO: Reset del campo para limpiar la interfaz
            $this->reset('video');

            // ✅ OPCIONAL: Si necesitas redirect, puedes usar:
             return $this->redirectRoute('instructor.courses.video', $this->course, true, true);

            // ✅ NUEVO: O si prefieres quedarte en la misma página:
            // (más común para uploads de archivos)

        } catch (\Exception $e) {
            // ✅ NUEVO: Manejo comprehensivo de errores

            // Si algo falló después de subir el archivo, intentamos limpiarlo
            if (isset($videoPath) && $videoPath) {
                try {
                    \Storage::delete($videoPath);
                } catch (\Exception $cleanupError) {
                    \Log::error('Error al limpiar archivo después de fallo: ' . $cleanupError->getMessage());
                }
            }

            // Mostrar error específico según el tipo
            if ($e instanceof \Illuminate\Database\QueryException) {
                $this->dispatch('banner-error', 'Error al guardar en la base de datos. Inténtelo de nuevo.');
            } elseif (str_contains($e->getMessage(), 'storage')) {
                $this->dispatch('banner-error', 'Error al subir el archivo. Verifique el tamaño y formato.');
            } else {
                $this->dispatch('banner-error', 'Error al actualizar el video: ' . $e->getMessage());
            }

            // Log del error para debugging
            \Log::error('Error en PromotionalVideo::save(): ' . $e->getMessage(), [
                'course_id' => $this->course->id,
                'user_id' => auth()->id(),
                'video_size' => $this->video ? $this->video->getSize() : 'unknown'
            ]);
        }
    }

    /*
     * 💡 OPCIONAL: Puedes agregar un método para eliminar video
     */
    public function removeVideo()
    {
        try {
            if ($this->course->video_path) {
                \Storage::delete($this->course->video_path);
                $this->course->video_path = null;
                $this->course->save();

                $this->dispatch('banner-success', 'Video promocional eliminado correctamente.');
            } else {
                $this->dispatch('banner-warning', 'No hay video para eliminar.');
            }
        } catch (\Exception $e) {
            $this->dispatch('banner-error', 'Error al eliminar el video.');
            \Log::error('Error al eliminar video promocional: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.instructor.courses.promotional-video');
    }
}

/*
 * 📚 VENTAJAS DE USAR DISPATCH vs SESSION FLASH:
 * ==============================================
 *
 * 1. 🔄 INMEDIATO:
 *    - dispatch: Aparece inmediatamente
 *    - session: Aparece después del redirect
 *
 * 2. 🎯 CONSISTENCIA:
 *    - dispatch: Mismo sistema que otros componentes
 *    - session: Diferente método, puede confundir
 *
 * 3. 🚀 LIVEWIRE FRIENDLY:
 *    - dispatch: Diseñado para Livewire
 *    - session: Más para controladores tradicionales
 *
 * 4. 🎨 MEJOR UX:
 *    - dispatch: Usuario ve feedback sin cambiar de página
 *    - session: Requiere redirect para ver el mensaje
 *
 * 💡 CUÁNDO USAR CADA UNO:
 * =======================
 *
 * ✅ USA DISPATCH cuando:
 * - Estés en un componente Livewire
 * - Quieras feedback inmediato
 * - No necesites redirect obligatorio
 * - Quieras consistencia con el resto de la app
 *
 * ✅ USA SESSION FLASH cuando:
 * - Estés en controladores tradicionales
 * - Necesites redirect obligatorio
 * - Integres con sistemas legacy
 *
 * 🔄 PATRÓN RECOMENDADO PARA UPLOADS:
 * ==================================
 *
 * try {
 *     // 1. Validar
 *     $this->validate();
 *
 *     // 2. Limpiar archivos anteriores
 *     if ($oldFile) \Storage::delete($oldFile);
 *
 *     // 3. Subir nuevo archivo
 *     $path = $file->store('directory');
 *
 *     // 4. Guardar en BD
 *     $model->update(['file_path' => $path]);
 *
 *     // 5. Limpiar interfaz
 *     $this->reset('file');
 *
 *     // 6. Notificar éxito
 *     $this->dispatch('banner-success', 'Archivo subido!');
 *
 * } catch (\Exception $e) {
 *     // 7. Limpiar archivos si hay error
 *     if (isset($path)) \Storage::delete($path);
 *
 *     // 8. Notificar error
 *     $this->dispatch('banner-error', 'Error al subir');
 * }
 */
