@props([
    'employee' => [],
])

@inject('carbon', 'Carbon\Carbon')
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
                                    <span>{{ $employee->profile->employee_type ?? '' }}</span>
                                </li>
                                <li class="flex items-center py-3">
                                    <span>Member since</span>
                                    <span
                                        class="ml-auto">{{ $carbon::parse($employee->created_at)->format('F d Y') }}</span>
                                </li>
                                <li class="flex items-center py-3 space-x-10">
                                    <label for="my-modal-3" class="btn btn-error">Archive</label>
                                    <div>
                                        <a href="{{ route('admin.employee.edit', ['id' => $employee->id]) }}">
                                            <button class="btn btn-ghost">Update</button>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    @if ($employee->profile->status === 'New Employee')
                                        <div class="flex justify-center">
                                            <form
                                                action="{{ route('admin.employee.regular', ['id' => $employee->id]) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="regular" value="Regular Employee">
                                                <button type="submit" class=" btn btn-ghost">Promote as
                                                    Regular</button>
                                            </form>
                                        </div>
                                    @endif
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
                                    <div class="grid md:grid-cols-3 text-lg">
                                        <div class="grid grid-cols-1">
                                            <div class="px-2 py-2 font-bold">First Name: </div>
                                            <div class="px-2 py-2">{{ $employee->profile->first_name }}</div>
                                        </div>
                                        <div class="grid grid-cols-1">
                                            <div class="px-2 py-2 font-bold">Middle Name: </div>
                                            <div class="px-2 py-2">{{ $employee->profile->last_name }}</div>
                                        </div>
                                        <div class="grid grid-cols-1">
                                            <div class="px-2 py-2 font-bold">Last Name: </div>
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
                                            <div class="px-4 py-2">{{ $employee->profile->religion }}</div>
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
                                                <div class="px-2 py-2">{{ $employee->profile->contact_first_name }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-1">
                                                <div class="px-2 py-2 font-semibold">Middle Name: </div>
                                                <div class="px-2 py-2">{{ $employee->profile->contact_middle_name }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-1">
                                                <div class="px-2 py-2 font-semibold">Last Name: </div>
                                                <div class="px-2 py-2">{{ $employee->profile->contact_last_name }}
                                                </div>
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


    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="my-modal-3" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box relative">
            <label for="my-modal-3" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>

            <form action="{{ route('admin.employee.delete', ['id' => $employee->id]) }}" method="post"
                class="flex flex-col space-y-5" x-data="{ open: false }">
                @csrf
                <h3 class="text-lg font-bold">Reason</h3>
                <div class="flex">
                    <select name="reason_select" class="select select-accent w-full max-w-xs">
                        <option disabled selected>Select Reason</option>
                        <option value="End Contract">End Contract</option>
                        <option value="Awol">Awol</option>
                    </select>
                    <div class="p-2">
                        <h1 @click="open = ! open">Others</h1>
                    </div>

                </div>
                <div x-show="open" x-transition.duration.700ms>
                    <input type="text" name="reason" placeholder="Other Reason"
                        class="input input-bordered input-accent w-full max-w-xs" />
                </div>
                <div class="flex justify-center">
                    <button class="btn btn-error">Delete</button>
                </div>

            </form>
        </div>
    </div>
@endif
