<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $dates = ['data'];
    protected $guarded = []; // <-- token que permite que tudo que for enviado pelo post pode ser atualizado
    protected $casts = [
        'itens' => 'array'
    ];

    /* ===== Relationships ===== */

    /**
     * Pega usuario dono do evento
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Pega todos o participantes do evento
     * @return void
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
