<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    
    /**
     * Afficher la page de création d'un service.
     */
    public function create(){
        return view('services.create');
    }

    /**
     * Afficher la liste de tous les services.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();

        return view('services.index', compact('services'));
    }

    /**
     * Créer un nouveau service.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $service = Service::createService($request->all());
            return redirect()->route('services.index');
        } catch (\InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Afficher un service spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['error' => 'Service non trouvé'], 404);
        }
        return response()->json($service);
    }

    /**
     * Mettre à jour un service spécifique.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['error' => 'Service non trouvé'], 404);
        }
        try {
            $service->updateService($request->all());
            return response()->json($service);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Supprimer un service spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['error' => 'Service non trouvé'], 404);
        }
        $service->delete();
        return response()->json(['message' => 'Service supprimé avec succès']);
    }
}