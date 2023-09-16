hello world
<br>
@auth

<form action="/logout" method="POST">
    @csrf
    <button type="submit"> Log out</button>
</form>

@endauth
<a href="/register">Register</a>
<br>
<a href="/login">Login</a>
<br>
