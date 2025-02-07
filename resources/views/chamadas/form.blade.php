@extends('layout')

@section('title', 'Nova Chamada')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Criar Nova Chamada</h1>
    <form action="{{ route('chamadas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Título -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Título</label>
            <input
                type="text"
                name="titulo"
                class="w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Digite o título da chamada"
                required>
        </div>

        <!-- Descrição -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Descrição</label>
            <textarea
                name="descricao"
                class="w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Descreva a chamada"
                required></textarea>
        </div>

        <!-- Setor -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Setor</label>
            <select
                name="setor_id"
                class="w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
                @foreach($setores as $setor)
                <option value="{{ $setor->id }}">{{ $setor->nome }}</option>
                @endforeach
            </select>
        </div>

        <!-- Prioridade -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Prioridade</label>
            <select
                name="prioridade"
                class="w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
                <option value="baixa">Baixa</option>
                <option value="média">Média</option>
                <option value="alta">Alta</option>
            </select>
        </div>

        <!-- Upload de Arquivo -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Anexar Arquivo</label>
            <input
                type="file"
                name="arquivo"
                class="w-full border px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            <p class="text-sm text-gray-500 mt-1">Formatos permitidos: JPG, PNG, PDF (máximo 5MB).</p>
        </div>

        <!-- Botão de Enviar -->
        <button
            type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Criar
        </button>
    </form>
</div>
@endsection