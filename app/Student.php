<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = ['name','address','email'];

    public function studentFees() {
        return $this->hasOne('App\StudentFees','stdent_id','id'); 
    }
}
