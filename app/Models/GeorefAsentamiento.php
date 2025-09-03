<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GeorefAsentamiento extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["id_georef","departamento_id",
                            "municipio_id", "localidad_censal_id",
                            "georef_fuente_id", "georef_categoria_id",
                            "nombre","centroide_lat","centroide_lon"];

    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class);
    }
    public function municipio(): BelongsTo
    {
        return $this->belongsTo(Municipio::class);
    }
    public function localidadCensal(): BelongsTo
    {
        return $this->belongsTo(LocalidadCensal::class);
    }
    public function georefCategoria(): BelongsTo
    {
        return $this->belongsTo(GeorefCategoria::class);
    }
    public function georefFuente(): BelongsTo
    {
        return $this->belongsTo(GeorefFuente::class);
    }

}
