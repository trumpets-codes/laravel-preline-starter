<?php

use App\Models\User;
use App\Models\Tenant;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state([
    'workspace' => '',
    'name' => '',
    'email' => '',
    'domain' => '',
    'password' => '',
    'password_confirmation' => ''
]);

rules([
    'workspace' => ['required', 'string', 'max:255'],
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
    'domain' => ['required', 'string', 'max:20', 'alpha_num', 'unique:'.Tenant::class.',id',
        'not_in:'.implode(',', config('tenancy.restricted_domains'))],
    'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
])->messages([
    'domain.not_in' => 'This is a restricted keyword. Please try something else.'
]);

$register = function () {
    $validated = $this->validate();

    $validated['password'] = Hash::make($validated['password']);

    $tenant = \App\Models\Tenant::create([
        'id' => $validated['domain'],
        'name' => $validated['workspace'],
    ]);

    $domain = $validated['domain'] . '.' . env('CENTRAL_DOMAIN');

    $tenant->domains()->create(['domain' => $domain]);

    tenancy()->initialize($tenant);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => $validated['password']
    ]);

  //  auth()->guard('master')->attempt(['email' => $data['email'], 'password' => $data['password']]);

    $token = tenancy()->impersonate($tenant, 1, tenant_route($domain, 'dashboard'), 'web')->token;

    return redirect(tenant_route($domain, 'tenant.impersonate', ['token' => $token]));


};

?>

<div class="mb-5">
    <form wire:submit="register">
        <!-- Workspace Name -->
        <div>
            <x-input-label for="name" :value="__('Workspace Name')" />
            <x-text-input wire:model="workspace" id="workspace" class="block mt-1 w-full" type="text" name="workspace" required autofocus autocomplete="company" />
            <x-input-error :messages="$errors->get('workspace')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required  autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="name" :value="__('Workspace Domain')" />
            <x-text-input wire:model="domain" id="domain" class="block mt-1 w-full" type="text" name="domain" required autocomplete="off" />
            <x-input-error :messages="$errors->get('domain')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
