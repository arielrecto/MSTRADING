@props([
    'employee' => [],
])

@inject('carbon', 'Carbon\Carbon')

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
                                <img class="h-auto w-full mx-auto" src="https://xsgames.co/randomusers/avatar.php?g=male"
                                    alt="">
                            @else
                                <img class="h-auto w-full mx-auto"
                                    src="{{ asset('public/Image/' . $employee->image->image_dir) }}" alt="">
                            @endif
                        </div>
                        <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">{{ $employee->name }}</h1>
                        <h3 class="text-gray-600 font-lg text-semibold leading-6">Position :
                            {{ $employee->position->name ?? 'N/A' }}</h3>
                        <h3 class="text-gray-600 font-lg text-semibold leading-6">Status :
                            {{ $employee->profile->status ?? 'N/A' }}</h3>
                        <p class="text-sm text-gray-500 hover:text-gray-600 leading-6"></p>
                        <ul
                            class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                            <li class="flex items-center py-3 space-x-2">
                                <span>Employee Type: </span>
                                <span class="ml-auto">{{ $employee->profile->employee_type }}</span>
                            </li>
                            <li class="flex items-center py-3">
                                <span>Member since</span>
                                <span class="ml-auto">{{ $employee->created_at }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="flex flex-col w-full">
                    <div class="w-full md:w-9/12 mx-2 h-64">
                        <div class="bg-white p-3 shadow-sm rounded-sm">
                            <div
                                class="flex justify-center text-lg font-semibold space-x-2 font-semibold text-gray-900 leading-8">
                                <h1>Employee Informtion</h1>
                            </div>
                            <div class="text-gray-700">
                                <div class="grid md:grid-cols-3 text-sm">
                                    <div class="grid grid-cols-1">
                                        <div class="px-2 py-2 font-semibold">First Name: </div>
                                        <div class="px-2 py-2">{{ $employee->profile->first_name }}</div>
                                    </div>
                                    <div class="grid grid-cols-1">
                                        <div class="px-2 py-2 font-semibold">Middle Name: </div>
                                        <div class="px-2 py-2">{{ $employee->profile->last_name }}</div>
                                    </div>
                                    <div class="grid grid-cols-1">
                                        <div class="px-2 py-2 font-semibold">Last Name: </div>
                                        <div class="px-2 py-2">{{ $employee->profile->last_name }}</div>
                                    </div>
                                </div>

                                <div class="grid md:grid-cols-1 text-sm">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Citizenship</div>
                                        <div class="px-4 py-2">{{ $employee->profile->citizenship }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Religion</div>
                                        <div class="px-4 py-2">{{ $employee->profile->religion}}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Birthday</div>
                                        <div class="px-4 py-2">
                                            {{ $carbon::parse($employee->profile->birth_date)->format('F  d Y') }}
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Gender</div>
                                        <div class="px-4 py-2">{{ $employee->profile->gender }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Marital Status</div>
                                        <div class="px-4 py-2">{{ $employee->profile->marital_status }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Current Address</div>
                                        <div>
                                            <div class="px-4 py-2">{{ $employee->profile->address }}</div>
                                            <div class="px-4 py-2">{{ $employee->profile->city }}</div>
                                            <div class="px-4 py-2">{{ $employee->profile->state }}</div>
                                            <div class="px-4 py-2">({{ $employee->profile->zipcode }})</div>

                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Contact No.</div>
                                        <div class="px-4 py-2">{{ $employee->profile->cell_no }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Land Line</div>
                                        <div class="px-4 py-2">{{ $employee->profile->telephone }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Phil Health</div>
                                        <div class="px-4 py-2">{{ $employee->profile->phil_health }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Pag Ibig</div>
                                        <div class="px-4 py-2">{{ $employee->profile->pag_ibig }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">SSS</div>
                                        <div class="px-4 py-2">{{ $employee->profile->social_num }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Tin no.</div>
                                        <div class="px-4 py-2">{{ $employee->profile->tin_no }}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Email.</div>
                                        <div class="px-4 py-2">
                                            <a class="text-blue-800" href="#">{{ $employee->email }}</a>
                                        </div>
                                    </div>

                                    <div class="flex justify-center text-lg font-semibold">
                                        <h1>Contact Person</h1>
                                    </div>
                                    <div class="grid md:grid-cols-3 text-sm">
                                        <div class="grid grid-cols-1">
                                            <div class="px-2 py-2 font-semibold">First Name: </div>
                                            <div class="px-2 py-2">{{ $employee->profile->contact_first_name }}</div>
                                        </div>
                                        <div class="grid grid-cols-1">
                                            <div class="px-2 py-2 font-semibold">Middle Name: </div>
                                            <div class="px-2 py-2">{{ $employee->profile->contact_middle_name }}</div>
                                        </div>
                                        <div class="grid grid-cols-1">
                                            <div class="px-2 py-2 font-semibold">Last Name: </div>
                                            <div class="px-2 py-2">{{ $employee->profile->contact_last_name }}</div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Contact No.</div>
                                        <div class="px-4 py-2">{{ $employee->profile->contact_cell_no }}</div>
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
