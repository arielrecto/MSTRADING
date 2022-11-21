@props([
    'employee' => [],
    'positions' => []
])

<form method="POST" action="{{ route('admin.employee.update', ['id' => $employee->id]) }}">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col p-5 border border-2-solid bg-gray-50 border rounded-lg p-5 w-full">
                <h1 class="text-5xl font-bold">User info</h1>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-first-name">
                            Name
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 
rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="name" id="grid-first-name" type="text" placeholder="{{ $employee->name }}">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-first-name">
                            Email
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 
rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="email" id="grid-first-name" type="email" placeholder="{{ $employee->email }}">
                    </div>
                </div>
                <!-- profile -->

                <div class="text-5xl font-bold">
                    <h1>Profile</h1>
                    @foreach ($errors->all() as $error)
                        <div class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
                            role="alert"> <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">{{ $error }}</span>
                            </div>
                        </div>
                    @endforeach

                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-first-name">
                                First Name
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 
        rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="first_name" id="grid-first-name" type="text"
                                placeholder="{{ $employee->profile->first_name }}">
                        </div>
                        <div class="w-full md:w-1/3 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-last-name">
                                Middle Name
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 
        rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" name="middle_name" type="text"
                                placeholder="{{ $employee->profile->middle_name }}">
                        </div>
                        <div class="w-full md:w-1/3 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-last-name">
                                Last Name
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded 
        py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" name="last_name" type="text"
                                placeholder="{{ $employee->profile->last_name }}">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-city">
                                age
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 r
        ounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-city" name="age" type="text"
                                placeholder="{{ $employee->profile->age }}">
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-state">
                                Birthdate
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 r
        ounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-city" type="date" name="birth_date"
                                placeholder="{{ $employee->profile->birt_date }}">
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 capitalize"
                                for="grid-state">
                                marital status
                            </label>
                            <select name="marital_status" class="select select-info w-full max-w-xs">
                                <option disabled selected>Select Status</option>
                                <option value="merried">Merried</option>
                                <option value="single">Single</option>
                            </select>
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-state">
                                Religion
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 r
        ounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-city" type="text" name="religion"
                                placeholder="{{ $employee->profile->religion }}">
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-state">
                                Citizenship
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 r
        ounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-city" type="text" name="citizenship"
                                placeholder="{{ $employee->profile->citizenship }}">
                        </div>
                    </div>

                    <div class="py-2">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-state">
                            Address
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded 
        py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-last-name" name="address" type="text"
                            placeholder="{{ $employee->profile->address }}">
                    </div>
                    <div class="py-2">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-state">
                            Social Security Number / Goverment Number
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded 
        py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-last-name" name="social_num" type="text"
                            placeholder="{{ $employee->profile->social_num }}">
                    </div>

                    <div class="py-2">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-state">
                            Phil. Health
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded 
        py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-last-name" name="phil_health" type="text"
                            placeholder="{{ $employee->profile->phile_health }}">
                    </div>

                    <div class="py-2">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-state">
                            Pag Ibig
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded 
        py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-last-name" name="pag_ibig" type="text"
                            placeholder="{{ $employee->profile->pag_ibig }}">
                    </div>

                    <div class="py-2">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-state">
                            Tin No.
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded 
        py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-last-name" name="tin_no" type="text"
                            placeholder="{{ $employee->profile->tin_no }}">
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/3 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-last-name">
                                Cell Phone No.
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded 
        py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="grid-last-name" name="cell_no" type="text"
                                placeholder="{{ $employee->profile->cell_no }}">
                        </div>
                    </div>
                    <h1>Update Position</h1>
                    <div class="flex p-5">
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-first-name">
                                Position : {{$employee->position->name ?? ''}}
                            </label>
                            <select name="position" class="rounded rounded-l-lg select select-accent w-full max-w-xs">
                                <option disabled selected>Select</option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position['name'] }}">
                                        {{ $position['name'] ?? 'No Available Position' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button
                        class=" uppercase m-t-5 flex-shrink-0 bg-blue-600 hover:font-bold hover:bg-msblue-light border-msblue-medium hover:border-msblue-light border-4 text-white py-1 px-2 rounded"
                        type="submit">
                        save
                    </button>
                </div>
            </div>
        </div>
    </div>

</form>
