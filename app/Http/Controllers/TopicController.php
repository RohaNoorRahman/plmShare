<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;


class TopicController extends Controller
{
    public function index($slug) {
        $topic = Topic::where('slug', $slug)->first();
        $courses = $topic->courses()->latest()->paginate(12);

        //return $topic;

        return view('topic.single', [
            'topic' => $topic,
            'courses' => $courses
        ]);
    }
}
