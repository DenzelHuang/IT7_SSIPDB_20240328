<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="css/Stylesheet.css">
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