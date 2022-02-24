<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'dni' => ['required', 'string', 'max:15', 'unique:users'],
            'name' => ['required', 'string', 'max:50'],
            'surname' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'address' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            'dni' => $input['dni'],
            'name' => $input['name'],
            'surname' => $input['surname'],
            'email' => $input['email'],
            'address' => $input['address'],
            'city' => $input['city'],
            'phone' => $input['phone'],
            'password' => Hash::make($input['password']),
            'role_id' => Role::where('name', '=', 'Client')->first()->id
        ]);
    }
}
