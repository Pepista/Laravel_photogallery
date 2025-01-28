@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto p-4">
        <h2 class="text-2xl mb-4">Edit Profile</h2>

        <!-- Zobrazení úspěšné zprávy -->
        @if(session('status') === 'profile-updated')
            <div class="mb-4 text-green-500">
                Profile updated successfully!
            </div>
        @endif

        <!-- Formulář pro úpravu profilu -->
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PATCH') <!-- Používáme PATCH pro aktualizaci -->

            <!-- Jméno -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" class="w-full p-2 border border-gray-300 rounded @error('name') border-red-500 @enderror" required>
                @error('name')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="w-full p-2 border border-gray-300 rounded @error('email') border-red-500 @enderror" required>
                @error('email')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Heslo -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded @error('password') border-red-500 @enderror">
                <small class="text-gray-500">Leave empty to keep the current password</small>
                @error('password')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Potvrzení hesla -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-2 border border-gray-300 rounded">
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Save Changes</button>
        </form>
    </div>
@endsection
