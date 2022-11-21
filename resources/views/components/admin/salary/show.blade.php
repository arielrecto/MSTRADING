@inject('carbon', 'Carbon\Carbon')
<x-app-layout>
    <div class="flex space-x-2">
        <x-sidebar />
        <div class="flex flex-col w-full">




            <div class="flex w-full bg-blue-300">

                <div class="p-4 sm:w-1/4">
                    <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">
                        {{ Auth::user()->where('is_admin', false)->count() }}
                    </h2>
                    <p class="leading-relaxed">Employee</p>
                </div>

                @foreach ($positions as $position)
                    <div class="p-4 sm:w-1/4 ">
                        <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">
                            {{ $positions->where('name', '=', $position->name)->count() ?? '' }}</h2>
                        <p class="leading-relaxed">{{$position->name}}</p>
                    </div>
                @endforeach

                <div class="p-4 sm:w-1/4 ">
                    <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">
                        {{ $positions->count() ?? '' }}</h2>
                    <p class="leading-relaxed">Total Position</p>
                </div>

            </div>

            {{-- <section class="text-gray-600 body-font w-full bg-blue-100">
                <div class="container px-5 py-24 mx-auto">
                    <div class="flex flex-wrap -m-4 text-center">
                       
                        <div class="p-4 sm:w-1/4 w-1/2">
                            <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">
                                {{ $positions->count() ?? '' }}</h2>
                            <p class="leading-relaxed">Total Position</p>
                        </div>
                    </div>
            </section> --}}

            <div class="flex justify-center">
                <div class="tabs">
                    <a class="tab tab-lg tab-bordered tab-active">Employees</a>
                    <a href="{{ route('admin.payroll.index') }}" class="tab tab-lg tab-bordered">Approved Salary</a>
                </div>
            </div>



            <div class="overflow-x-auto" x-data="$store.view">

                @if (Session::has('message'))
                    <div class="alert alert-success shadow-lg">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ Session::get('message') }}</span>
                        </div>
                    </div>
                @endif

                @if (Session::has('error'))
                    <div class="alert alert-error shadow-lg">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ Session::get('error') }}</span>
                        </div>
                    </div>
                @endif

                <table class="table w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Name</th>
                            <th>position</th>
                            <th>Last Payroll</th>
                            <th>Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        {{ $employees->links() }}
                        @forelse ($employees as $employee)
                            <tr>
                                <th>{{ $employee->id -Auth::user()->where('is_admin', true)->count() }}</th>
                                <td>
                                    {{ $employee->name }}
                                </td>
                                <td>
                                    @foreach ($employee->position()->get() as $positionName)
                                        {{ $positionName['name'] }}
                                    @endforeach
                                </td>
                                <td>

                                    {{ $employee->payroll['log_date'] ?? 'N/A' }}

                                </td>
                                <td>

                                    <div class="flex space-x-5">
                                        <form class="p-3"
                                            action="{{ route('admin.payroll.store', ['id' => $employee->id]) }}"
                                            method="post">
                                            @csrf
                                            <button>Generate Payroll</button>
                                        </form>
                                        @if ($employee->payroll()->count() > 0)
                                            <a href="{{ route('admin.payroll.show', ['id' => $employee->id]) }}">
                                                <button class="btn btn-success"> view </button>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                        @empty

                            <div class="alert alert-warning shadow-lg">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <span>No Data</span>
                                </div>
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('aprovedSalary', {
                state: [{{ $employees }}],

                view() {
                    console.log(this.state)
                }
            })
        })
    </script>
</x-app-layout>
