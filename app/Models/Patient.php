<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'patients';
    protected $dates = ['deleted_at'];


    public function medical (){
        return $this->hasMany('App\Models\MedicalRecord', 'pasien_id', 'id');
    }

}
