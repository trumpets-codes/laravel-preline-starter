<?php

use function Livewire\Volt\{state, mount, on, with, usesPagination, computed};

usesPagination();


$users = computed(function () {
    return \App\Models\User::paginate(5);
});

state(['editing' => null]);

on([
    'user-created' => '$refresh',
    'user-updated' => '$refresh'
]);

$edit = function (\App\Models\User $user) {
    $this->editing = $user;
    $this->dispatch('edit-user', ['userId' => $user->id]);
};

$delete = function (\App\Models\User $user) {
    $user->delete();
};


?>

<div>

    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div
                    class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-slate-900 dark:border-gray-700">
                    <!-- Header -->
                    <div
                        class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-gray-700">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                                Manage Users
                            </h2>

                        </div>

                        <div>
                            <div class="inline-flex gap-x-2">

                                <x-primary-button x-on:click.prevent="$dispatch('open-modal', 'add-user')">
                                    <i class="bi bi-plus-lg me-1"></i>
                                    Add user
                                </x-primary-button>

                            </div>
                        </div>
                    </div>
                    <!-- End Header -->


                    <!-- Table -->
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-slate-800">
                        <tr>
                            <th scope="col" class="pl-6   pr-6 py-3 text-left">
                                <div class="flex items-center gap-x-2">
                                <span
                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                  Name
                                </span>
                                </div>
                            </th>

                            <th scope="col" class="px-6 py-3 text-left">
                                <div class="flex items-center gap-x-2">
                                <span
                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                  Position
                                </span>
                                </div>
                            </th>


                            <th scope="col" class="px-6 py-3 text-left">
                                <div class="flex items-center gap-x-2">
                                <span
                                    class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                 Created
                               </span>
                                </div>
                            </th>

                            <th scope="col" class="px-6 py-3 text-right"></th>
                        </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                        @foreach($this->users as $user)
                            <tr wire:key="{{ $user->id }}">
                                <td class="h-px w-px whitespace-nowrap">
                                    <div class="pl-6  pr-6 py-3">
                                        <div class="flex items-center gap-x-3">
                                            <img class="inline-block h-[2.375rem] w-[2.375rem] rounded-full"
                                                 src="https://i.pravatar.cc/300?u={{$user->email}}"
                                                 alt="Image Description">
                                            <div class="grow">
                                                <span
                                                    class="block text-sm font-semibold text-gray-800 dark:text-gray-200">{{ $user->name }}</span>
                                                <span class="block text-sm text-gray-500">{{ $user->email }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="h-px w-72 whitespace-nowrap">
                                    <div class="px-6 py-3">
                                    <span
                                        class="block text-sm font-semibold text-gray-800 dark:text-gray-200">Director</span>
                                        <span class="block text-sm text-gray-500">Human resources</span>
                                    </div>
                                </td>
                                <td class="h-px w-px whitespace-nowrap">
                                    <div class="px-6 py-3">
                                        <span
                                            class="text-sm text-gray-500">{{ $user->created_at->format('d M, H:i') }}</span>
                                    </div>
                                </td>
                                <td class="h-px w-px whitespace-nowrap">
                                    <div class="px-6 py-1.5">
                                        <x-dropdown>
                                            <x-slot name="trigger">
                                                <button>
                                                    <i class="bi bi-three-dots"></i>
                                                </button>
                                            </x-slot>
                                            <x-slot name="content">
                                                <x-dropdown-link href="#" wire:click.prevent="edit({{$user->id}})">
                                                    <i class="bi bi-pencil-square me-1"></i> {{ __('Edit') }}
                                                </x-dropdown-link>
                                                <x-dropdown-link
                                                    wire:confirm="Are you sure? You want to delete this user?"
                                                    class="text-red-500" href="#"
                                                    wire:click.prevent="delete({{ $user->id }})">
                                                    <i class="bi bi-trash me-1"></i> {{ __('Delete') }}
                                                </x-dropdown-link>
                                            </x-slot>
                                        </x-dropdown>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- End Table -->


                    <!-- Footer -->
                    <div
                        class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-gray-700">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <span
                                        class="font-semibold text-gray-800 dark:text-gray-200">{{ $this->users->total() }}</span>
                                results
                            </p>
                        </div>

                        <div>
                            <div class="inline-flex gap-x-2">
                                @if (!$this->users->onFirstPage())
                                <button type="button" @click="$wire.previousPage"
                                        class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800">
                                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         fill="currentColor" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                              d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                    </svg>
                                    Prev
                                </button>
                                @endif

                                @if($this->users->hasMorePages())
                                    <button type="button" @click="$wire.nextPage"
                                            class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-slate-900 dark:hover:bg-slate-800 dark:border-gray-700 dark:text-gray-400 dark:hover:text-white dark:focus:ring-offset-gray-800">
                                        Next
                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- End Footer -->

                </div>
            </div>
        </div>
    </div>

    <livewire:users.edit/>
</div>
