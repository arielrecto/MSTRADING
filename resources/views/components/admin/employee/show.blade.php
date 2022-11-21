@props([
    'employee' => [],
])


@php
    $checkIfEmpty =
        $employee
            ->profile()
            ->where('user_id', $employee->id)
            ->count() === 0;
@endphp

@if ($checkIfEmpty)
    <div class="h-20 w-full p-2">
        <div class="alert alert-error shadow-lg">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>No Profile in the Database</span>
            </div>
            <div class="link">
                <a href="{{ route('admin.employee.addprofile', ['id' => $employee->id]) }}">Add Profile</a>
            </div>
        </div>
    </div>
@else
    <div class="bg-gray-100 w-full">
        <div class="w-full text-white bg-main-color">

            <div class="container mx-auto my-5 p-5">
                <div class="md:flex no-wrap md:-mx-2 ">
                    <!-- Left Side -->
                    <div class="w-full md:w-3/12 md:mx-2">
                        <!-- Profile Card -->
                        <div class="bg-white p-3 border-t-4 border-blue-400">
                            <div class="image overflow-hidden">

                                @if ($employee->image()->count() === 0)
                                    <img class="h-auto w-full mx-auto"
                                        src="https://xsgames.co/randomusers/avatar.php?g=male" alt="">
                                @else
                                    <img class="h-auto w-full mx-auto"
                                        src="{{asset('public/Image/' . $employee->image->image_dir)}}" alt="">
                                @endif
                            </div>
                            <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">{{ $employee->name }}</h1>
                            <h3 class="text-gray-600 font-lg text-semibold leading-6">Position :
                                {{ $employee->position->name ?? 'N/A' }}</h3>
                            <p class="text-sm text-gray-500 hover:text-gray-600 leading-6"></p>
                            <ul
                                class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                                <li class="flex items-center py-3">
                                    <span>Member since</span>
                                    <span class="ml-auto">{{ $employee->created_at }}</span>
                                </li>
                                <li class="flex items-center py-3 space-x-10">
                                    <form action="{{ route('admin.employee.delete', ['id' => $employee->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class=" btn btn-error">delete </button>
                                    </form>
                                    <div>
                                        <a href="{{ route('admin.employee.edit', ['id' => $employee->id]) }}">
                                            <button class="btn btn-ghost">Update</button>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex flex-col w-full">
                        <div class="w-full md:w-9/12 mx-2 h-64">
                            <div class="bg-white p-3 shadow-sm rounded-sm">
                                <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                                    <h1>Employee Informtion</h1>
                                </div>
                                <div class="text-gray-700">
                                    <div class="grid md:grid-cols-2 text-sm">
                                        <div class="grid grid-cols-2">
                                            <div class="px-4 py-2 font-semibold">First Name</div>
                                            <div class="px-4 py-2">{{ $employee->profile->first_name }}</div>
                                        </div>
                                        <div class="grid grid-cols-2">
                                            <div class="px-4 py-2 font-semibold">Last Name</div>
                                            <div class="px-4 py-2">{{ $employee->profile->last_name }}</div>
                                        </div>
                                        <div class="grid grid-cols-2">
                                            <div class="px-4 py-2 font-semibold">Gender</div>
                                            <div class="px-4 py-2">{{ $employee->profile->gender }}</div>
                                        </div>
                                        <div class="grid grid-cols-2">
                                            <div class="px-4 py-2 font-semibold">Contact No.</div>
                                            <div class="px-4 py-2">{{ $employee->profile->cell_no }}</div>
                                        </div>
                                        <div class="grid grid-cols-2">
                                            <div class="px-4 py-2 font-semibold">Current Address</div>
                                            <div class="px-4 py-2">{{ $employee->profile->address }}</div>
                                        </div>
                                        <div class="grid grid-cols-2">
                                            <div class="px-4 py-2 font-semibold">Email.</div>
                                            <div class="px-4 py-2">
                                                <a class="text-blue-800"
                                                    href="{{ $employee->email }}">{{ $employee->email }}</a>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-2">
                                            <div class="px-4 py-2 font-semibold">Birthday</div>
                                            <div class="px-4 py-2">{{ $employee->profile->birth_date }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endif
