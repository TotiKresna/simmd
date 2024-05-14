<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'student_nama',
        'student_kelas',
        'opm_tambah',
        'opm_kurang',
        'opm_kali',
        'opm_bagi',
        'opm_total',
    ];

    // Relasi dengan model Student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
