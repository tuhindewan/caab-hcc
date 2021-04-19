<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    public $table = 'applicants';

    protected $fillable = [
        'nid',
        'mobile',
        'user_id'
    ];
}
