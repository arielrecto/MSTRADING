@inject('carbon', 'Carbon\Carbon')

<x-app-layout>

    @if ($notif)
        <div class="alert alert-info shadow-lg">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="stroke-current flex-shrink-0 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span> Double Pay for this {{ $notif->type }} {{ $notif->name }} until
                    {{ $carbon::parse($notif->date_end)->format('F d Y') }}</span>
            </div>
        </div>
    @endif


    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    @if (Auth::user()->is_admin === '1')
                        <a href="{{ route('admin.index') }}"
                            class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('dashboard.index') }}"
                            class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif
        <section class="text-gray-600 body-font rounded-lg bg-gray-50">
            <div class="container px-5 py-24 mx-auto flex flex-col">
                <div class="xl:w-1/2 lg:w-3/4 w-full mx-auto text-center">
                    <img src="{{ asset('logo/logo-color.png') }}">
                </div>
                <div class="xl:w-1/2 lg:w-3/4 w-full mx-auto text-center">

                    @if (Auth::check())
                        <h1 class="text-3xl font-bold p-2">Welcome</h1>

                        @if (Auth::user()->is_admin === '1')
                            <h1 class="text-2xl font-semibold">{{ Auth::user()->name }} - Admin
                            </h1>
                        @else
                            <h1 class="text-2xl font-semibold">{{ Auth::user()->name }}
                            </h1>
                        @endif


                    @endif
                </div>


                @if (\Session::has('message'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('message') !!}</li>
                        </ul>
                    </div>
                @endif

                <div class="xl:w-1/2 lg:w-3/4 w-full mx-auto text-center">
                    <div class="flex">

                        @if (Auth::check())

                            @if (Auth::user()->is_admin === '1')
                                <a href="{{ route('admin.index') }}">
                                    <button class="btn btn-ghost">Dashboard </button>
                                </a>
                            @else
                                <a href="{{ route('dashboard.index') }}">
                                    <button class="btn btn-ghost">Dashboard</button>
                                </a>
                            @endif

                        @endif


                        @if (Auth::user() === null)
                            <a href="{{ route('login') }}">
                                Welcome to MS PANTONI
                            </a>
                        @else
                            @if (Auth::user()->attendances()->latest()->first() !== null)

                                @if (Auth::user()->attendances()->latest()->first()->log_date !==
                                    $carbon
                                        ::now()->setTimezone('Asia/Manila')->toDateString() ||
                                    Auth::user()->attendances()->latest()->first()->time_out === null)
                                    <form action="{{ route('dashboard.attendance') }}" method="POST">

                                        @csrf

                                        <input type="hidden" name="attendance" value="true">

                                        @if (!Auth::user()->is_admin === true)
                                            <button class="btn btn-ghost">Attendance</button>
                                        @endif
                                    </form>

                                @endif
                            @else
                                @if (Auth::user()->position()->count() === 0)
                                @else
                                    <form action="{{ route('dashboard.attendance') }}" method="POST">

                                        @csrf

                                        <input type="hidden" name="attendance" value="true">

                                        @if (!Auth::user()->is_admin === true)
                                            <button class="btn btn-ghost">Attendance</button>
                                        @endif
                                    </form>

                                @endif
                            @endif
                        @endif
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </div>

</x-app-layout>
