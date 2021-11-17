<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentsController extends Controller
{
    public function index()
    {
    	$students = Student::with('city')->where('is_approved', '=', 1)->get();
        return view('students.list', compact('students'));
    }

    public function show(Student $student)
    {    	
    	$profile = Student::find($student);
    	return view('students.single', compact('student'));
    }

    public function delete(Student $student)
    {    	
    	$profile = Student::find($student);
    	return view('students.delete', compact('student'));
    }

    public function destroy(Student $student)
    {       
        $student = Student::find($student);
        $student->each->delete();
        $students = Student::with('city')->where('is_approved', '=', 1)->get();
        return view('students.list', compact('students'));
    }

    public function update(Student $student)
    {    	
    	$profile = Student::find($student);
    	return view('students.update', compact('student'));
    }
}
