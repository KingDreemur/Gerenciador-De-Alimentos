@extends('layouts.app')

@section('content')
@if(session('success'))
  <p class="success-message">{{ session('success') }}</p>
@endif

<div class="button-group">
    <a href="{{ route('alimentos.create') }}" class="btn-primary">Novo Alimento</a>
    <a href="{{ route('alimentos.validade_proxima') }}" class="btn-warning">Validade Próxima</a>
    <a href="{{ route('alimentos.estoque_baixo') }}" class="btn-danger">Estoque Baixo</a>
</div>

<ul class="alimentos-list">
  @foreach($alimentos as $alimento)
    <li>
      <div class="alimento-info">
        <strong>{{ $alimento->nome }}</strong> - 
        Quantidade: {{ $alimento->quantidade }} - 
        Validade: {{ $alimento->validade ?? 'Sem validade' }} - 
        Categoria: {{ $alimento->categoria ? $alimento->categoria->nome : 'Sem categoria' }}
      </div>
      <div class="actions">
        <a href="{{ route('alimentos.edit', $alimento) }}" class="btn-edit">Editar</a>
        <form action="{{ route('alimentos.destroy', $alimento) }}" method="POST" style="display:inline;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn-delete">Excluir</button>
        </form>
      </div>
    </li>
  @endforeach
</ul>
@endsection
