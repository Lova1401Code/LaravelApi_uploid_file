<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Enseignant extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = 'enseignant';
    protected $fillable = [
    'name',
    'email',
    'password'
   ];
}
