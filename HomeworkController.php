<?php

namespace App\Http\Controllers;

use App\Homework;
use App\Http\Resources\Homework as HomeworkResource;
use App\Http\Resources\StudentHomeworkCollection;
use Illuminate\Http\Request;

class UserHomeworkController extends Controller
{
    public function index() {
        return new StudentHomeworkCollection(Homework::all());
    }

    public function store() {

        $data = request()->validate([
           'homework_title' => '',
           'homework_description' => '',
        ]);
//        dd($data);

        $homework = request()->user()->homeworks()->create($data);

        return new HomeworkResource($homework);
    }

}
