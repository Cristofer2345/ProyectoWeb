<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'biografia',
        'nacionalidad',
    ]; 
    public function libros()
    {
        return $this->belongsToMany(Libro::class,'author_libro','autor_id','libro_id');
    }
}
