<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            width: 50%;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .container h2 {
            text-align: center;
        }

        .container form div {
            margin: 10px 0;
        }

        .container form div label {
            display: inline-block;
            width: 150px;
        }

        .container form div input {
            width: 200px;
            padding: 5px;
        }

        .container form div button {
            padding: 5px 10px;
            background-color: #ccc;
            border: none;
            cursor: pointer;
        }

        .container form div a {
            text-decoration: none;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST" action="/login">
            @csrf
            <div>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" autofocus />
            </div>
            <div>
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required />
            </div>
            <div>
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</body>

</html>