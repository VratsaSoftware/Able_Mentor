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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
