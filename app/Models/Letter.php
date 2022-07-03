<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $table = "letters";

    protected $fillable = [
        'name', 'typeletter', 'description', 'file', 'cover', 'category_id', 'user_id'
    ];
}
