<x-adm-layout>
    <div class="main-content container-fluid">
        <div class="page-title text-center">
            <div class="row">
                <div class="col-12">
                    <h3>Modifier une demande au brouillon</h3>
                    <p class="text-subtitle text-muted">Modifiez les informations de votre demande au brouillon.</p>
                </div>
            </div>
        </div>

        <section class="section d-flex justify-content-center">
            <div class="card w-75">
                <div class="card-body">
                    <form action="{{ route('demandes.update_brouillon', $demande) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="type_de_demande">Type de demande</label>
                            <input type="text" class="form-control" id="type_de_demande" name="type_de_demande" value="{{ $demande->type_de_demande }}" required>
                        </div>

                        <div class="form-group">
                            <label for="motif">Motif</label>
                            <textarea class="form-control" id="motif" name="motif" required>{{ $demande->motif }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="date_de_debut">Date de début</label>
                            <input type="date" class="form-control" id="date_de_debut" name="date_de_debut" value="{{ $demande->date_de_debut }}" required>
                        </div>

                        <div class="form-group">
                            <label for="date_de_fin">Date de fin</label>
                            <input type="date" class="form-control" id="date_de_fin" name="date_de_fin" value="{{ $demande->date_de_fin }}" required>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                            <a href="{{ route('demandes.show_brouillon', $demande) }}" class="btn btn-secondary">Retour</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</x-adm-layout>
