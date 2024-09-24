<x-app-layout>
    <div class="py-12 container" style="margin-top: 150px;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 row">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg col-12">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg col-12">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg col-12">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
