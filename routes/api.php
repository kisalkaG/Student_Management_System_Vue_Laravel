<?php

use App\Http\Controllers\StudentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


 Route::post('/create-student',[StudentsController::class,'create']);
 Route::get('/get-all-students',[StudentsController::class,'getStudents']);
 Route::post('/update-student/{id}',[StudentsController::class,'updateStudent']);
 Route::post('/delete-student/{id}',[StudentsController::class,'deleteStudent']);
