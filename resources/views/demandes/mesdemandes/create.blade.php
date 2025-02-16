<x-adm-layout>
    <div class="main-content container-fluid d-flex flex-column align-items-center">
        <!-- Titre de la page -->
        <div class="page-title text-center w-100">
            <div class="row">
                <div class="col-12">
                    <h3>Créer une demande</h3>
                    <p class="text-subtitle text-muted">Remplissez le formulaire ci - dessous pour créer une nouvelle demande.</p>
                </div>
            </div>
        </div>

        <!-- Section du formulaire -->
        <section class="section w-75">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('demandes.store') }}" method="POST">
                        @csrf

                        <!-- Informations de la demande -->
                        <h5 class="card-title text-center">Informations de la demande</h5>
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="Type_de_demande" class="form-label fw-semibold">Type de demande</label>
                                    <select id="Type_de_demande" name="type_de_demande" class="form-control" required>
                                        <option value="" disabled selected>Choisir un type</option>
                                        <option value="conge">Congé</option>
                                        <option value="absence">Absence</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <Label for="motif" class="form-label fw-semibold">Motif de la demande</Label>
                                    <input type="text" name="motif" class="form-control" id="motif" placeholder="Motif de la demande" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label fw-semibold">Action</label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="action" value="planifier">
                                            <label class="form-check-label">Planifier</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="action" value="envoyer" checked>
                                            <label class="form-check-label">Envoyer directement</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="date_de_debut" class="form-label fw-semibold">Date de début</label>
                                        <input type="date" id="date_de_debut" name="date_de_debut" class="form-control" placeholder="Sélectionnez une date">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="date_de_fin" class="form-label fw-semibold">Date de fin</label>
                                        <input type="date" id="date_de_fin" name="date_de_fin" class="form-control" placeholder="Sélectionnez une date">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="row justify-content-center mt-4">
                            <div class="col-md-8 text-center">
                                <button type="submit" class="btn btn-primary mx-2">Enregistrer la demande</button>
                                <a href="{{ route('mesdemandes.index') }}" class="btn btn-secondary mx-2">Retour</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr("#date_de_demande", {
                dateFormat: "Y-m-d",
                minDate: "today",
                locale: "fr"
            });

            flatpickr("#date_de_fin", {
                dateFormat: "Y-m-d",
                minDate: "today",
                locale: "fr"
            });
        });
    </script> --}}
</x-adm-layout>
