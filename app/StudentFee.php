<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentFee extends Model
{
    protected $table = 'student_fees';
    protected $fillable = ['month','fees','student_id'];

    public function student() {
        return $this->belongsTo('App\Student','sudent_id','id');
    }
}
