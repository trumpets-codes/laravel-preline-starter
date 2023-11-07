<?php

use function Livewire\Volt\{state, rules, on};

state(['user']);

state(['name', 'email']);


on(['edit-user' => function ($userId) {
    $this->user = \App\Models\User::find($userId)->first();
    $this->name = $this->user->name;
    $this->email = $this->user->email;
    $this->dispatch('open-modal', 'edit-user');
}]);

$update = function() {

    $validated = $this->validate( [
        'name' => 'required',
        'email' => 'required|unique:users,email,' . $this->user->id,
    ]);

    $this->user->update($validated);

    $this->reset();

    $this->dispatch('user-updated');
    $this->dispatch('close-modal', 'edit-user');

    \Masmerise\Toaster\Toaster::success('User updated!');

}

?>

<div>
    <x-modal name="edit-user" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="update" class="p-6">

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Edit User') }}
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


                <div class="flex justify-end">
                    <x-primary-button>Update User</x-primary-button>
                </div>

            </div>

        </form>
    </x-modal>
</div>



