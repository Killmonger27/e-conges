<x-adm-layout>
    <div class="main-content container-fluid">
    <div class="page-title">
        <div class="row ">
            <div class="col-12 col-md-6 order-md-1 order-first">
                <h3>Services</h3>
                <p class="text-subtitle text-muted">Vous pouvez consulter et modifier les informations de vos services</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-last d-flex justify-content-end">
                <a href="{{ route('services.create') }}" >
                    <div class="btn btn-success"><i data-feather="plus-circle"></i> Ajouter un service</div>
                </a>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class='table table-striped' id="table1">
                    <thead>
                        <tr>
                            <th>Libellé</th>
                            <th>Description</th>
                            <th>Directeur</th>
                            <th>Actions</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                            <tr>
                                <td>{{$service->libelle}}</td>
                                <td>{{$service->description}}</td>
                                <td>@if ($service->chefService == null)
                                    <span class="badge bg-danger">Directeur non renseigné</span>
                                    @else
                                    {{$service->chefService->prenom}} {{$service->chefService->nom}}
                                    
                                @endif</td>
                                <td class="d-md-flex justify-content-lg-between ">
                                    <a href="#" class="btn btn-warning">Modifier</a>
                                    <a href="#" class="btn btn-danger">Supprimer</a>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
</x-adm-layout>