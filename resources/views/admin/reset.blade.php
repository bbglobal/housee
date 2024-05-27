<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ url('assest/img/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/auth.css') }}">
    <title>Forgot Password | Magical Housee</title>
</head>

<body>
    <section id="auth">
        <h1 class="text-center">Forgot Password</h1>
        <form method="post" action="{{ route('regitser') }}">
            @csrf

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="form-group my-3">
                <input class="form-control" type="email" name="email" id="email" placeholder="Email"
                    value="{{ old('email') }}">
                <div class="text-warning">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div>
                <button type="submit" class="btn-housee mb-3" name="Signup">Reset Password</button>
        </form>
        Back to Login <a href="">Login</a>
    </section>
</body>

</html>
