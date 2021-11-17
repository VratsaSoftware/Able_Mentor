<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mentor;
use App\City;
use App\Gender;
use App\ProjectType;
use App\Student;

class MentorsController extends Controller
{
    public function index()
    {
    	$mentors = Mentor::with('city')->where('is_approved', '=', 1)->get();
        return view('mentors.list', compact('mentors'));
    }

    public function show(Mentor $mentor)
    {
        $gender = Gender::find($mentor->gender_id);  
        $city = City::find($mentor->city_id);
        $project_type = ProjectType::find($mentor->project_type_id);
        return view('mentors.single', compact('mentor', 'gender', 'city', 'project_type'));
    }

    public function delete(Mentor $mentor)
    {   
    	return view('mentors.delete', compact('mentor'));
    }

    public function destroy(Mentor $mentor)
    {       
        $mentor = Mentor::find($mentor);
        $mentor->each->delete();
        $mentors = Mentor::with('city')->where('is_approved', '=', 1)->get();
        return view('mentors.list', compact('mentors'));
    }

    public function edit(Mentor $mentor)
    {    
        $cities = City::all();
        $project_types = ProjectType::all();
        return view('mentors.edit', compact('mentor', 'cities', 'project_types'));
    }

    public function update(Request $request, Mentor $mentor){
        $mentor = Mentor::find($request->mentorId);
        $mentor->name = $request->name;
        $mentor->name_second = $request->name_second;
        $mentor->age = $request->age;
        $mentor->email = $request->email;
        $mentor->phone = $request->phone;
        $mentor->season = $request->season;
        $mentor->city_id = $request->city;
        $mentor->work = $request->work;
        $mentor->education = $request->education;
        $mentor->experience = $request->experience;
        $mentor->expertise = $request->expertise;
        $mentor->difficult_situations = $request->difficult_situations;
        $mentor->want_to_change = $request->want_to_change;
        $mentor->hours = $request->hours;
        $mentor->project_type_id = $request->project_type_id;
        $mentor->able_mentor_info = $request->able_mentor_info;
        $mentor->notes = $request->notes;
        $mentor->save();
        $cities = City::all();
        $project_types = ProjectType::all();
        return view('mentors.edit', compact('mentor', 'cities', 'project_types'));
    }

    public function listAllStudents(Mentor $mentor)
    {  
        $students = Student::with('city')->where('is_approved', '=', 1)->get();
        $studentsType = Student::with('city')->where('is_approved', '=', 1)->where('project_type_id', '=', $mentor->project_type_id)->get();
        $tableCode = '';
        $tableCodeType = '';
        foreach ($students as $student) {
            $existsRecord = $student->mentors->contains($mentor['id']);
            $mentorForStudentsCount = $student->mentors->count();
            if ($existsRecord == true){
                $tableCode .= '<tr><td>'. $student['name'] . '</td><td>'. $student['name_second'] . '</td><td>' . $student['city'][0]['name'] . '</td><td>' . $student['class_id'] . '</td><td>' . $mentorForStudentsCount . '</td><td>Свързан</td></tr>'; 
            } else {
                $tableCode .= '<tr><td>'. $student['name'] . '</td><td>'. $student['name_second'] . '</td><td>' . $student['city'][0]['name'] . '</td><td>' . $student['class_id'] . '</td><td>' . $mentorForStudentsCount . '</td><td><a href="../connect-student/' . $mentor['id'] . '/' . $student['id'] . '">Свържи</a></td></tr>'; 
            }            
        }

        foreach ($studentsType as $student) {
            $existsRecord = $student->mentors->contains($mentor['id']);
            $mentorForStudentsCount = $student->mentors->count();
            if ($existsRecord == true){
                $tableCodeType .= '<tr><td>'. $student['name'] . '</td><td>'. $student['name_second'] . '</td><td>' . $student['city'][0]['name'] . '</td><td>' . $student['class_id'] . '</td><td>' . $mentorForStudentsCount . '</td><td>Свързан</td></tr>'; 
            } else {
                $tableCodeType .= '<tr><td>'. $student['name'] . '</td><td>'. $student['name_second'] . '</td><td>' . $student['city'][0]['name'] . '</td><td>' . $student['class_id'] . '</td><td>' . $mentorForStudentsCount . '</td><td><a href="../connect-student/' . $mentor['id'] . '/' . $student['id'] . '">Свържи</a></td></tr>'; 
            }            
        }
        return view('mentors.connect', compact('mentor', 'tableCode', 'tableCodeType'));
    }

    public function connectStudent(Mentor $mentor, Student $student)
    {  
        return view('mentors.student', compact('mentor', 'student'));
    }

    public function confirmConnectStudent(Mentor $mentor, Student $student)
    {  
        $student->mentors()->attach($mentor->id);
        $mentors = Mentor::with('city')->where('is_approved', '=', 1)->get();
        return view('mentors.list', compact('mentors'));
    }
}
