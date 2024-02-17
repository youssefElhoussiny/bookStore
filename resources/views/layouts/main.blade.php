<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- bootstrap && fontawsam --}}
    <link rel="stylesheet" href="{{asset("asset/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("asset/all.min.css")}}">
    {{--! bootstrap && fontawsam --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-GLhlTQ8iXyrVRHpKcVB8Ftl9GqD5SZkP9kP3+8Lw6qUZ5/J5QFQpfJ3uGJvda9/em" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- test fowntawsam --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body{
            font-family: 'Cairo', sans-serif;
            background-color: #f0f0f0;
            text-align: right;
        }
        .score{
            display: block;
            font-size: 16px;
            position: relative;
            overflow: hidden;
        }
        .score-wrap{
            display: inline-block;
            position: relative;
            height: 19px;
        }
        .score .stars-active{
            color: #ffca00;
            position: relative;
            z-index: 10;
            display: block;
            overflow: hidden;
            white-space: nowrap;
        }
        .score .stars-inactive{
            color: lightgrey;
            position: absolute;
            top: 0;
            left: 0;

        }
        .rating
        {
            overflow: hidden;
            display: inline-block;
            position: relative;
            font-size: 20px;
        }
        .rating-star{
            padding: 0 5px;
            margin: 0;
            cursor: pointer;
            display: block;
            float: left;
        }
        .rating-star::after
        {
            position: relative;
            font-family: 'Font Awesome 5 Free';
            content: '\f005';
            color: lightgrey;
        }
        .rating-star.checked ~ .rating-star::after , .rating-star.checked::after
        {
            content: '\f005';
            color: #ffca00;
            font-family: 'Font Awesome 5 Free';

        }
        .rating:hover .rating-star::after
        {
            content: '\f005';
            color: lightgray;
            font-family: "FontAwesome";

        }
        .rating-star:hover ~ .rating-star::after , .rating .rating-star:hover:after
        {
            content: '\f005';
            color: #ffca00;
            font-family: "FontAwesome";

        }
        /* ////////////////cart/////////////// */
        .bg-cart
        {
            background-color: #ffc107;
            color: #fff;
        }
    </style>

    <title>مكتبة</title>
    @yield('head')
</head>
<body dir="rtl" >
        <div>
                <nav class="navbar navbar-expand-lg bg-white">
                    <div class="container-fluid">
                    <a class="navbar-brand" href="{{route('gallery.index')}}">مكتبة حسوب</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mx-auto">
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('cart.view')}}">
                                        @if(Auth::user()->booksInCart()->count() > 0)
                                            <span class="badge bg-secondary">{{ Auth::user()->booksInCart()->count() }}</span>
                                        @else
                                            <span class="badge bg-secondary">0</span>
                                        @endif
                                            العربة
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </li>
                            @endauth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('gallery.categories.index') }}">
                                        التصنيفات
                                    <i class="fas fa-list"></i>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('gallery.publishers.index') }}">
                                    الناشرون
                                    <i class="fas fa-table"></i>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('gallery.authors.index') }}">
                                    المؤلفون
                                    <i class="fas fa-pen"></i>
                                </a>
                            </li>

                            @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('my.product')}}">
                                        مشترياتي
                                        <i class="fas fa-basket-shopping"></i>
                                    </a>
                                </li>
                            @endauth
                        </ul>
                        <ul class="navbar-nav mr-auto">
                            @guest
                                <li class="nav-item">
                                    <a href="{{route('login')}}" class="nav-link">تسجيل الدخول</a>
                                </li>
                                @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{route('register')}}" class="nav-link">انشاء حساب</a>
                                </li>
                                @endif
                            @else
                                <li class="nav-item dropdown justify-content-left">
                                    <a href="" class="nav-link" id="navbarDropdown" data-bs-toggle="dropdown">
                                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-left px-2 text-right mt-2 ">
                                         @can('update-books')
                                             <a href="{{route('admin.index')}}" class="dropdown-item">لوحة الادارة</a>
                                         @endcan
                                        <div class="pt-4 pb-1 border-t border-gray-200">
                                            <div class="flex items-center px-4">
                                                <div>
                                                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                                                </div>
                                            </div>

                                            <div class="mt-3 space-y-1 text-right">
                                                <!-- Account Management -->
                                                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                                    {{ __('Profile') }}
                                                </x-responsive-nav-link>


                                                <!-- Authentication -->
                                                <form method="POST" action="{{ route('logout') }}" x-data>
                                                    @csrf

                                                    <x-responsive-nav-link href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                        this.closest('form').submit();" >
                                                        {{ __('Log Out') }}
                                                    </x-responsive-nav-link>
                                                </form>

                                                <!-- Team Management -->
                                                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                                    <div class="border-t border-gray-200"></div>

                                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                                        {{ __('Manage Team') }}
                                                    </div>

                                                    <!-- Team Settings -->
                                                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                                                        {{ __('Team Settings') }}
                                                    </x-responsive-nav-link>

                                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                                            {{ __('Create New Team') }}
                                                        </x-responsive-nav-link>
                                                    @endcan

                                                    <!-- Team Switcher -->
                                                    @if (Auth::user()->allTeams()->count() > 1)
                                                        <div class="border-t border-gray-200"></div>

                                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                                            {{ __('Switch Teams') }}
                                                        </div>

                                                        @foreach (Auth::user()->allTeams() as $team)
                                                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endguest
                        </ul>

                    </div>
                    </div>
                </nav>

                <main class="py-4">
                    @yield('content')
                </main>


        </div>



    <script src="{{asset("asset/popper.min.js")}}"></script>
    <script src="{{asset("asset/bootstrap.min.js")}}"></script>
    <script src="{{asset("asset/all.min.js")}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('script')
</body>
</html>
