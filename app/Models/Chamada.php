<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Setor;

class Chamada extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descricao', 'prioridade', 'setor_id', 'user_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setor()
    {
        return $this->belongsTo(Setor::class, 'setor_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
