<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class URL extends Model
{
    protected $fillable = [
            'id','uid','defaulturl','redirectionurl1','redirectionurl2','added_by','time','createdtime','date'
    ];
    protected $table = 'url';
}
