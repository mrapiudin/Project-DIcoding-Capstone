<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('date', 'desc')->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $articles
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|string|max:255',
            'sub_judul' => 'nullable|string|max:255',
            'isi' => 'required|string',
            'image' => 'nullable|string',
            'tautan' => 'nullable|url',
            'date' => 'required|date'
        ]);

        $article = Article::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Article created successfully',
            'data' => $article
        ], 201);
    }

    public function show($id)
    {
        $article = Article::find($id);
        
        if (!$article) {
            return response()->json([
                'status' => 'error',
                'message' => 'Article not found'
            ], 404);
        }
        
        return response()->json([
            'status' => 'success',
            'data' => $article
        ]);
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        
        if (!$article) {
            return response()->json([
                'status' => 'error',
                'message' => 'Article not found'
            ], 404);
        }

        $this->validate($request, [
            'judul' => 'string|max:255',
            'sub_judul' => 'nullable|string|max:255',
            'isi' => 'string',
            'image' => 'nullable|string',
            'tautan' => 'nullable|url',
            'date' => 'date'
        ]);

        $article->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Article updated successfully',
            'data' => $article
        ]);
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        
        if (!$article) {
            return response()->json([
                'status' => 'error',
                'message' => 'Article not found'
            ], 404);
        }

        $article->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Article deleted successfully'
        ]);
    }
}