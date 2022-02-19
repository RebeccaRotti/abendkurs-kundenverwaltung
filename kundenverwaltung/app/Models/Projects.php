<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $fillable = [
        'title', // string 150
        'description', // text
        'releasedate', // date
        // states_id foreign 
        // companies_id foreign
    ];
}
