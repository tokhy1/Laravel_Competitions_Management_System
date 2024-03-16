<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Sign In</title>

    <style>
        .login_content {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 100px;
            width: 100%;
            height: 90vh;
        }

        .subContainer {
            background-color: white;
            display: flex;
            width: 80%
        }

        .form-container {
            padding: 40px;
            background-color: white;
        }

        .form-container h2 {
            font-size: 24px;
            color: #379AE6;
            margin-bottom: 40px;
            font-weight: 500;
        }

        .form-container button {
            width: 400px;
            background-color: #379AE6;
            color: white;
            margin-bottom: 40px;
            margin-top: 10px;
        }

        .form-container .center-btn {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container p {
            font-size: 14px;
            color: #565E6C;
            font-weight: 500;
        }

        .form-container p span a {
            color: #379AE6;
            text-decoration: none;
            font-weight: bold;
        }

        .login_content .image img {
            width: 100%;
        }
    </style>
</head>

<body style="background-color: #EBFDFF;">

    <div class="container-fluid p-4">
        <div class="login_content">
            <div class="subContainer">
                <div class="form-container w-50">
                    <h2>Welcome Again!</h2>

                    <form action="/login" method="POST" class="w-100">
                        @csrf
                        <div class="mb-3">
                            <label for="emailInput" class="form-label"
                                style="font-weight: bold;color: #565E6C">Email</label>
                            <input type="email" class="form-control" id="emailInput" placeholder="Example@gmail.com"
                                name="email">
                        </div>

                        <div class="mb-3">
                            <label for="passwordInput" class="form-label"
                                style="font-weight: bold;color: #565E6C">Password</label>
                            <input type="password" class="form-control" id="passwordInput"
                                placeholder="Enter at least 8+ characters " name="password">
                        </div>
                        <div class="mt-3 mb-2 form-check">
                            <input type="checkbox" class="form-check-input" id="check" name="remember_me">
                            <label class="form-check-label" for="check">Remember Me</label>
                        </div>
                        <div class="center-btn">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>

                    <p class="text-center">Don't have an account? <span><a href="/showregister">Sign Up here</a></span>
                    </p>
                </div>
                <div class="image">
                    <img src="{{ asset('images/authentication/login.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>

</body>

</html>
