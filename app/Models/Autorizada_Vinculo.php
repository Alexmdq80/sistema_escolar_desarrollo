<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autorizada_Vinculo extends Model
{
    use HasFactory;

    protected $table = "autorizada_vinculo";

    protected $fillable = ["nombre","orden","vigente"];
}
