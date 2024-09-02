<!-- Bootstrap 5 CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-primary text-white text-center py-4 rounded-top">
                        <h2>{{ __('Register') }}</h2>
                    </div>
                    <div class="card-body p-5 bg-light">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                            <div class="mb-4">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="form-control mt-2" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="text-danger mt-2" />
                            </div>

                            <!-- Email Address -->
                            <div class="mb-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="form-control mt-2" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" class="form-control mt-2" type="password" name="password" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="text-danger mt-2" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="password_confirmation" class="form-control mt-2" type="password" name="password_confirmation" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger mt-2" />
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a class="text-decoration-none text-sm text-primary hover:text-dark" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>

                                <x-primary-button class="btn btn-primary">
                                    {{ __('Register') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

