<x-auth-layout>
    <div class="bg-light p-4"> 
        <div>
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>
        <br/>
        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="d-flex m-3">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <button type="submit" class="btn btn-secondary">
                    {{ __('Resend Verification Email') }}
                    </button>
                </div>
            </form>

            <div class="m-3"></div>

            {{-- <a href="/RecipeApp/login" class="btn btn-primary">Login</a> --}}
        </div>
    </div>
</x-auth-layout>
