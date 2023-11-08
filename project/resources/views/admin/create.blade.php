<x-layout>
<div class="mx-4">
        <x-card class="p-10 rounded max-w-lg mx-auto mt-24">
        <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">
                Create User
                  </h2>
                </header>

        <form method="POST" action="/admin/create">
            @csrf
            <div class="mb-6">
                <label for="name" class="inline-block text-lg mb-2">
                    Name
                </label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="name"
                />
            </div>

            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">Email</label>
                <input
                        type="email"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="email"
                    />
            </div>

            <div class="mb-6">
                <label for="role" class="inline-block text-lg mb-2">Role</label>
                <select name="role" class="border border-gray-200 rounded p-2 w-full">
                    <option value="user">User</option>
                    <option value="merchant">Merchant</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="mb-6">
                <label
                    for="password"
                    class="inline-block text-lg mb-2">
                    Password
                </label>
                <input
                    type="password"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="password"/>
            </div>

            <div class="mb-6">
                <label
                    for="password2"
                    class="inline-block text-lg mb-2">
                    Confirm Password
                </label>
                <input
                    type="password"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="password2"/>
            </div>

            <div class="mb-6">
                <button
                    type="submit"
                    class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    Create User
            </button>
            </div>
        </form>
      </x-card>
      </div>
      </x-layout>