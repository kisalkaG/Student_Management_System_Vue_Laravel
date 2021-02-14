<?php

namespace App\Http\Controllers;

use App\StudentResult;
use Illuminate\Http\Request;

class StudentResultController extends Controller
{
    public function addResult(Request $request) {
        $record = [
             'engineering_technology' => $request->get('engineering_technology'),
             'scienceFor_technology' => $request->get('scienceFor_technology'),
             'ict' => $request->get('ict'),
             'final_result' => $request ->get('final_result'),
             'student_id' => $request ->get('student_id')
             
        ];
        $studentResult = StudentResult::create($record);
        return response()->json($studentResult);

    }

    public function getresults() {
        $studentResult = StudentResult::all();
        return response()->json($studentResult);
    }

    public function updateresult(Request $request) {
        $record = [
            'engineering_technology' => $request->get('engineering_technology'),
            'scienceFor_technology' => $request->get('scienceFor_technology'),
            'ict' => $request->get('ict'),
            'final_result' => $request ->get('final_result'),
            'student_id' =>  $request ->get('student_id'),            
        ];

        $id = request()->route()->parameter('id');
        $student = StudentResult::where('id', '=', $id)->update($record);
        return response()->json($student);

    }

    public function deleteresult() {
        $id = request()->route()->parameter('id');
        $student = StudentResult::find($id)->delete();
        return response()->json($student);
    }
}
