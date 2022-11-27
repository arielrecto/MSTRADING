@inject('carbon', 'Carbon\Carbon')

@php
    
    $admin = Auth::user();
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("{$admin->name} - Admin") }}
        </h2>
    </x-slot>

    <div class="w-full flex space-x-20">
        <x-sidebar />
        @if (Route::is('admin.index'))
            <!--Dashboard index layout -->



            <section class="text-gray-600 body-font flex flex-col">
                <div class="container px-5 py-24 mx-auto">
                    <div class="flex flex-wrap -m-4">
                        <div class="p-4 lg:w-1/3">
                            <div class="card card-compact w-96 bg-base-100 shadow-xl">
                                <figure></figure>
                                <div class="card-body">
                                    <h2 class="card-title">Attendance Employee</h2>
                                    <p>today: {{ $carbon::now()->format('F d Y') }}</p>

                                    @if ($attendances !== 0)
                                        <p class="font-bold text-green-500">Total of Employee: {{ $attendances }} </p>
                                    @else
                                        <p>Total of Employee: {{ $attendances }} </p>
                                    @endif
                                    <div class="card-actions justify-end">
                                        <a href="{{ route('admin.attendance.index') }}">
                                            <button class="btn btn-primary">View</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 lg:w-1/3">

                            <div class="card card-compact w-96 bg-base-100 shadow-xl">
                                <figure></figure>
                                <div class="card-body">
                                    <h2 class="card-title">Stocks</h2>
                                    @forelse ($stocks as $stock)
                                        <div class="flex space-x-20">
                                            <p class="font-bold text-green-500">{{ $stock->category }}</p>
                                            <p class="font-bold text-green-500">{{ $stock->total }}</p>

                                        </div>

                                    @empty
                                        <p class="font-bold text-green-500">No Stock</p>
                                    @endforelse
                                    <p>today: {{ $carbon::now()->format('F d Y') }}</p>
                                    <div class="card-actions justify-end">
                                        <a href="{{ route('admin.product.stock') }}">
                                            <button class="btn btn-primary">View</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 lg:w-1/3">
                            <div class="card card-compact w-96 bg-base-100 shadow-xl">
                                <figure></figure>
                                <div class="card-body">
                                    <h2 class="card-title">Position</h2>
                                    <p class="font-bold text-green-500">Total Position:{{ $positions->count() }}</p>
                                    @forelse ($positions as $position)
                                        <p class="font-bold text-green-500">{{ $position->name }}</p>
                                    @empty
                                        <p class="font-bold text-green-500">No Position Available</p>
                                    @endforelse

                                    <div class="card-actions justify-end">
                                        <a href="{{ route('admin.attendance.index') }}">
                                            <button class="btn btn-primary">View</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

              {{$employees->links()}}
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Salary Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ( $employees as $employee)

                            <tr>
                                <th>{{$employee->id - 1}}</th>
                                <td>{{$employee->name}}</td>
                                <td>{{$employee->position->name ?? 'N/A'}}</td>
                                <td>{{$employee->position->salary_rate ?? 'N/A'}}</td>
                            </tr>
                                
                            @empty
                                
                            @endforelse
                        </tbody>
                    </table>
                </div>


            </section>











            <!-- End Dashboard index layout-->
        @elseif(Route::is('admin.employee.edit'))
            <x-admin.employee.update :employee="$employee" :positions="$positions" />
        @elseif(Route::is('admin.employee.index'))
            <div class="flex flex-col w-full ">
                <x-admin.employee.index :employees="$employees" />

                <div class="w-full flex flex-row-reverse">
                    <a href="{{ route('admin.employee.archive') }}" class="link">view archive</a>
                </div>
            </div>
        @elseif(Route::is('admin.employee.show', ['id' => $employee->id]))
            <x-admin.employee.show :employee="$employee" :deductions="$deductions"/>
        @elseif(Route::is('admin.employee.edit', ['id' => $employee->id]))
            <x-admin.employee.update :employee="$employee"/>
        @endif

    </div>



</x-app-layout>
