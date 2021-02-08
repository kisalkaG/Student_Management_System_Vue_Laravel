<?php

namespace App\Http\Controllers;

use App\StudentFees;
use Illuminate\Http\Request;

class StudentFeeController extends Controller
{
    public function addFee(Request $request) {       
        $record = [
            'student_id' => $request->get('student_id'),
            'month' => $request->get('month'),
            'fees' => $request->get('fee')
        ];
        
        $studentFee = StudentFees::create($record);          
        return response()->json($studentFee);
    }

    public function getStudentFees() {
        $studentFee = StudentFees::all();
        return response()->json($studentFee);
    }

    public function updateStudentFees(Request $request) {
        $record = [
            'student_id' => $request->get('student_id'),
            'month' => $request->get('month'),
            'fees' => $request->get('fee')
        ];

        $id = request()->route()->parameter('id');       
        $student = StudentFees::where('id', '=', $id)->update($record);
        return response()->json($student);
    }

    public function deleteStudentFee() {
        $id = request()->route()->parameter('id'); 
        $student = StudentFees::find($id)->delete();
        return response()->json($student);
    }
}
