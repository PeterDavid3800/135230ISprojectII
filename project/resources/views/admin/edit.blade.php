<x-layout>
    <x-card class="p-10">
        <div class="container">
            <h1 class="text-3xl text-center font-bold my-6 uppercase">Edit User</h1>

            <form method="POST" action="/admin/edit/{{$user->id}}">
                @csrf
                @method('PUT') <!-- Use the PUT method to update the user -->

                <div class="mb-6">
                    <label for="name" class="inline-block text-lg mb-2">
                        Name
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
                           value="{{ $user->name }}" required>
                </div>

                <div class="mb-6">
                    <label for="email" class="inline-block text-lg mb-2">Email</label>
                    <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email"
                           value="{{ $user->email }}" required>
                </div>

                <div class="mb-6">
                    <label for="role" class="inline-block text-lg mb-2">Role</label>
                    <select name="role" class="border border-gray-200 rounded p-2 w-full" required>
                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                        <option value="merchant" {{ $user->role === 'merchant' ? 'selected' : '' }}>Merchant</option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <!-- Password and Confirm Password fields (similar to the Create User form) -->
                <div class="mb-6">
                    <label for="password" class="inline-block text-lg mb-2">Password</label>
                    <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password"/>
                </div>

                <div class="mb-6">
                    <label for="password2" class="inline-block text-lg mb-2">Confirm Password</label>
                    <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password2"/>
                </div>

                <div class="mb-6">
                    <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </x-card>
</x-layout>
