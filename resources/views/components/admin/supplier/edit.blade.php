<x-app-layout>
    <div class="flex w-full">
        <x-sidebar />
        <div class="flex flex-col w-full">

            <div class="flex justify-center">
                <div class="tabs">
                    <a href="{{ route('admin.product.index') }}" class="tab tab-lg tab-bordered ">Order Products</a>
                    <a href="" class="tab tab-lg tab-bordered">Arrived Products</a>
                    <a href="" class="tab tab-lg tab-bordered">Product Stocks</a>
                    <a href="" class="tab tab-lg tab-bordered">Pop Products</a>
                    <a href="{{ route('admin.supplier.index') }}"
                        class="tab tab-lg tab-bordered tab-active">Supplier</a>
                </div>
            </div>

            @if(Session::has('message'))
            <div class="alert alert-success shadow-lg">
                <div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                  <span>{{Session::get('message')}}</span>

                  <a href="{{route('admin.supplier.index')}}" class="link">Go to Index view</a>
                </div>
              </div>
            @endif

            <form action="{{route('admin.supplier.update', ['id' => $supplier->id])}}" method="post">
                @if ($errors->any())


                <div class="alert alert-error shadow-lg">
                    <div>
                      <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                      <span>{{ implode('', $errors->all('<div>:message</div>')) }}</span>
                    </div>
                  </div>
                @endif

                @csrf
                <div class="w-full p-5">
                    <div class="overflow-x-auto p-2 bg-white border border-grey-3 rounded-lg" x-data="$store.view">
                        <div class="w-full">
                            <div class="w-full flex justify-center font-bold">
                                <h1 class="text-3xl">Supplier Update Information</h1>
                            </div>
                            <div class="py-2">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-state">
                                    Name
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded 
                py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" name="name" type="text" placeholder="{{$supplier->name}}">
                            </div>
                            <div class="py-2">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-state">
                                    Address
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded 
                py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" name="address" type="text" placeholder="{{$supplier->address}}">
                            </div>

                            <div class="py-2">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-state">
                                    Contact
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded 
                py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="grid-last-name" name="contact" type="text" placeholder="{{$supplier->contact ?? 'N/A'}}">
                    </div>


                    <div class="flex justify-center">
                            <button class="btn btn-wide btn-success">
                                <i class="ri-save-line px-2 h-4"></i>
                                 Save</button>
                    </div>
                </div>
            </form>
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
