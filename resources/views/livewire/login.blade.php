<div>
    <section id="auth">
        @if ($message = Session::get('success'))
            <div class="text-warning">
                {{ $message }}
            </div>
        @endif
        @if ($message = Session::get('warning'))
            <div class="text-warning">
                {{ $message }}
            </div>
        @endif
        <h1>Login</h1>
        <form wire:submit="login">
            @csrf
            <div class="form-group my-3">
                <input type="number" wire:model="contact" class="form-control" name="contact" id="contact"
                    placeholder="Mobile Number" value="{{ old('contact') }}" title="Enter a valid Indian mobile number">
                <div class="text-danger">
                    @error('contact')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-group my-3">
                <input type="password" wire:model="password" class="form-control" name="password" id="password"
                    placeholder="Password">
                <div class="text-warning">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <div class="form-group my-3">
                    <label for="remember">Remember Me</label>
                    <input type="checkbox" wire:model="remember" name="remember" id="remember">
                </div>
                <div class="form-group my-3">
                    <a href="{{ route('reset.request') }}">Frogot Password</a>
                </div>
            </div>
            <button class="btn-housee" name="login">Login</button>
            <div class="social-logins">
                <a href="{{ route('login.facebook') }}">
                    <figure>
                        <img src="{{ url('assets/img/facebook.svg') }}" alt="Login with Facebook" width="200px">
                    </figure>
                </a>
                <a href="{{ route('login.google') }}">
                    <figure>
                        <img src="{{ url('assets/img/google.svg') }}" alt="Login with Google" width="200px">
                    </figure>
                </a>
            </div>
        </form>
        Didn't Have an Account? <a href="{{ route('signup') }}">Sign Up</a>
    </section>
</div>
