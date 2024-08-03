<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'idCompany'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relación con Company
    public function company()
    {
        return $this->belongsTo(Company::class, 'idCompany');
    }

    // Relaciones con otros modelos, si es necesario
    public function programas()
    {
        return $this->hasMany(Programa::class, 'idCompany');
    }

    public function ciclos()
    {
        return $this->hasMany(Ciclo::class, 'idCompany');
    }

    public function productos()
    {
        return $this->hasMany(Producto::class, 'idCompany');
    }

    public function agrupaciones()
    {
        return $this->hasMany(Agrupacion::class, 'idCompany');
    }

    public function lotes()
    {
        return $this->hasMany(Lote::class, 'idCompany');
    }

    public function bodegas()
    {
        return $this->hasMany(Bodega::class, 'idCompany');
    }
}
