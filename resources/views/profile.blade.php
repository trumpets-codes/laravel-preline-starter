<x-app-layout page="Profile">

    <div class="space-y-5 mb-8">

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <livewire:profile.update-profile-information-form/>
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <livewire:profile.update-password-form/>
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <livewire:profile.delete-user-form/>
            </div>
        </div>
    </div>

</x-app-layout>
