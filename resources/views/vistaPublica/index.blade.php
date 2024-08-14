@extends('layoutsView.appView')
@section('content')

<div class="header-navbar d-flex justify-content-between" id="mySidebar" >
<li class="nav-item">
                    <a class="nav-link">Categorias</a>
                    <ul class="nav flex-column ms-3">
                        @foreach($categorias as $category)
                            <li class="nav-item">
                                <a class="nav-link" href="/libros/{{$category->id}}">{{ $category->nombre }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
      </div>

      <div class="descubir">
        <h1>"Descubre, lee, aprende: tu biblioteca en la nube"</h1>
        <h2>Busca,guarde y comparte</h2>
       
      </div>
   
    <div class="carrusel">
    <div class="row">
            <div class="col-12">
                <h2>Libros</h2>
            </div>
            @foreach ($libros as $libro)
                <div class="col-md-4 mb-2">
                    <div class="card" style="width: 18rem;">
                        <img src="img/book.jpg"  class="card-img-top" >
                        <div class="card-body">
                            <h5 class="card-title"style= "text-align: left; ">Titulo: {{ $libro->titulo }}</h5>
                            <p class="card-text"style= "text-align: left; ">Descripcion: {{ $libro->descripcion}}</p>
                            <p class="card-text"style= "text-align: left; ">Idioma: {{ $libro->idioma}}</p>
                           
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="row">
            <div class="col-12">
                <h2>Autores</h2>
            </div>
            @foreach ($authors as $author)
                <div class="col-md-4 mb-2">
                    <div class="card" style="width: 18rem;">
                        <img src="img/autor.jpg"  class="card-img-top">
                        <div class="card-body ">
                            <h5 class="card-title"style= "text-align: left; ">Autor: {{ $author->nombre }}</h5>
                            <p class="card-text" style="text-align: left; ">Biografia: {{ $author->biografia }}</p>
                            <p class="card-text" style="text-align: left; ">Nacionalidad: {{ $author->nacionalidad}}</p>
                           
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
   

@endsection






<style>

.header-navbar {
    width: 250px; 
    position: fixed;
    top: 0;
    left: -250px; 
    height: 100%;
     z-index: 1000;
    background-color: #f8f9fa;
    transition: left 0.3s ease;
    padding-top: 45px;
    padding-left:15px;
}
.header-navbar.show {
    left: 0; 
}
.descubir{
  width: 100%; 
  height: 700px; 
  text-align: center;
  color:white;
  justify-content: center;;
  padding-top:250px;
  background-image: url('img/libro.jpg');
  background-size: cover;
  background-position: center; 
  background-repeat: no-repeat; 
 
}


.search{
  border:white;
  border-radius:5px;
  padding: 5px;       
  width: 500px; 
  height:50px;
    
}

.descubir h1{
  
  font-size:80px;
}
.descubir h2 {
  margin-bottom: 20px; 
}

.carrusel{
  width: 100%; 
  height: 500px;
  text-align: center;
  color:black;
  justify-content: center;
 
}

.carrusel h2{
  font-size:50px;
}
#mySidebar{

  background-color:beige;
  
}

#mySidebar a{

color: black;
font-size:25px;

}
#top a{
  color:black;
  font-size: 20px;
}

.autores{
  
  
}
.openbtn {
    z-index: 1001; 
 
}
</style>

