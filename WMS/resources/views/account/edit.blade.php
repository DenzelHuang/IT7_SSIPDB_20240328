<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/Stylesheet.css') }}">
    <style>
        /* Accounts */
        .accounts-body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            align-items: center;
        }
        .account-list {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            border: 1px solid black;
            width: 50%;
            max-width: 500px;
            background-color: ghostwhite;
            border-radius: 20px;
        }
        .account-list * {
            border: 1px solid black;
        }
        table {
            width: 100%;
        }
        th, td {
            text-align: center;
        }
        body {
            color: red;
        }
    </style>
</head> 
<body class="accounts-body">
    @include('header')

    <div class="account-list">
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
            </tr>
            <tr>
                <td>1</td>
                <td>1</td>
                <td>1</td>
            </tr>
        </table>
    </div>

    @include('footer')
</body>
</html>