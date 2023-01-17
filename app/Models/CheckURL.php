<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckURL extends Model
{

    protected $fillable = [
        'id','uid','redirectionurls','ipaddress','time','added_by','date'
];
protected $table = 'checkurl';
}
