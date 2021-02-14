<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function create(Request $request)
    {
        $record = [
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'email' => $request->get('email')
        ];
        $student = Student::create($record);
        return response()->json($student);
    }

    public function getStudents()
    {
        $students = Student::all();
        // dd($students);
        return response()->json($students);
    }

    public function updateStudent(Request $request)
    {
        $record = [
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'email' => $request->get('email')
        ];

        $id = request()->route()->parameter('id');
        $student = Student::where('id', '=', $id)->update($record);
        return response()->json($student);
    }

    public function deleteStudent()
    {
        $id = request()->route()->parameter('id');
        $student = Student::find($id)->delete();
        return response()->json($student);
    }

    public function studentData()
    {
        $students = Student::select('id','name')->get();
        return response()->json($students);
    }

    // public function addResult() {
    //     $student = 
    // }
}
