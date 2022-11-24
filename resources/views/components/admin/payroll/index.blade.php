<x-app-layout>
    <div class="flex space-x-2">
        <x-sidebar />
        <div class="flex flex-col w-full">
            <div class="overflow-x-auto" x-data="$store.view">

                @if (Session::has('message'))
                    <div class="alert alert-success shadow-lg">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ Session::get('message') }} <a href="">View</a></span>
                        </div>
                    </div>
                @endif
                <div class="flex justify-center">
                    <div class="tabs">
                        <a href="{{ route('admin.salary.show') }}"class="tab tab-lg tab-bordered">Employees</a>
                        <a href="{{ route('admin.payroll.index') }}"class="tab tab-lg tab-bordered tab-active">Approved
                            Salary</a>
                    </div>
                </div>
                <table class="table w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Salary Rate</th>
                            <th>Hour Rate</th>
                            <th>Total Salary</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <tbody>
                        {!! $payrolls->links() !!}

                        @forelse ($payrolls as $payroll)


                            <tr>
                                <th>{{ $payroll->user->id -Auth::user()->where('is_admin', true)->count() }}</th>
                                <td>{{ $payroll->user->name }}</td>
                                <td>
                                    {{$payroll->user->position->name}}
                                </td>

                                <td>
                                   {{$payroll->user->position->salary_rate}}
                                </td>
                                <td>
                                    {{$payroll->user->position->salary_rate / $payroll->user->position->hours_work}}
                                </td>

                                <td>
                                    {{'₱ ' . number_format($payroll->total, '2', '.', ',')}}
                                </td>

                                <td>
                                    <h1 class="text-green-600">Approved ✓</h1>
                                </td>

                                <td>
                                        {{-- <a href="{{ route('admin.generatePDF.view', ['id' => $employee->id]) }}"
                                            class="link text-blue-500">
                                            <h1 class="text-green-600">view</h1>
                                        </a> --}}
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
            Alpine.store('view', {
                on: false,

                toggle() {
                    this.on = !this.on
                }
            })
        })
    </script>
</x-app-layout>
