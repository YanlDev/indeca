<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Level;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $courses = Course::where('user_id',auth()->id())->get();
        return view('instructor.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $prices = Price::all();
        $levels = Level::all();
        return view('instructor.courses.create', compact('categories', 'prices', 'levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:courses',
            'category_id' => 'required|exists:categories,id',
            'level_id' => 'required|exists:levels,id',
            'price_id' => 'required|exists:prices,id',
        ]);

        $data['user_id'] = auth()->id();

        $course = Course::create($data);

        session()->flash('flash.banner','Curso creado con exito!');

        return redirect()->route('instructor.courses.edit', $course);

    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        if ($course->user_id !== auth()->id()) {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        if ($course->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para editar este curso');
        }
        $categories = Category::all();
        $prices = Price::all();
        $levels = Level::all();
        return view('instructor.courses.edit', compact('course', 'categories', 'prices', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        if ($course->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para modificar este curso');
        }

        $data = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:courses,slug,'.$course->id,
            'summary' => 'nullable|max:1000',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'level_id' => 'required|exists:levels,id',
            'price_id' => 'required|exists:prices,id',
        ]);

        if($request->hasFile('image')){
            if ($course->image_path){
                Storage::delete($course->image_path);
            }

            $data['image_path'] = Storage::put('courses/images', $request->file('image'));

        }

        $course->update($data);

        session()->flash('flash.banner','Curso actualizado con exito!');

        return redirect()->route('instructor.courses.edit', $course);


//        return $request->all();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        if ($course->user_id !== auth()->id()) {
            abort(403);
        }
    }

    public function video(Course $course)
    {
        if ($course->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para acceder a este curso');
        }

        return view('instructor.courses.video', compact('course'));
    }

    public function goals(Course $course)
    {
        return view('instructor.courses.goals', compact('course'));
    }

}
