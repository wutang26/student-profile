<x-guest-layout>

    <!-- Session Status -->
    @if(session('status'))
        <div class="alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autofocus>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input id="password"
                   type="password"
                   name="password"
                   required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember -->
        <div class="remember">
            <label>
                <input type="checkbox" name="remember">
                Remember me
            </label>
        </div>

        <!-- Actions -->
        <div class="form-actions">

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot">
                    Forgot password?
                </a>
            @endif

            <button type="submit" class="btn-primary">
                Log in
            </button>

        </div>

    </form>

</x-guest-layout>