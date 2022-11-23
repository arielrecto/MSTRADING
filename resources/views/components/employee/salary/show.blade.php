@php

$payroll = $payroll->latest()->first();

@endphp


<x-app-layout>

    <div class="min-h-screen flex items-center justify-center">


        <div class="h-auto w-2/3 bg-white rounded-xl">
            <div class="nav w-full p-4 flex space-x-52 border-b-2 border-solid">
                <div>
                    <img src="{{ asset('logo/logo-color.png') }}" class="h-10" />
                </div>
                <div class="capitalize text-4xl font-bold">
                    <h1>payroll</h1>
                </div>
            </div>
            <div class="flex">
                <div class="h-23 p-5">

                    @if ($payroll->user->image()->count() === 0)
                        <img src="https://xsgames.co/randomusers/avatar.php?g=male">
                    @else
                        <img class="w-80
                        " src="{{ asset('public/Image/' . $payroll->user->image->image_dir) }}">
                    @endif
                    <div>
                        {{-- <h1 class="text-2xl">Name: {{ $payroll->user->name }}</h1>
                    @foreach ($payroll->user->position()->get() as $position)
                        <h2 class="text-sm">Position: {{ $position['name'] }}</h2>
                    @endforeach --}}
                    </div>
                </div>
                <div class="w-full p-5">
                    <table class="table w-full">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Job</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                            <tr>
                                <td>Total Days: </td>
                                <td>{{ $payroll->total_days }}</td>

                            </tr>
                            <tr>
                                <td>Total Work Hours: </td>
                                <td>{{ $payroll->hours_work }}</td>

                            </tr>
                            <!-- row 2 -->
                            <tr>
                                <td>Salary Rate</td>
                                <td>{{ $payroll->salary_rate }}</td>

                            </tr>

                            {{-- 
                        @foreach ($payroll->user->deductionSalary()->get() as $deduction)
                            <tr>
                                <td>{{ $deduction['name'] }}</td>
                                <td>{{ $deduction['amount'] }}</td>

                            </tr>
                        @endforeach --}}

                            <tr>

                               
                            </tr>
                            <tr>
                                <td>Over Time Salary</td>
                                <td>{{ $payroll->salary_rate }}</td>
                            </tr>

                            <tr>
                                <td></td>
                                <td> ₱ {{ number_format($payroll->total, 2, '.', ',') }}</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
