<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <style>
        body {
            background-color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        h2 {
            color: green;
        }

        form {
            background-color: white;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            max-width: 300px; /* Adjust the max-width to your preference */
            width: 100%;
            max-height: 80vh; /* Set a maximum height and allow vertical scrolling */
            overflow-y: auto; /* Enable vertical scrolling when content exceeds the height */
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: green;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="radio"],
        input[type="checkbox"] {
            margin-right: 5px;
        }

        .gender-label {
            display: inline-block;
            margin-right: 20px;
            color: green;
        }

        input[type="submit"] {
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: darkgreen;
        }

        a {
            color: green;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div id="dashboard">
        <a href="registration.php">Sign Up</a> |
        <a href="login.php">Login</a>
    </div>
    <h2>Registration</h2>
    <form action="/users" method="POST">
        @csrf
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="name" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="image">Profile</label>
        <input type="file" id="profile" name="profile" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" value="Register">
    </form>
</body>

</html>
