@extends('layoutsView.appView')
@section('content')


<div class="container">
<div class="d-flex justify-content-start">
    <a href="javascript:history.back()" class="btn btn-secondary">Atrás</a>
</div>


    <div class="row">
            <div class="col-12">
                <h1>Libros</h2>
            </div>
            @foreach ($categoria->libros as $libro)
                            <div class="col-md-4 mb-2">
                                <div class="card" style="width: 18rem;">
                                <img src="{{ asset('img/biblio.jpg') }}" class="card-img-top">

                                    <div class="card-body">
                                        <h5 class="card-title"style= "text-align: left; ">Titulo: {{ $libro->titulo }}</h5>
                                        <p class="card-text"style= "text-align: left; ">Descripcion: {{ $libro->descripcion}}</p>
                                        <p class="card-text"style= "text-align: left; ">Idioma: {{ $libro->idioma}}</p>
                                    
                                    </div>
                                </div>
                            </div>
            @endforeach
        </div>

    <div class="color2">
    
    </div>
</div>


@endsection

<style>

.container h1{
  
  font-size:80px;
  text-align: center;
}

</style>