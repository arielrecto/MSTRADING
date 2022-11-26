<x-app-layout>
    <div class="flex w-full">
        <x-sidebar />
        <div class="flex flex-col w-full">

            <div class="flex justify-center">
                <div class="tabs">
                    <a href="{{ route('admin.product.index') }}" class="tab tab-lg tab-bordered ">Order Products</a>
                    <a href="{{route('admin.product.recieved')}}" class="tab tab-lg tab-bordered">Arrived Products</a>
                    <a href="{{route('admin.product.stock')}}" class="tab tab-lg tab-bordered">Product Stocks</a>
                    <a href="{{route('admin.product.pop')}}" class="tab tab-lg tab-bordered">Pop Products</a>
                    <a href="{{ route('admin.supplier.index') }}"
                        class="tab tab-lg tab-bordered tab-active">Supplier</a>
                </div>
            </div>
            <div class="flex justify-center">
                <div class="w-1/2 p-5">
                    <div class="overflow-x-auto p-2 bg-white border border-grey-3 rounded-lg" x-data="$store.view">
                        <div class="w-full p-5">
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
                            <div class="w-full flex justify-center font-bold">
                                <h1 class="text-3xl">Supplier Info</h1>
                            </div>
                            <div class="py-2">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-state">
                                    company name
                                </label>
                                <label class="font-bold text-xl">
                                    {{$supplier->name}}
                                </label>
                            </div>
                            <div class="py-2">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-state">
                                    Address
                                </label>
                               <label class="font-bold text-xl">
                                {{$supplier->address}}
                               </label>
                            </div>

                            <div class="py-2">
                                <div class="form-control mb-2">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="grid-state">
                                        Cell Phone #
                                    </label>
                                    <label class="font-bold text-xl">
                                        {{$supplier->contact}}
                                    </label>
                                </div>
                            </div>
                            <div class="flex flex-col p-5">
                                <div class="flex justify-center text-lg font-semibold uppercase">
                                    <h1>Contact Person</h1>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="py-2">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-state">
                                            first name
                                        </label>
                                       <label for="" class="font-bold text-xl">
                                        {{$supplier->first_name}}
                                       </label>
                                    </div>
                                    <div class="py-2">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="grid-state">
                                            last name
                                        </label>
                                        <label for="" class="font-bold text-xl">
                                            {{$supplier->last_name}}
                                        </label>
                                    </div>
                                </div>
                                <div class="py-2">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="grid-state">
                                        position
                                    </label>
                                    <label for="" class="font-bold text-xl">{{$supplier->position}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.store('view', {
                    on: false,

                    toggle() {
                        this.on = !this.on
                    }
                })
            })
        </script>
</x-app-layout>
