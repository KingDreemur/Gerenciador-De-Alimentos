@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Alimentos com Estoque Baixo (menos de 5 unidades)</h2>

        @if($alimentos->isEmpty())
            <p>Nenhum alimento com estoque baixo encontrado.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Validade</th>
                        <th>Categoria</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alimentos as $alimento)
                        <tr>
                            <td>{{ $alimento->nome }}</td>
                            <td>{{ $alimento->quantidade }}</td>
                            <td>{{ \Carbon\Carbon::parse($alimento->validade)->format('d/m/Y') }}</td>
                            <td>{{ $alimento->categoria->nome ?? 'Sem categoria' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{ route('alimentos.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
