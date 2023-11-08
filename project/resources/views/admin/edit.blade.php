<x-layout>
<x-card class="p-10">
    <div class="container">
        <h1>Edit User</h1>

        <form method="POST" action="/admin/update">
            @csrf
            @method('PUT') <!-- Use the PUT method to update the user -->

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <div class="form-group">
                <label for "role">Role</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                    <option value="merchant" {{ $user->role === 'merchant' ? 'selected' : '' }}>Merchant</option>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
</x-card>
</x-layout>
