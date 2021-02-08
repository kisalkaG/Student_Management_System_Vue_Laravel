<?php

namespace App\Http\Controllers;

use App\StudentFees;
use Illuminate\Http\Request;

class StudentFeeController extends Controller
{
    public function addFee(Request $request) {       
        $record = [
            'student_id' => $request->get('id'),
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
}
