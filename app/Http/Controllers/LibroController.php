<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Author;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showLibro($id)
    {
        $categoria = Categoria::with('libros')->find($id);

        if (!$categoria) {
            abort(404, 'Libro no encontrado');
        }
        return view('vistaPublica.showLibro', compact('categoria'));
    }

    public function showAuthors($id)
{
 
    $autor = Author::with('libros')->find($id);

  
    return view('vistaPublica.showAutor', compact('autor'));
}
    public function index()
    {
        $categorias = Categoria::all();
        $authors = Author::all();
        $libros = Libro::all();
        return view('vistaPublica.index', compact('categorias','authors','libros'));
    }
    public function viewIndexAuthor()
    {
        $Authors = Author::all();
        return view('viewAdministrator.createAuthor', compact('Authors'));
    }
    
 
  
    public function storeAuthor(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|max:255',
            'biografia' => 'required|max:255',
            'nacionalidad' => 'required',
        ]);

        Author::create($validatedData);

        return response()->json($validatedData, 201);
    }

    
    
    public function editAuthor(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|max:255',
            'biografia' => 'required|max:255',
            'nacionalidad' => 'required',
        ]);

        $autores = Author::find($id);
        $autores->update($validatedData);

        return response()->json($autores, 200);
    }

    
    
   
    public function deleteAuthor($id)
    {
        $autores = Author::findOrFail($id);
        $autores->delete();
        return response()->json($autores, 200);
    }
    public function viewIndexLibro()
    {
        $libros = Libro::with('categoria')->get();
        $categorias = Categoria::all();
        $author = Author::all();
        return view('viewAdministrator.createLibro', compact('libros', 'categorias', 'author'));
    }
    public function buscarLibroSelect(Request $request){
        try {
            $nombre = $request->input('nombre');
            $author = Author::where('nombre', 'like', '%' . $nombre . '%')
                ->get();
        
            return response()->json($author);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al buscar pacientes: ' . $e->getMessage()], 500);
        }


    }
    public function viewIndexCategory()
    {
        $categorias = Categoria::all();
        return view('viewAdministrator.createCategory', compact('categorias'));
    }

    public function storeCategory(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:255',
        ]);

        Categoria::create($validatedData);

        return response()->json($validatedData, 201);
    }
    public function editCategory(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required|max:255',
           
        ]);

        $categorias = Categoria::find($id);
        $categorias->update($validatedData);

        return response()->json($categorias, 200);
    }

    public function deleteCategory($id)
    {
        $categorias = Categoria::findOrFail($id);
        $categorias->delete();
        return response()->json($categorias, 200);
    }
    public function storeLibro(Request $request)
    {
        // Valida los datos del formulario
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fechaPublicacion' => 'required|date',
            'idioma' => 'required|string',
            'paginas' => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id',
            'autores' => 'array',
            'autores.*' => 'exists:authors,id',
        ]);

        // Crea el nuevo libro
        $libro = Libro::create([
            'titulo' => $request->input('titulo'),
            'descripcion' => $request->input('descripcion'),
            'fechaPublicacion' => $request->input('fechaPublicacion'),
            'idioma' => $request->input('idioma'),
            'paginas' => $request->input('paginas'),
            'categoria_id' => $request->input('categoria_id')
        ]);

        // Asocia los autores seleccionados
        $autores = $request->input('autores', []);
        $libro->autores()->sync($autores);

        return response()->json(['message' => 'Libro creado exitosamente.']);
    }
    public function updateLibro(Request $request, $id)
    {
        // Valida los datos del formulario
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fechaPublicacion' => 'required|date',
            'idioma' => 'required|string',
            'paginas' => 'required|integer',
            'categoria_id' => 'required|exists:categorias,id',
            'autores' => 'array',
            'autores.*' => 'exists:authors,id',
        ]);

        // Encuentra el libro existente
        $libro = Libro::findOrFail($id);

        // Actualiza los datos del libro
        $libro->update([
            'titulo' => $request->input('titulo'),
            'descripcion' => $request->input('descripcion'),
            'fechaPublicacion' => $request->input('fechaPublicacion'),
            'idioma' => $request->input('idioma'),
            'paginas' => $request->input('paginas'),
            'categoria_id' => $request->input('categoria_id')
        ]);
    
        // Sincroniza los autores seleccionados
        $libro->autores()->detach();
        $autores = $request->input('autores', []);
        foreach ($autores as $autor) {
            $libro->autores()->attach($autor);
        }
        return response()->json(['message' => 'Libro actualizado exitosamente.']);
    }

    public function deleteLibro($id)
    {
        $libros= Libro::findOrFail($id);
        $libros->delete();
        return response()->json($libros, 200);
    }
}
