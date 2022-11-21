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
            </div>

            <div class="min-h-screen bg-green-100 flex items-center justify-center">

                <div class="h-auto w-2/3 bg-white rounded-xl">
                    <div class="nav w-full p-4 flex space-x-52 border-b-2 border-solid">
                        <div>
                            <img src="{{ asset('logo/logo-color.png') }}" class="h-10" />
                        </div>
                        <div class="capitalize text-4xl font-bold">
                            <h1>Deduction</h1>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="h-23 p-5">

                            @if ($payroll->user->image()->count() === 0)
                                <img src="https://xsgames.co/randomusers/avatar.php?g=male">
                            @else
                                <img class="h-56"
                                    src="{{ asset('public/Image/' . $payroll->user->image->image_dir) }}">
                            @endif
                            <div>
                                <h1 class="text-2xl">Name: {{ $payroll->user->name }}</h1>

                                <h2 class="text-sm">Position: {{ $payroll->user->position->name }}</h2>

                            </div>
                        </div>
                        <div class="w-full p-5">
                            <table class="table w-full">
                                <!-- head -->
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Select</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- row 1 -->


                                    @forelse ($deductions as $deduction)
                                        <tr>

                                            <td> <label for="">{{ $deduction->name }}</label></td>
                                            <td>

                                                <form
                                                    action="{{ route('admin.deduction.setDeduction', ['id' => $payroll->user->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="deduction"
                                                        value="{{ $deduction->name }}">
                                                    @if ($payroll->user->deductionSalary()->where('name', '=', $deduction->name)->count() === 0)
                                                        <button>Add</button>
                                                    @else
                                                        {{ $payroll->user->deductionSalary()->where('name', '=', $deduction->name)->first()->amount }}
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>

                                    @empty
                                        No Deduction Available
                                    @endforelse
                                    <tr>
                                        <td>Total</td>
                                        <td>{{ $totalDeduct }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="flex flex-row-reverse mr-20">

                                <form action="{{ route('admin.payroll.updatePayroll', ['id' => $payroll->id]) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-success">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</x-app-layout>
