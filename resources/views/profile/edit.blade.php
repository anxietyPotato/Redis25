@if (session('status'))
    <div class="text-green-600 font-semibold">
        {{ session('status') }}
    </div>
@endif
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                        <form method="POST" action="{{ route('profile.changeAvatar') }}" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <h2 class="text-lg font-medium text-gray-900">Upload Profile Image</h2>

                            <img id="profilePreview"
                                 src="{{ Auth::user()->avatar
         ? asset('storage/images/avatars/' . Auth::user()->avatar)
         : 'https://via.placeholder.com/80' }}"
                                 class="rounded-full h-20 w-20 object-cover">

                            <!-- Image preview -->
                            <div class="flex items-center space-x-4">
                                <img id="profilePreview" src="https://via.placeholder.com/80" alt="Profile Preview" class="w-20 h-20 rounded-full object-cover border" />
                                <input type="file" name="avatar" id="profileImage" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Upload
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                // Preview the selected image before upload
                const profileImageInput = document.getElementById('profileImage');
                const profilePreview = document.getElementById('profilePreview');

                profileImageInput.addEventListener('change', function(event) {
                    const [file] = profileImageInput.files;
                    if (file) {
                        profilePreview.src = URL.createObjectURL(file);
                    }
                });
            </script>


            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
