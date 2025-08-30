<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Domicilio extends Model
{
    use HasFactory, SoftDeletes;

    //protected $table = 'domicilio';

    protected $fillable = ["persona_id","calle_id","calle_entre_1_id",
                            "calle_entre_2_id","numero","piso","torre",
                            "departamento","otros","codigo_postal"];

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }
    public function calle(): BelongsTo
    {
        return $this->belongsTo(Calle::class);
    }
    public function entreCalle1(): BelongsTo
    {
        return $this->belongsTo(Calle::class,"calle_entre_1_id");
    }
    public function entreCalle2(): BelongsTo
    {
        return $this->belongsTo(Calle::class,"calle_entre_2_id");
    }
    /*
    public function calle() {
        return $this->belongsTo(Calle::class,"id_calle");
    }
    public function calle_entre1() {
        return $this->belongsTo(Calle::class,"id_calle_entre1");
    }
    public function calle_entre2() {
        return $this->belongsTo(Calle::class,"id_calle_entre2");
    }
    public function localidad_asentamiento() {
        return $this->belongsTo(Localidad_Asentamiento::class,"id_localidad_asentamiento");
    }
    public function distrito() {
        return $this->belongsTo(Departamento::class,"id_departamento");
    }
    public function provincia() {
        return $this->belongsTo(Provincia::class,"id_provincia");
    }
    public function pais() {
        return $this->belongsTo(Pais::class,"id_pais");
    }*/

}
