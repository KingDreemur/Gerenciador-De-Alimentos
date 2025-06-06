@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Alimentos com Validade Próxima (até 7 dias)</h2>

        @if($alimentos->isEmpty())
            <p>Nenhum alimento com validade próxima encontrado.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Validade</th>
                        <th>Quantidade</th>
                        <th>Categoria</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alimentos as $alimento)
                        <tr>
                            <td>{{ $alimento->nome }}</td>
                            <td>{{ \Carbon\Carbon::parse($alimento->validade)->format('d/m/Y') }}</td>
                            <td>{{ $alimento->quantidade }}</td>
                            <td>{{ $alimento->categoria->nome ?? 'Sem categoria' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{ route('alimentos.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
