
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Styles -->
    <style>
        body {
            background: linear-gradient(135deg, #f0f4f8, #d9e4f5);
            font-family: 'Arial', sans-serif;
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
        }

        .card-header {
            background-color: #4a90e2;
            color: white;
            text-align: center;
            padding: 1.5rem 0;
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .form-control {
            border: none;
            border-radius: 30px;
            background-color: #f7f9fc;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
            border-color: #4a90e2;
        }

        .btn-primary {
            border-radius: 30px;
            background-color: #4a90e2;
            border: none;
            padding: 0.5rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #357ab7;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
        }

        .form-check-input {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #4a90e2;
        }

        .form-check-input:checked {
            background-color: #4a90e2;
            border-color: #4a90e2;
        }

        .text-muted a {
            color: #4a90e2;
            text-decoration: none;
            font-weight: 500;
        }

        .text-muted a:hover {
            color: #357ab7;
            text-decoration: underline;
        }
    </style>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="card shadow-lg" style="max-width: 400px; width: 100%;">
            <div class="card-header">
                {{ __('Login') }}
            </div>
            <div class="card-body p-5">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" class="form-label" />
                        <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')" class="form-label" />
                        <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="text-danger mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="form-check mb-4">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        @if (Route::has('password.request'))
                            <a class="text-muted" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-primary-button class="btn btn-primary">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
