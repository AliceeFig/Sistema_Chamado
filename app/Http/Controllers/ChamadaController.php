<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chamada;
use App\Models\Setor;
use Illuminate\Support\Facades\Storage;

class ChamadaController extends Controller
{
    // Exibe a lista de chamadas
    public function index(Request $request)
    {
        $status = $request->get('status', 'pendente'); // Filtro de status
        $query = Chamada::query();

        if (Auth::user()->hasRole('admin')) {
            if ($status !== 'todas') {
                $query->where('status', '!=', 'concluida'); // Filtra não concluídas
            }
        } else {
            $query->where('user_id', Auth::id()); // Apenas chamadas do usuário
        }

        $chamadas = $query->orderBy('created_at', 'desc')->get();

        return view('chamadas.index', compact('chamadas'));
    }

    // Exibe o formulário de criação
    public function create()
    {
        $setores = Setor::all(); // Obtém os setores para o formulário
        return view('chamadas.create', compact('setores'));
    }

    // Salva uma nova chamada
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'setor_id' => 'required|exists:setores,id',
            'prioridade' => 'required|in:alta,media,baixa',
            'arquivo' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $chamada = new Chamada();
        $chamada->titulo = $validatedData['titulo'];
        $chamada->descricao = $validatedData['descricao'];
        $chamada->setor_id = $validatedData['setor_id'];
        $chamada->prioridade = $validatedData['prioridade'];
        $chamada->user_id = Auth::id();
        $chamada->status = 'pendente';

        if ($request->hasFile('arquivo')) {
            $filePath = $request->file('arquivo')->store('chamadas', 'public');
            $chamada->arquivo = $filePath;
        }

        $chamada->save();

        return redirect()->route('chamadas.index')->with('success', 'Chamada criada com sucesso!');
    }


    // Exibe os detalhes de uma chamada
    public function show($id)
    {
        $chamada = Chamada::findOrFail($id); // Encontra a chamada ou retorna 404

        return view('chamadas.show', compact('chamada'));
    }

    // Marca uma chamada como concluída
    public function concluir(Request $request, $id)
    {
        $chamada = Chamada::findOrFail($id);

        // Permite apenas para admin
        if (!Auth::user()->hasRole('admin')) {
            return redirect()->back()->withErrors('Ação não autorizada.');
        }

        $chamada->update(['status' => 'concluida']);

        return redirect()->back()->with('success', 'Chamada marcada como concluída com sucesso!');
    }

    // Exibe o formulário de edição de uma chamada
    public function edit($id)
    {
        // Obtém a chamada ou retorna erro 404
        $chamada = Chamada::findOrFail($id);

        // Verifica se o usuário tem permissão para editar a chamada
        if (Auth::id() !== $chamada->user_id) {
            abort(403, 'Você não tem permissão para editar esta chamada.');
        }

        // Obtém os setores para exibir no formulário
        $setores = Setor::all();

        return view('chamadas.edit', compact('chamada', 'setores'));
    }

    public function update(Request $request, Chamada $chamada)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'arquivo' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Validação para o arquivo
        ]);

        $chamada->titulo = $request->titulo;
        $chamada->descricao = $request->descricao;
        $chamada->setor_id = $request->setor_id;
        $chamada->prioridade = $request->prioridade;

        // Verifica e salva o novo arquivo (se enviado)
        if ($request->hasFile('arquivo')) {
            // Remove o arquivo antigo, se existir
            if ($chamada->arquivo && Storage::disk('public')->exists($chamada->arquivo)) {
                Storage::disk('public')->delete($chamada->arquivo);
            }

            $filePath = $request->file('arquivo')->store('chamadas', 'public');
            $chamada->arquivo = $filePath;
        }

        $chamada->save();

        return redirect()->route('chamadas.index')->with('success', 'Chamada atualizada com sucesso!');
    }


    public function destroy($id)
    {
        // Encontre a chamada pelo ID
        $chamada = Chamada::findOrFail($id);

        // Verifique se o usuário tem permissão para excluir
        if (Auth::id() !== $chamada->user_id) {
            return redirect()->route('chamadas.index')
                ->with('error', __('Você não tem permissão para excluir esta chamada.'));
        }

        // Exclua a chamada
        $chamada->delete();

        // Retorne com uma mensagem de sucesso
        return redirect()->route('chamadas.index')
            ->with('success', __('Chamada excluída com sucesso.'));
    }

    public function visualizarAnexo($id)
    {
        $chamada = Chamada::findOrFail($id);

        if ($chamada->arquivo) {
            return response()->file(storage_path('app/public/' . $chamada->arquivo));
        }

        abort(404, 'Arquivo não encontrado.');
    }

    public function chamadosGraficos()
    {
    // Dados para gráfico de chamados por dia na última semana
    $dias = collect(range(0, 6))->map(function ($i) {
        return Carbon::now()->subDays($i)->format('Y-m-d');
    })->reverse();

    $chamadosPorDia = $dias->mapWithKeys(function ($dia) {
        return [$dia => Chamada::whereDate('created_at', $dia)->count()];
    });

    // Dados para gráfico de chamados por setor
    $chamadosPorSetor = Chamada::join('setores', 'chamadas.setor_id', '=', 'setores.id')
    ->selectRaw('setores.nome as setor, COUNT(*) as total')
    ->groupBy('setores.nome')
    ->pluck('total', 'setor');

    return view('chamadas.graficos', compact('chamadosPorDia', 'chamadosPorSetor'));
    }

}
