<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Sign Up</title>

    <style>
        .register_content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 100px;
            width: 100%;
            height: 90vh;
            overflow-y: hidden
        }

        .form-container {
            padding: 40px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
            margin-top: 20px;
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


        .register_content .texts {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .register_content .texts h3 {
            font-size: 40px;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .register_content .texts .text-item {
            display: flex;
            align-items: center;
        }

        .register_content .texts .text-item img {
            width: 45px;
            margin-right: 20px;
            margin-bottom: 25px
        }

        .register_content .texts .text-item p {
            color: #565E6C;
            font-size: 18px;

        }
    </style>
</head>

<body style="background-color: #EBFDFF;">

    <div class="container-fluid p-4">
        <div class="register_content">
            <div class="form-container w-50">
                <h2>Begin Your Competitions</h2>

                <form action="/register" method="POST" class="w-100">
                    @csrf
                    <div class="mb-3">
                        <label for="nameInput" class="form-label" style="font-weight: bold;color: #565E6C">Name</label>
                        <input type="text" class="form-control" id="nameInput" placeholder="Example.Mohamed Ashraf"
                            name="name">
                    </div>

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
                    <div class="center-btn">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>

                <p class="text-center">Returning user? <span><a href="/showlogin">Log in here</a></span></p>
            </div>
            <div class="texts">
                <h3>Come join us</h3>
                <div class="text-item">
                    <div class="icon">
                        <img src="{{ asset('images/authentication/icon1.png') }}" alt="">
                    </div>
                    <p>Explore competitions, do challenges, <br> participate in new events </p>
                </div>

                <div class="text-item">
                    <div class="icon">
                        <img src="{{ asset('images/authentication/icon2.png') }}" alt="">
                    </div>
                    <p>Learn at your own pace and access <br> educational resources anytime </p>
                </div>

                <div class="text-item">
                    <div class="icon">
                        <img src="{{ asset('images/authentication/icon3.png') }}" alt="">
                    </div>
                    <p>Engage with a community of competitors and <br> share insights </p>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
