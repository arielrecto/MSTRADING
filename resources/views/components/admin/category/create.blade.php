<x-app-layout>
    <div class="flex w-full">

        <x-sidebar />
        <div class="w-full p-10">
            <form method="POST" action="{{ route('admin.category.store') }}">
                @if ($errors->any())

                <div class="alert alert-error shadow-lg">
                    <div>
                      <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                      <span> {!! implode('', $errors->all('<div>:message</div>')) !!}</span>
                    </div>
                </div>
                @endif

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

                @csrf
                <h1 class="text-3xl ">Category</h1>
                <div class="flex flex-wrap -mx-3 mb-6">

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-first-name">
                            Name
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 
        rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="name" id="grid-first-name" type="text" placeholder="Category Name">
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-state">
                            Category Code
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 r
        ounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="grid-city" type="text" name="category_code" placeholder="BS-100">
                    </div>
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
