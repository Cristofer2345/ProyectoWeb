<?php

use App\Http\Controllers\homeController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\ProfileController;
use App\Models\Author;
use App\Models\Categoria;
use App\Models\Libro;
use Illuminate\Support\Facades\Route;

Route::get('/', [LibroController::class, 'index']);
Route::get('/libros/{id}', [LibroController::class, 'showLibro']);
Route::get('/Authors/{id}', [LibroController::class, 'showAuthor']);

Route::get('/dashboard', function () {
    $categorias = Categoria::all();
    $libros = Libro::all();
    $authors = Author::all();
    return view('dashboard', compact('categorias', 'libros', 'authors'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/libro/buscar/search/busqueda/Author',[LibroController::class,'buscarLibroSelect']);
    Route::get('viewAdministrator/homeAdministrator',[homeController::class,'index']);
    Route::get('/createAuthor',[LibroController::class,'viewIndexAuthor']);
    Route::post('/libros/Author/create',[LibroController::class,'storeLibro']);
    Route::post('/Authors/create',[LibroController::class,'storeAuthor']);
    Route::post('/categorias/create',[LibroController::class,'storeCategory']);
    Route::match(['post', 'patch'],'/Authors/edit/{id}',[LibroController::class,'editAuthor']);
    Route::match(['post', 'patch'],'/Libro/edit/{id}', [LibroController::class, 'updateLibro']);
    Route::match(['post', 'patch'],'/categorias/edit/{id}', [LibroController::class, 'editCategory']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/createLibro',[LibroController::class,'viewIndexLibro']);
    Route::get('/createCategory',[LibroController::class,'viewIndexCategory']);
    Route::delete('/libros/delete/{id}',[LibroController::class,'deleteLibro'])->name('libros.delete');;
    Route::delete('/Authors/delete/{id}',[LibroController::class,'deleteAuthor']);
    Route::delete('/categorias/delete/{id}',[LibroController::class,'deleteCategory']);
    
});


require __DIR__.'/auth.php';


