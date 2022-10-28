<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    use HasFactory;

    protected $fillable = ['mal_id', 'eng_title', 'jp_title', 'author', 'run_start', 'run_end', 'status'];
}
