<x-auth-layout>
    <div class="bg-light w-75 mx-auto p-5">
        <div class="">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group w-50 mt-3">
                <label for="email">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>


                {{-- <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="form-control " type="email" name="email" :value="old('email')" required autofocus /> --}}
                {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
            </div>

            <div class="flex items-center justify-end mt-4">
                
                <button type="submit" class="btn btn-primary ">
                                    {{ __('Email Password Reset Link') }}
                                </button>
            </div>
        </form>
    
    </div>
   
</x-auth-layout>
