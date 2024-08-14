<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory; 
    protected $fillable = ['titulo', 'descripcion', 'fechaPublicacion','idioma','paginas', 'categoria_id'];
    public function categoria()
    {
        return $this->belongsTo(Categoria::class,'categoria_id');
    }
    public function autores()
    {
       
        return $this->belongsToMany(Author::class,'author_libro','libro_id','autor_id');
    }
}
