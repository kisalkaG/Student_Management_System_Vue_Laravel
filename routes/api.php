<?php

use App\Http\Controllers\StudentsController;
use App\Http\Controllers\StudentFeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Student APIs
 Route::post('/create-student',[StudentsController::class,'create']);
 Route::get('/get-all-students',[StudentsController::class,'getStudents']);
 Route::post('/update-student/{id}',[StudentsController::class,'updateStudent']);
 Route::post('/delete-student/{id}',[StudentsController::class,'deleteStudent']);
 Route::post('/add-results',[StudentsController::class,'addResult']);
 
 //Student Fees APIs
Route::post('/save-student-fee',[StudentFeeController::class,'addFee']);
Route::get('/student-data',[StudentsController::class,'studentData']);
Route::get('/get-all-student-fees',[StudentFeeController::class,'getStudentFees']);
Route::post('/update-student-fee/{id}',[StudentFeeController::class,'updateStudentFees']);
Route::post('/delete-record/{id}',[StudentFeeController::class,'deleteStudentFee']);