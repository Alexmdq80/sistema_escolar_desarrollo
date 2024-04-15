<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidad_Censal extends Model
{
    use HasFactory;

    protected $table = "localidad_censal";

    public $timestamps = false;
}
