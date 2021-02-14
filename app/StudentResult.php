<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentResult extends Model
{
    protected $table = "students_results";
    protected $fillable = ['student_id','engineering_technology','scienceFor_technology','ict','final_result'];

    public function student() {
        return $this->belongsTo('App\Student','student_id','id');
    }
}
