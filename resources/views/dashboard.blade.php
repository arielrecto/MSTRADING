<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="overflow-x-auto">
                <table class="table w-full">


                    @if (\Session::has('message'))
                        <div class="alert alert-success shadow-lg">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{!! \Session::get('message') !!}</span>
                            </div>
                        </div>
                    @endif

                    @if (!$notif)

                    <div class="alert alert-success shadow-lg">
                        <div>
                          <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                          <span>Welcome New Employee: <p class="font-bold">{{$user->name}}</p></span>
                        </div>
                      </div>

                    @else
                        @if ($notif->is_viewed === 'false' && $notif->is_approved === 'true')
                            <div class="alert alert-info shadow-lg w-full">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        class="stroke-current flex-shrink-0 w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div class="flex space-x-96">
                                        <span>Payroll is Approved at {{ $notif->log_date }}</span>

                                        <a class="link"href="{{ route('dashboard.salaryView') }}">View</a>

                                    </div>
                                </div>
                            </div>
                        @endif

                    @endif


                    @if ($user->profile()->get()->isEmpty())
                        <div class="p-5 border border-2-solid flex flex-col bg-gray-50 border rounded-lg p-5">
                            <div class="flex justify-center text-5xl font-bold">
                                <h1>Profile</h1>
                            </div>


                            <x-employee.create />

                        </div>
                    @else
                        <!-- head -->
                        @if (Auth::user()->is_admin === '1')
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>no. attendance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($user->all() as $userData)
                                    @if (!$userData->is_admin)
                                        <tr>
                                            <th>{{ $userData->id - 1 }}</th>
                                            <td>{{ $userData->name }}</td>
                                            <td>{{ $userData->attendances()->count() }}</td>
                                        </tr>
                                    @endif
                                @empty
                                    <div class="alert alert-warning shadow-lg">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                            <span>No Data</span>
                                        </div>
                                    </div>
                                @endforelse
                            @else
                                <x-employee.show :employee="$user" />
                        @endif
                        </tbody>

                    @endif

                </table>
            </div>

        </div>
    </div>
</x-app-layout>
