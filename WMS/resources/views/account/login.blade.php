<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/Stylesheet.css') }}">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-container {
            width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            padding: 3%;
        }
        button {
            width: 94%;
            margin-top: 4%;
        }
        .h1 {
            color: white;
            text-shadow: 0px 0px 5px black;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <p class="h1">WMS Login</p>
        <div class="form-container">
            <form class="form" action="account/check" method="post">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control border-3" name="username" placeholder="Enter username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control border-3" name="password" placeholder="Enter password" required>
                </div>
                @if($errors->any())
                <span style="color: red">{{$errors->first()}}</span>
                @endif
                <button type="submit" class="btn btn-secondary" name="submit" value="Submit">Submit</button>
            </form>
        </div>    
    </div>
</body>
</html>

