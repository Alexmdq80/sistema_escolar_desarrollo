<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, AuditableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = "usuario";

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'password',
        'verification_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
       'email_verified_at' => 'datetime',
       'password' => 'hashed',
    ];

    public function markEmailAsVerified()
    {
        $this->forceFill([
            'email_verified_at' => now(),
            'verification_token' => null, // Limpiar el token después de usarlo
        ])->save();
    }

    public function inscripiones(){
        return $this->hasMany(Inscripcion::class,"id_usuario","id");
    }
    public function inscripionesHistorial(){
        return $this->hasMany(Inscripcion_Historial::class,"id_usuario","id");
    }
    public function inscripionesHistorialInfo(){
        return $this->hasMany(Inscripcion_Historial_Info::class,"id_usuario","id");
    }
    public function usuarioEscuelas(){
        return $this->hasMany(Usuario_Escuela::class,"id_usuario","id");
    }
    public function refreshTokens() {
        return $this->hasMany(RefreshToken::class, 'id_usuario', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    /**
     * Get the primary key for the model.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

}
