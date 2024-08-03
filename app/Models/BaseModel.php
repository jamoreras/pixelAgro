<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BaseModel extends Model
{
    protected static function booted()
    {
        // Aplica el Global Scope para filtrar por idCompany si el modelo extiende de BaseModel
        static::addGlobalScope('company', function (Builder $builder) {
            if (Auth::check() && static::class !== Company::class) {
                $companyId = Auth::user()->idCompany;
                $builder->where('idCompany', $companyId);
            }
        });

        static::creating(function ($model) {
            if (Auth::check() && static::class !== Company::class) {
                $model->idCompany = Auth::user()->idCompany;
            }
        });

        static::updating(function ($model) {
            if (Auth::check() && static::class !== Company::class) {
                $model->idCompany = Auth::user()->idCompany;
            }
        });
    }
}
