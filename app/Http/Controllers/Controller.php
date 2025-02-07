<?php

namespace App\Http\Controllers;

use App\Models\Chamada;

abstract class Controller
{
    public function visualizarAnexo($id)
    {
        $chamada = Chamada::findOrFail($id);

        if ($chamada->arquivo) {
            return response()->file(storage_path('app/public/' . $chamada->arquivo));
        }

        abort(404, 'Arquivo não encontrado.');
    }
}
