<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Alimento extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'quantidade', 'validade', 'categoria_id'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Scope para validade próxima (7 dias)
    public function scopeValidadeProxima($query, $dias = 7)
    {
        $hoje = Carbon::now();
        $limite = $hoje->copy()->addDays($dias);

        return $query->whereBetween('validade', [$hoje->toDateString(), $limite->toDateString()])
                     ->orderBy('validade', 'asc');
    }

    // Scope para estoque baixo (quantidade < limite)
    public function scopeEstoqueBaixo($query, $limite = 5)
    {
        return $query->where('quantidade', '<', $limite)
                     ->orderBy('quantidade', 'asc');
    }
}
