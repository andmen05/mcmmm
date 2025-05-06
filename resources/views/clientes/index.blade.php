@extends('layouts.layout')

@section('content')
    <h1>Clientes</h1>
    <a href="{{ route('clientes.create') }}" class="button">Nuevo cliente</a>
    <ul>
        @foreach($clientes as $cliente)
            <li>{{ $cliente->nombre }} - {{ $cliente->email }}</li>
        @endforeach
    </ul>
@endsection

