<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;
    protected $table = 'medical_record';
    protected $fillable = [
        'pasien_id',
        'obat_id',
        'obat_id2',
        'obat_id3',
        'obat_id4',
        'obat_id5',
        'jumlah_dipakai',
        'jumlah_dipakai2',
        'jumlah_dipakai3',
        'jumlah_dipakai4',
        'jumlah_dipakai5',
        'diagnosa',
        'keluhan'
    ];

    public function pasien() {
        return $this->belongsTo('App\Models\Patient', 'pasien_id', 'id');
    }
    
}
