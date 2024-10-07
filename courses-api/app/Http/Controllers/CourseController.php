<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Resources\CourseResource;

class CourseController extends Controller
{
    
    public function index()
    {
        $courses = Course::all();
        
        if ($courses->isEmpty()) {
            return response()->json([
                'message' => 'No courses found'
            ], 404);
        }

        return CourseResource::collection($courses);
    }

    public function show($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'message' => 'Course not found'
            ], 404);
        }

        return new CourseResource($course);  
    }


    public function store(Request $request)
{

    \Log::info($request->all());

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required',
        'duration' => 'required|integer',
    ]);

    
    $course = Course::create($validated);

    return new CourseResource($course);
}



    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'message' => 'Course not found'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'duration' => 'sometimes|required|integer',
        ]);

        if (isset($validated['title']) && Course::where('title', $validated['title'])->where('id', '!=', $id)->exists()) {
            return response()->json([
                'message' => 'Another course with this title already exists'
            ], 400);
        }

        $course->update($validated);

        return new CourseResource($course);  
    }

    public function destroy($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'message' => 'Course not found'
            ], 404);
        }

        $course->delete();

        return response()->json([
            'message' => 'Course successfully deleted'
        ], 204);
    }
}
