<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Chamada;

class Setor extends Model
{
    use HasFactory;

    protected $table = 'setores';

    protected $fillable = ['nome'];

    public function chamadas()
    {
        return $this->hasMany(Chamada::class);
    }
}
