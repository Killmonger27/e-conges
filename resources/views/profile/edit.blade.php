<x-adm-layout>
    <div class=" main-content container-fluid mx-auto">

        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h2>Profile</h2>
                    <p class="text-subtitle text-muted">Vous pouvez consulter et modifier les informations de votre profile</p>
                </div>
            </div>
        </div>

        @include('profile.partials.update-profile-information-form')


        @include('profile.partials.update-password-form')
    </div>
</x-adm-layout>
