<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}" x-data="{role_id: 2}">
                @csrf

                <div class="form-group">
                    <x-jet-label value="{{ __('DNI') }}" />
                    <x-jet-input class="{{ $errors->has('dni') ? 'is-invalid' : '' }}" type="text" name="dni"
                        :value="old('dni')" required autofocus autocomplete="dni" />
                    <x-jet-input-error for="dni"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('Name') }}" />
                    <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                        :value="old('name')" required autofocus autocomplete="name" />
                    <x-jet-input-error for="name"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('Surname') }}" />
                    <x-jet-input class="{{ $errors->has('surname') ? 'is-invalid' : '' }}" type="text" name="surname"
                        :value="old('surname')" required autofocus autocomplete="surname" />
                    <x-jet-input-error for="surname"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('Email') }}" />
                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                        :value="old('email')" required />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('Address') }}" />
                    <x-jet-input class="{{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address"
                        :value="old('address')" required autofocus autocomplete="address" />
                    <x-jet-input-error for="address"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('City') }}" />
                    <x-jet-input class="{{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city"
                        :value="old('city')" required autofocus autocomplete="city" />
                    <x-jet-input-error for="city"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('Phone') }}" />
                    <x-jet-input class="{{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone"
                        :value="old('phone')" required autofocus autocomplete="phone" />
                    <x-jet-input-error for="phone"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('Password') }}" />
                    <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                        name="password" required autocomplete="new-password" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('Confirm Password') }}" />
                    <x-jet-input class="form-control" type="password" name="password_confirmation" required
                        autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="form-group px-3">
                        <x-jet-label for="terms">
                            <div class="flex items-center">
                                <x-jet-checkbox name="terms" id="terms" />

                                <div class="ml-2 text-sm">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '">' .
                                        __('Terms of Service') . '</a>',
                                    'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '">' .
                                        __('Privacy Policy') . '</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-jet-label>
                    </div>
                @endif

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <a class="text-muted mr-3 text-decoration-none" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                        <x-jet-button>
                            {{ __('Register') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
