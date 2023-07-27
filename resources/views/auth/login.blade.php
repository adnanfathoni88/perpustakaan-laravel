<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Login</title>
        {{-- link bootstrap --}}
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.css"
            rel="stylesheet"
        />
    </head>

    <body>
        <div class="container mt-4">
            <h1>Login</h1>

            {{-- error --}}
            @if(Session::has('status'))
            <div class="alert alert-danger mt-3">
                {{ Session::get('status')}}
            </div>
            @endif

            <form action="/login" method="post">
                @csrf
                <div>
                    <label for="email">email</label>
                    <input class="form-control" type="text" name="email" />
                </div>
                <div>
                    <label for="password">password</label>
                    <input
                        class="form-control"
                        type="password"
                        name="password"
                    />
                </div>
                <button class="btn btn-primary mt-3" type="submit">
                    Login
                </button>
            </form>
        </div>
    </body>
</html>
