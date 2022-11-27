@props([
    'employee' => [],
    'positions' => [],
])

<form method="POST" action="{{route('admin.employee.update', ['id' => $employee->id])}}" enctype="multipart/form-data">
    @foreach ($errors->all() as $error)
        <div class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
            role="alert"> <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor"
                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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

    <div>
        <div class="image">
            <label>
                <h4>Add image</h4>
            </label>

            <input type="file" class="file-input file-input-bordered file-input-accent w-full max-w-xs"
                name="image_dir" />

        </div>

    </div>

    @csrf
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                First Name
            </label>
            <input
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 
    rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                name="first_name" id="grid-first-name" type="text" placeholder="{{$employee->profile->first_name}}">
        </div>
        <div class="w-full md:w-1/3 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                Middle Name
            </label>
            <input
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 
    rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="grid-last-name" name="middle_name" type="text" placeholder="{{$employee->profile->middle_name}}">
        </div>
        <div class="w-full md:w-1/3 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                Last Name
            </label>
            <input
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded 
    py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="grid-last-name" name="last_name" type="text" placeholder="{{$employee->profile->last_name}}">
        </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-2">
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                age
            </label>
            <input
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 r
    ounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="grid-city" name="age" type="text" placeholder="{{$employee->profile->age}}">
        </div>
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                Birthdate
            </label>
            <input
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 r
    ounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="grid-city" type="date" name="birth_date" placeholder="{{$employee->profile->birth_date}}">
        </div>
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 capitalize"
                for="grid-state">
                Gender
            </label>
            <select name="gender" class="select select-info w-full max-w-xs">
                <option disabled selected>{{$employee->profile->gender}}</option>
                <option value="Female">Female</option>
                <option value="Male">Male</option>
            </select>
        </div>
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 capitalize"
                for="grid-state">
                marital status
            </label>
            <select name="marital_status" class="select select-info w-full max-w-xs">
                <option disabled selected>{{$employee->profile->marital_status}}</option>
                <option value="merried">Married</option>
                <option value="single">Single</option>
            </select>
        </div>
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                Religion
            </label>

            <select name="religion" class="select select-accent w-full max-w-xs">
                <option disabled selected>{{$employee->profile->religion}}</option>
                <option>Born Again</option>
                <option>Catholic</option>
                <option>Muslim</option>
                <option>Other</option>
            </select>
        </div>
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                Citizenship
            </label>
            <select name="citizenship" class="select select-accent w-full max-w-xs">
                <option disabled selected>{{$employee->profile->citizenship}}</option>
                <option>Pilipino</option>
                <option>Other</option>
            </select>
        </div>
    </div>

    <div class="flex flex-wrap -mx-3 mb-6">

        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                Address
            </label>
            <input
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 
rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                name="address" id="grid-first-name" type="text" placeholder="{{$employee->profile->address}}">
        </div>

        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                City
            </label>
            <input
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 
rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                name="city" id="grid-first-name" type="text" placeholder="{{$employee->profile->city}}">
        </div>

        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                State/Province
            </label>
            <select name="state" class="select select-accent w-full max-w-xs">
                <option disabled selected>{{$employee->profile->state}}</option>
                <option value="Region 1 - Ilocos Region">Region 1 - Ilocos Region</option>
                <option value="Region II – Cagayan Valley">Region II – Cagayan Valley</option>
                <option value="Region III – Central Luzon">Region III – Central Luzon</option>
                <option value="Region IV‑A – CALABARZON">Region IV‑A – CALABARZON</option>
                <option value="MIMAROPA Region">MIMAROPA Region</option>
                <option value="Region V – Bicol Region">Region V – Bicol Region</option>
                <option value="Region VI – Western Visayas">Region VI – Western Visayas</option>
                <option value="Region IV‑A – CALABARZON">Region IV‑A – CALABARZON</option>
                <option value="Region VII – Central Visayas">Region VII – Central Visayas</option>
                <option value="Region VIII – Eastern Visayas">Region VIII – Eastern Visayas</option>
                <option value="Region IX – Zamboanga Peninsula">Region IX – Zamboanga Peninsula</option>
                <option value="Region XI – Davao Region">Region XI – Davao Region</option>
                <option value="Region XII – SOCCSKSARGEN">Region XII – SOCCSKSARGEN</option>
                <option value="Region XIII – Caraga">Region XIII – Caraga</option>
                <option value="NCR – National Capital Region">NCR – National Capital Region</option>
                <option value="CAR – Cordillera Administrative Region">CAR – Cordillera Administrative Region</option>
                <option value="BARMM – Bangsamoro Autonomous Region in Muslim Mindanao">BARMM – Bangsamoro Autonomous
                    Region in Muslim Mindanao</option>

            </select>
        </div>

        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                ZIP/POSTAL CODE
            </label>
            <input
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 
rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                name="zipcode" id="grid-first-name" type="text" placeholder="{{$employee->profile->zipcode}}">
        </div>

    </div>

    <div class="py-2">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
            Social Security Number / Goverment Number
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded 
    py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="grid-last-name" name="social_num" type="text" placeholder="{{$employee->profile->social_num}}">
    </div>

    <div class="py-2">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
            Phil. Health
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded 
    py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="grid-last-name" name="phil_health" type="text" placeholder="{{$employee->profile->phil_health}}">
    </div>

    <div class="py-2">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
            Pag Ibig
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded 
    py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="grid-last-name" name="pag_ibig" type="text" placeholder="{{$employee->profile->pag_ibig}}">
    </div>

    <div class="py-2">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
            Tin No.
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded 
    py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="grid-last-name" name="tin_no" type="text" placeholder="{{$employee->profile->tin_no}}">
    </div>

    <div class="form-control mb-2">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
            Cell Phone #
        </label>
        <label class="input-group input-group-lg">
            <span>+63</span>
            <input type="hidden" name="cell_prefix" value="+63">
            <input type="text" placeholder="{{$employee->profile->cell_no}}" name="cell_no" maxlength="10"
                class="input input-bordered w-1/2" />
        </label>
    </div>

    <div class="form-control mb-2">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
            Telephone #
        </label>
        <label class="input-group input-group-lg">
            <span>
                Tel
            </span>
            <input type="tel" placeholder="123-45-678" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}"
                class="input input-bordered w-1/2" />
        </label>
    </div>

    <div class="flex justify-center text-lg fond-semibold">
        <h1>Contact Person</h1>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                First Name
            </label>
            <input
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 
    rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                name="contact_first_name" id="grid-first-name" type="text" placeholder="{{$employee->profile->contact_first_name}}">
        </div>
        <div class="w-full md:w-1/3 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                Middle Name
            </label>
            <input
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 
    rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="grid-last-name" name="contact_middle_name" type="text" placeholder="{{$employee->profile->contact_middle_name}}">
        </div>
        <div class="w-full md:w-1/3 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                Last Name
            </label>
            <input
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded 
    py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="grid-last-name" name="contact_last_name" type="text" placeholder="{{$employee->profile->contact_last_name}}">
        </div>
    </div>

    <div class="form-control mb-2">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
            Cell Phone #
        </label>
        <label class="input-group input-group-lg">
            <span>+63</span>
            <input type="text" placeholder="{{$employee->profile->cell_no}}" name="contact_cell_no" maxlength="10"
                class="input input-bordered w-1/2" />
        </label>
    </div>

    <div class="flex flex-col text-lg">
        <h1 class="text-xl">Update Position</h1>
        <div class="flex p-5">
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                    for="grid-first-name">
                    Position : {{ $employee->position->name ?? '' }}
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
    </div>

    <div class="flex flex-col p-5">
        <h1>Employee Type</h1>
        <select name="employee_type" class="select select-accent w-full max-w-xs">
            <option disabled selected>Select Employee Type</option>
            <option value="Full Time">Full Time</option>
            <option value="Part Time">Part Time</option>
          </select>
    </div>
    
    <button
        class=" m-t-5 flex-shrink-0 bg-blue-600 hover:font-bold hover:bg-msblue-light border-msblue-medium hover:border-msblue-light border-4 text-white py-1 px-2 rounded"
        type="submit">
        Update
    </button>
</form>
