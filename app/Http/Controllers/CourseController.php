<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Platform;

class CourseController extends Controller
{
    public function show($slug){
        $course = Course::where('slug' , $slug)->with(['platform','topics','series','authors','reviews'])->first();

        //return response()->json($course);
        //dd($course);
        if(empty($course)){
            return abort(404);
        }
        return view('course.single',[
            'course' => $course
        ]);
    }
}
