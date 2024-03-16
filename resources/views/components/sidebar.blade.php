<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <title>Admin Dashboard</title>
</head>

<body>
    <div class="container-fluid">
        <div class="main-container">
            <div class="sidebar">
                <div class="upper-part">
                    <div class="logo">
                        <img src="{{ asset('images/home/logo.png') }}" alt="">
                    </div>
                    <div class="main-data">
                        <h6>Main Data</h6>
                        @yield('superadmin-content')
                        <div class="users-div" onclick="handleClick('users')">
                            <i class="fa-regular fa-circle-user"></i>
                            <p>Users</p>
                        </div>
                        <div class="competitions-div" onclick="handleClick('competitions')">
                            <i class="fa-solid fa-chess"></i>
                            <p>Competitions</p>
                        </div>
                        <div class="events-div" onclick="handleClick('events')">
                            <i class="fa-solid fa-ticket"></i>
                            <p>Events</p>
                        </div>
                    </div>
                    <div class="teams-data">
                        <h6>Teams Data</h6>
                        <div class="teams-div" onclick="handleClick('teams')">
                            <i class="fa-solid fa-user-group"></i>
                            <p>Teams</p>
                        </div>
                        <div class="events-score-div" onclick="handleClick('events-score')">
                            <i class="fa-regular fa-flag"></i>
                            <p>Events Score</p>
                        </div>
                        <div class="competitions-score-div" onclick="handleClick('competitions-score')">
                            <i class="fa-solid fa-ranking-star"></i>
                            <p>Competitions Score</p>
                        </div>
                    </div>
                    <div class="individuals-data">
                        <h6>Individuals Data</h6>
                        <div class="individuals-div" onclick="handleClick('individuals')">
                            <i class="fa-solid fa-user-large"></i>
                            <p>Individuals</p>
                        </div>
                        <div class="events-score-div" onclick="handleClick('events-score', true)">
                            <i class="fa-regular fa-flag"></i>
                            <p>Events Score</p>
                        </div>
                        <div class="competitions-score-div" onclick="handleClick('competitions-score', true)">
                            <i class="fa-solid fa-ranking-star"></i>
                            <p>Competitions Score</p>
                        </div>
                    </div>
                </div>
                <div class="lower-part mt-5">
                    <h6>{{ Auth::user()->name }}</h6>
                    <p>{{ Auth::user()->email }}</p>
                    <a href="/logout" class="btn" style="color: #379AE6">Logout</a>
                </div>
            </div>
            <div class="sidebar-content p-2">
                <div class="hello-part">
                    <h1>Hello, {{ Auth::user()->name }}</h1>
                    <button class="btn" type="button" style="background-color: #379AE6;color:white"
                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Add @yield('button-content')
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">@yield('modal-title')</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @yield('modal-body')
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="content">
                    @yield('page-content')
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    @yield('script')
</body>

</html>
