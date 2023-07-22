<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{ $title }}</title>

        <!-- Font Awesome -->
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
            rel="stylesheet"
        />
        <!-- Google Fonts -->
        <link
            href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
            rel="stylesheet"
        />
        <!-- MDB -->
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css"
            rel="stylesheet"
        />
        <style>
            h2,
            p {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                width: 17%;
                background-color: white;
                padding: 30px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .sidebar ul {
                margin-top: 20px;
                list-style: none;
                padding-left: 0;
            }

            .sidebar li {
                font-weight: 500;
                width: 100%;
                padding: 10px 20px;
                align-items: center;
            }
            .sidebar li:hover {
                align-items: center;
                width: 100%;
                background-color: rgb(210, 239, 255);
                border-radius: 5px;
            }

            .sidebar ul li a {
                color: black;
                text-decoration: none;
            }

            body {
                background-color: #e8f1f5;
            }
            .container-fluid {
                width: auto;
                background-color: white;
                padding: 30px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                margin-left: 20%;
                margin-right: 3%;
                margin-top: 40px;
                border-radius: 8px;
            }

            /* Custom styles to make dropdown looks like a combobox */
            .dropdown {
                display: inline-block;
                position: relative;
            }

            .dropdown-menu {
                position: absolute;
                top: 100%;
                left: 0;
                min-width: 100%;
                padding: 0;
                margin: 0;
                border: none;
                border-radius: 0;
                box-shadow: none;
            }

            /* Hide default dropdown arrow and make button looks like combobox */
            .dropdown-toggle::after {
                display: none;
            }

            /* table */
            .number {
                width: 5%;
            }
            .action {
                width: 23%;
                text-align: center;
            }

            .form-outline {
                margin-bottom: 20px;
            }
        </style>
    </head>

    <body>
        @include('layout.sidebar') @yield('content')

        <!-- hide  -->
        <script>
            function hide() {
                var x = document.getElementById("filter");
                if (x.style.display === "block") {
                    x.style.display = "none";
                } else {
                    x.style.display = "block";
                }
            }
        </script>

        <!-- MDB -->
        <script
            type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"
        ></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script> -->
    </body>
</html>
