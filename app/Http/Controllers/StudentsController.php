<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentsController extends Controller
{
    public function index()
    {
    	$students = Student::where('is_approved', '=', 1)->get();
        return view('students.list', compact('students'));
    }
}
