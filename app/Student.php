<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = ['name','address','email'];
    protected $with = ['studentResult' , 'studentFee'];    

    public function studentFee() {
        return $this->hasOne('App\StudentFee','student_id','id');
         
    }

    public function studentResult() {
        return $this->hasOne('App\StudentResult','student_id','id');
         
    }
}
