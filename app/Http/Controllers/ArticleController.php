<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // ENDPOINT PÚBLIC 1: Llistar tots els articles
    public function index()
    {
        return response()->json(Article::all(), 200);
    }

    // ENDPOINT PRIVAT 1: Crear un nou article (Protegit amb Token)
    public function store(Request $request)
    {
        $article = Article::create($request->all());
        return response()->json($article, 201);
    }

    // ENDPOINT PÚBLIC 2: Veure un article concret
    public function show($id)
    {
        $article = Article::find($id);
        if (!$article) return response()->json(['m' => 'No trobat'], 404);
        return response()->json($article, 200);
    }

    // ENDPOINT PRIVAT 2: Esborrar un article (Protegit amb Token)
    public function destroy($id)
    {
        $article = Article::find($id); // Primer el busquem

        if (!$article) {
            return response()->json(['m' => 'No trobat, no es pot esborrar'], 404);
        }

        $article->delete(); // L'esborrem si existeix
        return response()->json(['m' => 'Article eliminat'], 200);
    }

}
