@extends('layoutsView.appView')
@section('content')
<div class="container">
    <h1 class="my-4">Autores</h1>
    <ul class="list-group">
        @foreach ($libros->autores as $autor)
        <li>{{ $autor->nombre }}</li>
    @endforeach
    </ul>
</div>
@endsection