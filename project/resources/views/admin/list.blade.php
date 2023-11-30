<x-layout>
    <x-card class="p-10">
        <div class="container">
            <h1 class="text-3xl text-center font-bold my-6 uppercase">Users</h1>

            <table class="w-full table-auto rounded-sm">
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">{{ $user->id }}</td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">{{ $user->name }}</td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">{{ $user->email }}</td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">{{ $user->role }}</td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="/admin/edit/{{ $user->id }}" class="btn btn-primary">
                                    <i class="fa-solid fa-pen-to-square"></i>Edit
                                </a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <form action="/admin/delete/{{ $user->id }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this user?')">
                                        <i class="fa-solid fa-trash"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="bg-black text-white py-2 px-4 rounded-full hover:opacity-80">
                <a href="/admin/create" class="btn btn-success">Create User</a>
            </button>
        </div>
    </x-card>
</x-layout>
