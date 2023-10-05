<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ ENV('APP_NAME') }}</title>

    <meta name="keywords" content="{{ ENV('APP_NAME') }}">
    <!-- <meta name="description" content="{{ ENV('APP_DESC') }}"> -->
    <meta name="base-url" content="{{ url('/') }}">
    <!-- <link rel="icon" href="{{ url('/') }}/images/logo.png"> -->
    <meta name="app-name" content="{{ ENV('APP_NAME') }}">

    <link type="image/x-icon" rel="icon" href="https://lh3.googleusercontent.com/-xXNyOZKCHKw/YxIi-k3Hp-I/AAAAAAAAAq4/FmLViZaV7OYMbiisL7nXBVJ0wL6MmNHNgCNcBGAsYHQ/h120/icona.png">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Mali:ital,wght@0,400;0,500;0,600;0,700;1,300&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: "Poppins";
        }
    </style>
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 0.32rem;
            height: 0rem;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #ddd;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #bbb;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #111;
        }
    </style>
</head>

<body class="">
    <div id="app"></div>
</body>
@vite('resources/js/app.js')

</html>