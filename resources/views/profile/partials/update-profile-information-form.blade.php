<div class="card">
            <div class="card-content">
                <div class="card-body">
                    @if (session('status') === 'profile-updated')
                        <div 
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 4000)"
                            class="alert alert-success alert-dismissible fade show" 
                            role="alert"
                        >
                            <strong>{{ __('Success!') }}</strong> {{ __('Votre profil a ete mis a jour avec succès.') }}
                        </div>
                    @endif
                    <form class="form form-horizontal" action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Nom</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Nom" id="first-name-icon" name="nom" value="{{Auth::user()->nom}}" required >
                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('nom')" />
                                            <div class="form-control-icon">
                                                <i data-feather="user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Prenom</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="text" class="form-control" placeholder="Prenom" id="first-name-icon" name="prenom" value="{{Auth::user()->prenom}}" required>
                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('prenom')" />
                                            <div class="form-control-icon">
                                                <i data-feather="user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="email" class="form-control" placeholder="Email" id="first-name-icon" name="email" value="{{Auth::user()->email}}" required>
                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('email')" />
                                            <div class="form-control-icon">
                                                <i data-feather="mail"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Telephone</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="number" class="form-control" placeholder="Telephone" value="{{Auth::user()->telephone}}" required>
                                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('telephone')" />
                                            <div class="form-control-icon">
                                                <i data-feather="phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end ">
                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Mettre à jour</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>