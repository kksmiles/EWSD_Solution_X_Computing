<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faculty;

class FacultyController extends Controller
{
    public function index(){
        $faculties = Faculty::all();
        return view('faculty.index',compact('faculties'));
    }
}
