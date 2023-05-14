<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articulos=Article::with('user')->orderBy('id','desc')->paginate(10);
        return view('articles.inicio',compact('articulos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $autores=User::select('id','name')->orderBy('name')->get();
        return view('articles.nuevo',compact('autores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo'=>['required','string','min:3','unique:articles,titulo'],
            'contenido'=>['required','string','min:10'],
            'estado'=>['required','in:Publicado,Borrador'],
            'imagen'=>['required','image','max:2048'],
            'user_id'=>['required','exists:users,id']
        ]);
        $imagenFinal=$request->imagen->store('imagenes');
        //Article::create($request->all());
        Article::create([
            'titulo'=>$request->titulo,
            'contenido'=>$request->contenido,
            'estado'=>$request->estado,
            'imagen'=>$imagenFinal,
            'user_id'=>$request->user_id
        ]);
        return redirect()->route('articles.index')->with('info',"Articulo creado exitosamente");
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('articles.detalle',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $autores=User::select('id','name')->orderBy('name')->get();
        return view('articles.editar',compact('article','autores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'titulo'=>['required','string','min:3','unique:articles,titulo,'.$article->id],
            'contenido'=>['required','string','min:10'],
            'estado'=>['required','in:Publicado,Borrador'],
            'imagen'=>['nullable','image','max:2048'],
            'user_id'=>['required','exists:users,id']
        ]);
        $imagenFinal=$article->imagen;
        if(isset($request->imagen)){
            $imagenFinal=$request->imagen->store('imagenes');
            Storage::delete($article->imagen);
        }
        $article->update([
            'titulo'=>$request->titulo,
            'contenido'=>$request->contenido,
            'estado'=>$request->estado,
            'imagen'=>$imagenFinal,
            'user_id'=>$request->user_id
        ]);
        return redirect()->route('articles.index')->with('info',"Articulo modificado exitosamente");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        Storage::delete($article->imagen);
        $article->delete();
        return redirect()->route('articles.index')->with('info',"Articulo borrado exitosamente");
    }
}
