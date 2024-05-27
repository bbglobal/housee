<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ url('assest/img/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/auth.css') }}">
    <title>Sign Up | Magical Housee</title>
</head>

<body>
    <section id="auth">
        <h1 class="text-center">Sing Up</h1>
        <form method="post" action="{{ route('regitser') }}">
            @csrf
            <div class="form-group my-3">
                <input class="form-control" type="text" name="name" id="username" placeholder="Username"
                    value="{{ old('name') }}">
                <div class="text-warning">
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group my-3">
                <input class="form-control" type="email" name="email" id="email" placeholder="Email"
                    value="{{ old('email') }}">
                <div class="text-warning">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group my-3">
                <input class="form-control" type="text" name="contact" id="contact" placeholder="Contact"
                    value="{{ old('contact') }}">
                <div class="text-warning">
                    @error('contact')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group my-3">
                <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                <div class="text-warning">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group my-3">
                <input class="form-control" type="password" name="confirmPassword" id="confirm-password"
                    placeholder="Confirm Password">
                <div class="text-warning">
                    @error('confirmPassword')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div>
                <button type="submit" class="btn-housee" name="Signup">Sign Up</button>
                <div class="social-logins">
                    <a href="#">
                        <figure>
                            <img src="{{ url('assets/img/facebook.svg') }}" alt="Login with Facebook" width="200px">
                        </figure>
                    </a>
                    <a href="#">
                        <figure>
                            <img src="{{ url('assets/img/google.svg') }}" alt="Login with Google" width="200px">
                        </figure>
                    </a>
                </div>
        </form>
        Already Have an Account? <a href="{{ route('login') }}">Sign In</a>
    </section>
</body>

</html>
