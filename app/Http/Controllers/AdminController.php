<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chamada;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    // Exibe a lista de chamadas pendentes
    public function listarChamadas()
    {
        $chamadas = Chamada::where('status', 'pendente')->with('setor', 'user')->get();
        return view('admin.chamadas', compact('chamadas'));
    }

    // Exibe a lista de usuários
    public function index(Request $request)
    {
        $query = User::query();

        // Filtrar por nome
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filtrar por cargo (role)
        if ($request->filled('role') && $request->role !== 'todos') {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        // Ordenar por nome e paginar os resultados
        $usuarios = $query->whereNot('id', auth()->id())->orderBy('name')->paginate(10);

        return view('admin.usuarios.index', compact('usuarios'));
    }




    // Cria um novo usuário
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuário criado com sucesso!');
    }


    // Atualiza o cargo de um usuário
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|string|in:admin,padrao',
        ]);

        $usuario = User::findOrFail($id);
        $usuario->syncRoles([$request->role]); // Supondo que você use o pacote Spatie

        return redirect()->route('admin.usuarios.index')->with('success', 'Papel do usuário atualizado com sucesso!');
    }


    // Valida as informações do usuário
    private function validateUser(Request $request, $isUpdate = false)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                $isUpdate ? Rule::unique('padrao', 'email')->ignore($request->id) : 'unique:padrao,email',
            ],
            'password' => $isUpdate ? 'nullable|string|min:8|confirmed' : 'required|string|min:8|confirmed',
        ];

        $request->validate($rules);
    }

    // Cria um usuário no banco de dados
    private function createUser(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }

    public function create()
    {
        return view('admin.usuarios.create');
    }
}
