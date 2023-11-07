<?php

use function Livewire\Volt\{state};

//

?>

<div id="application-sidebar"
     class="hs-overlay hs-overlay-open:translate-x-0  -translate-x-full transition-all duration-300 transform hidden fixed top-0 left-0 bottom-0 z-[50] hs-overlay-open:z-[80] w-64 bg-white border-r border-gray-200 pt-7 pb-10 overflow-y-auto scrollbar-y lg:block lg:translate-x-0 lg:right-auto lg:bottom-0 dark:scrollbar-y dark:bg-gray-800 dark:border-gray-700">
    <div class="px-6">
        <a class="flex-none text-xl font-semibold dark:text-white" href="#" aria-label="Brand">Starter</a>
    </div>

    <nav class="hs-accordion-group p-6 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
        <ul class="space-y-1.5">

            <x-sidebar-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" wire:navigate>
                <i class="bi bi-house"></i>
                Dashboard
            </x-sidebar-link>

            <x-sidebar-link href="{{ route('users') }}" :active="request()->routeIs('users')" wire:navigate>
                <i class="bi bi-people"></i>
                Users
            </x-sidebar-link>

            <x-sidebar-dropdown id="users-dropdown">
                <x-slot name="parent">
                    <i class="bi bi-hdd-network"></i>
                    Sub Menu
                </x-slot>

                <li>
                    <a href="javascript:;"
                       class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-gray-100 dark:bg-gray-800 dark:text-slate-400 dark:hover:text-slate-300">
                        Menu 1
                    </a>
                </li>
                <x-sidebar-submenu title="Menu 2">
                    <li>
                        <a href="javascript:;"
                           class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-gray-100 dark:bg-gray-800 dark:text-slate-400 dark:hover:text-slate-300">
                            Link 1
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;"
                           class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-gray-100 dark:bg-gray-800 dark:text-slate-400 dark:hover:text-slate-300">
                            Link 2
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-md hover:bg-gray-100 dark:bg-gray-800 dark:text-slate-400 dark:hover:text-slate-300"
                           href="javascript:;">
                            Link 3
                        </a>
                    </li>
                </x-sidebar-submenu>
            </x-sidebar-dropdown>


        </ul>
    </nav>
</div>

