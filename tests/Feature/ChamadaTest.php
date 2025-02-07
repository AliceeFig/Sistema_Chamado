<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Tests\TestCase;
use App\Models\User;
use App\Models\Setor;
use App\Models\Chamada;

class ChamadaTest extends TestCase
{
    use RefreshDatabase;
    

    public function test_usuario_pode_criar_uma_chamada()
    {
        $user = User::factory()->create();
        $setor = Setor::factory()->create();
        $this->actingAs($user instanceof AuthenticatableContract ? $user : User::find($user->id));
    
        $dadosChamada = [
            'titulo' => 'Erro no sistema',
            'descricao' => 'Falha ao carregar a página.',
            'setor_id' => $setor->id,
            'prioridade' => 'alta',
        ];
    
        $response = $this->post(route('chamadas.store'), $dadosChamada);
    
        $response->assertRedirect(route('chamadas.index'));
        $this->assertDatabaseHas('chamadas', $dadosChamada);
    }
    
}
