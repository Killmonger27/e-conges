
    <x-adm-layout>
    <div class="main-content container-fluid">
    <div class="page-title">
        <div class="row ">
            <div class="col-12 col-md-6 order-md-1 order-first">
                <h3>Fonctions</h3>
                <p class="text-subtitle text-muted">Vous pouvez consulter et modifier les informations sur les fonctions</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-last d-flex justify-content-end">
                <a href="{{ route('fonctions.create') }}" >
                    <div class="btn btn-success"><i data-feather="plus-circle"></i> Ajouter une fonction</div>
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
                            <th>Nombre de profils</th>
                            <th>Actions</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fonctions as $fonction )
                            <tr>
                                <td>{{ $fonction->intitule}}</td>
                                <td>{{$fonction->description}}</td>
                                <td> {{$fonction->utilisateurs->count()}} </td>
                                <td class="d-md-flex justify-content-lg-between ">
                                    <a href="{{route('fonctions.edit',$fonction->id)}}" class="btn btn-warning">Modifier</a>
                                    <form action="{{route('fonctions.destroy',$fonction->id)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes vous sûr de vouloir supprimer cette fonction ?')">Supprimer</button>
                                    </form>
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
