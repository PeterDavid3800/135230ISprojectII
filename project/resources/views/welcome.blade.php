<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Savify Get Started</title>
    <style>
        body {
            background-color: white;
            text-align: center;
        }

        h1 {
            color: green;
        }
        h2 {
            color: green;
        }

        a {
            display: block;
            width: 100px;
            margin: 0 auto;
            text-decoration: none;
            color: green;
            font-weight: bold;
            padding: 10px;
            border: 2px solid green;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        form {
            margin: 0 auto;
            display: inline-block;
        }

        button {
            background-color: green;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Savify</h1>
    <h2>Save money all the time</h2>
    @auth
    <form action="/logout" method="POST">
        @csrf
        <button type="submit">Log out</button>
    </form>
    @endauth
    <a href="/register">Register</a>
    <a href="/login">Login</a>
</body>
</html>
