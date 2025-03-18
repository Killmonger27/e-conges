<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="shortcut icon" href="assets/images/e-sica.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>

    <div id="auth">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <img src="assets/images/logo.jpg" height="150" class='mb-4'>
                                <h3>Se connecter</h3>
                                <p>Renseignez votre email et votre mot de passe pour accéder à e-SICA</p>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group position-relative has-icon-left">
                                    <label for="email">Email</label>
                                    <div class="position-relative">
                                        <input type="email" class="form-control" id="email" name="email"
                                            required>
                                        <x-input-error class=" text-danger" :messages="$errors->get('email')" />
                                        <div class="form-control-icon">
                                            <i data-feather="mail"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <div class="clearfix">
                                        <label for="password">Mot de passe</label>
                                        <a href="{{ route('password.request') }}" class='float-right'>
                                            <small>Mot de passe oublié?</small>
                                        </a>
                                    </div>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="password" name="password"
                                            required>
                                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('password')" />
                                        <div class="form-control-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>

                                    <div class='form-check clearfix my-4'>
                                        <div class="checkbox float-left">
                                            <input type="checkbox" id="checkbox1" class='form-check-input'
                                                name="remember">
                                            <label for="checkbox1">Se souvenir</label>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        <button class="btn btn-primary float-right">Se connecter</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>
