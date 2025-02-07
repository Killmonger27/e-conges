<div class="card">
            <div class="card-content">
                <div class="card-body">
                    @if (session('status') === 'password-updated')
                        <div 
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 4000)"
                            class="alert alert-success alert-dismissible fade show" 
                            role="alert"
                        >
                            <strong>{{ __('Success!') }}</strong> {{ __('Votre mot de passe a ete mis a jour avec succès.') }}
                        </div>
                    @endif

                    <form class="form form-horizontal" method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Mot de passe actuel</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="password" name="current_password" class="form-control" placeholder="Mot de passe actuel">
                                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-danger" />
                                            <div class="form-control-icon">
                                                <i data-feather="lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div> 

                                <div class="col-md-4">
                                    <label>Nouveau mot de passe</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="password" name="password" class="form-control" placeholder="Nouveau MDP">
                                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger" />
                                            <div class="form-control-icon">
                                                <i data-feather="lock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                
                                <div class="col-md-4">
                                    <label>Confirmer le nouveau mot de passe</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmer MDP">
                                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-danger" />
                                            <div class="form-control-icon">
                                                <i data-feather="lock"></i>
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