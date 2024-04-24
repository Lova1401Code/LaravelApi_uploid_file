<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(){
        $articles = Product::all();
        return response()->json(['article' => $articles], 200);
    }
    public function show($id){
        $article = Product::find($id);
        if ($article) {
            return response()->json(['article' => $article]);
        }else{
            return response()->json(['message' => 'Artilce not found'], 404);
        }
    }

    public function store(Request $request){
        $request->validate([
            'nom' => 'required|max:191',
            'prenom' => 'required|max:191'
        ]); 
        $imageName = str::random(32).".".$request->image->getClientOriginalExtension();
        $produit = new Product();
        $produit->titre = $request->nom;
        $produit->description = $request->prenom;
        $produit->image = $imageName;
        $produit->save();
        Storage::disk('public')->put($imageName, file_get_contents($request->image));
        return response()->json(['message' => 'Prouduit ajouté avec succes'], 200);
    }
    public function update(Request $request, $id){
        // $request->validate([
        //     'titre' => 'required|max:191',
        //     'description' => 'required|max:191'
        // ]); 
        $article = Product::find($id);
        if($article){
            $article->titre = $request->titre;
            $article->description = $request->description;
            if ($request->image) {
                //public storage
                $storage = Storage::disk('public');

                //old image delete
                if ($storage->exists($article->image))
                    $storage->delete($article->image); 

                //image name
                $imageName = str::random(32).".".$request->image->getClientOriginalExtension();
                $article->image = $imageName;

                //image save in public folder
                $storage->put($imageName, file_get_contents($request->image));
            }
            $article->update();
            return response()->json(['message' => "Article modifié"], 200);
        }
        else{
            return response()->json(['message' => 'Article not found'], 404);
        }
        
    }
    public function destroy($id){
        $article = Product::find($id);
        if($article){
            $article->delete();
            return response()->json(['message' => 'article supprime avec success']);
        }
        else{
            return response()->json(['message' => 'Article not found'], 404);
        }
    }
}
