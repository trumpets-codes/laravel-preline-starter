<?php

use function Livewire\Volt\{state, rules};

state(['name', 'email', 'password']);

rules([
    'name' => 'required',
    'email' => 'required|unique:users,email',
    'password' => 'required|min:8'
]);

$store = function() {
    $validated = $this->validate();

    \App\Models\User::create($validated);

    $this->reset();

    $this->dispatch('user-created');
    $this->dispatch('close-modal', 'add-user');

    \Masmerise\Toaster\Toaster::success('User created!');

}

?>

<div>
    <x-modal name="add-user" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="store" class="p-6">

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Add User') }}
            </h2>

            <div class="mt-4 space-y-4">
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required autocomplete="off" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required  />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input wire:model="password" id="password" name="password" type="password" class="mt-1 block w-full"
                                  required  />
                    <x-input-error class="mt-2" :messages="$errors->get('password')" />
                </div>

                <div class="flex justify-end">
                    <x-primary-button>Create User</x-primary-button>
                </div>

            </div>

        </form>
    </x-modal>
</div>
