<?php

namespace App\Http\Controllers;

use App\Models\Fonction;
use Illuminate\Http\Request;

class FonctionController extends Controller
{
    public function create(){
        return view('fonctions.create');
    }

    public function edit($id){
        $fonction = Fonction::find($id);
        return view('fonctions.edit', compact('fonction'));
    }
    /**
     * Afficher la liste de toutes les fonctions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fonctions = Fonction::all();
        return view('fonctions.index', compact('fonctions'));
    }

    /**
     * Créer une nouvelle fonction.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $fonction = Fonction::createFonction($request->all());
            return redirect()->route('fonctions.index')->with('success', 'La fonction a été créée avec succès');
        } catch (\InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Afficher une fonction spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fonction = Fonction::find($id);
        if (!$fonction) {
            return response()->json(['error' => 'Fonction non trouvée'], 404);
        }
        return response()->json($fonction);
    }

    /**
     * Mettre à jour une fonction spécifique.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fonction = Fonction::find($id);
        if (!$fonction) {
            return response()->json(['error' => 'Fonction non trouvée'], 404);
        }
        try {
            $fonction->updateFonction($request->all());
            return redirect()->route('fonctions.index')->with(['message' => 'La fonction a été modifiée avec succès']);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Supprimer une fonction spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fonction = Fonction::find($id);
        if (!$fonction) {
            return response()->json(['error' => 'Fonction non trouvée'], 404);
        }
        $fonction->delete();
        return redirect()->route('fonctions.index')->with(['message' => 'Fonction supprimée avec succès']);
    }
}