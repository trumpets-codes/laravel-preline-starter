<x-app-layout page="Dashboard">
    <div class="space-y-5">
        <div class="bg-white border dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                {{ __("You're logged in!") }}
            </div>
        </div>

        <div class="bg-white border dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="py-3 px-6 border-b">
                <p class="font-semibold">What's Included</p>
            </div>

            <div class="px-6 py-3">
                <ul class="space-y-3">
                    <li>1. Laravel Breeze
                        (<a class="text-violet-500" target="_blank"
                            href="https://github.com/laravel/breeze">https://github.com/laravel/breeze</a>)
                    </li>
                    <li>2. Livewire
                        (<a class="text-violet-500" target="_blank"
                            href="https://livewire.laravel.com/">https://livewire.laravel.com/</a>)
                    </li>
                    <li>3. Volt
                        (<a class="text-violet-500" target="_blank"
                            href="https://livewire.laravel.com/docs/volt">https://livewire.laravel.com/docs/volt</a>)
                    </li>
                    <li>4. TailwindCSS
                        (<a class="text-violet-500" target="_blank"
                            href="https://tailwindcss.com/">https://tailwindcss.com/</a>)
                    </li>
                    <li>5. PrelineUI (v1.9.0)
                        (<a class="text-violet-500" target="_blank"
                            href="https://preline.co">https://preline.co</a>)
                    </li>
                    <li>6. Bootstrap Icons
                        (<a class="text-violet-500" target="_blank"
                            href="https://icons.getbootstrap.com/">https://icons.getbootstrap.com/</a>)
                    </li>

                    <li>7. Livewire Toaster
                        (<a class="text-violet-500" target="_blank"
                            href="https://github.com/masmerise/livewire-toaster">https://github.com/masmerise/livewire-toaster</a>)
                    </li>

                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
