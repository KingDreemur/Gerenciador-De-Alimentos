<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Alimento extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'quantidade', 'validade'];

    public function scopeValidadeProxima($query, $dias = 7)
    {
        $hoje = Carbon::today();
        $limite = $hoje->copy()->addDays($dias);
        return $query->whereBetween('validade', [$hoje, $limite]);
    }

    public function scopeEstoqueBaixo($query, $limite = 5)
    {
        return $query->where('quantidade', '<', $limite);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
