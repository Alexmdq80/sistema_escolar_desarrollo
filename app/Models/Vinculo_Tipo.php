<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vinculo_Tipo extends Model
{
    use HasFactory;

    protected $table = "vinculo_tipo";

    protected $fillable = ["nombre","orden","vigente"];
}
