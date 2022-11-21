<x-app-layout>
    <div class="flex w-full">

        <x-sidebar />
        <div class="w-full p-10">
            <form method="POST" action="{{ route('admin.product.store') }}">

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

                {{-- @foreach ($errors->all() as $error)
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
                @endforeach --}}

                @csrf
                <h1 class="text-3xl ">Product Information</h1>
                <div class="flex flex-wrap -mx-3 mb-6">

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-first-name">
                            Name
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 
        rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="product_name" id="grid-first-name" type="text" placeholder="">
                    </div>
                  
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-state">
                            Category
                        </label>
                        <select name="category" class="select w-full max-w-xs">
                            <option disabled selected>Select Category</option>

                            @forelse ($categories as $category)
                                <option value="{{$category->name}}">{{ $category->name }}</option>
                            @empty
                                <option>No Category Available</option>
                            @endforelse
                        </select>
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-state">
                            Supplier 
                        </label>
                        <select name="supplier" class="select w-full max-w-xs">
                            <option disabled selected>Select Category</option>

                            @forelse ($suppliers as $supplier)
                                <option value="{{$supplier->name}}">{{ $supplier->name }}</option>
                            @empty
                                <option>No Category Available</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-state">
                            Quantity
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 r
        ounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-city" type="text" name="quantity" placeholder="">
                    </div>
                </div>
                <div class="w-full">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                        description
                    </label>
                    <textarea class="textarea w-full" name="description" placeholder="Description"></textarea>
                </div>
                <button
                    class=" m-t-5 flex-shrink-0 bg-blue-600 hover:font-bold hover:bg-msblue-light border-msblue-medium hover:border-msblue-light border-4 text-white py-1 px-2 rounded"
                    type="submit">
                    CREATE
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
