<x-app-layout>
    <div class="flex w-full">
        <x-sidebar />
        <div class="flex flex-col w-full">
           
            <div class="flex justify-center">
                <div class="tabs">
                    <a href="{{ route('admin.product.index') }}" class="tab tab-lg tab-bordered">Order Products</a>
                    <a href="{{route('admin.product.recieved')}}" class="tab tab-lg tab-bordered">Arrived Products</a>
                    <a href="{{route('admin.product.stock')}}" class="tab tab-lg tab-bordered">Product Stocks</a>
                    <a href="{{route('admin.product.pop')}}" class="tab tab-lg tab-bordered">Pop Products</a>
                    <a href="{{route('admin.supplier.index')}}" class="tab tab-lg tab-bordered">Supplier</a>
                    <a href="{{route('admin.category.index')}}" class="tab tab-lg tab-bordered tab-active">Category</a>
                    <a href="{{route('admin.product.record')}}" class="tab tab-lg tab-bordered">Record</a>
                </div>
            </div>



            <div class="w-full flex flex-row-reverse p-5">
                <a href="{{route('admin.category.create')}}">
                    <button class="btn btn-success">Add Category</button>
                </a>
            </div>
            <div class="overflow-x-auto" x-data="$store.view">
                <table class="table w-full">


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

                    <!-- head -->
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Action</th>
                            {{-- <th>category</th>
                            <th>Supplier Name</th>
                            <th>Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category) 
                            <tr>
                                <th>{{$category->name}}</th>
                                <td>{{$category->category_code}}</td>
                                <td>
                                    <div class="flex space-x-5">
                                        <a class="bg-green-300 p-2 rounded-lg" href="http://">
                                            <i class="ri-eye-line"> </i>
                                        </a>
                                        {{-- <a href="{{route('admin.supplier.edit', ['id' => $supplier ?? ''])}}" class="bg-blue-300 p-2 rounded-lg" href="http://">
                                            <i class="ri-edit-box-line"></i>
                                        </a> --}}
                                        <a class="bg-red-300 p-2 rounded-lg" href="http://">
                                            <i class="ri-delete-bin-line"></i>
                                        </a>
                                    </div>
                                </td>   
                                <td>
                                    <div class="flex space-x-5">
                                        {{-- <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}">
                                            <button class="btn btn-ghost">Edit</button>
                                        </a>
                                        <form action="{{ route('admin.product.delete', ['id' => $product->id]) }}"
                                            method="post">
                                            @csrf
                                            <button class="btn btn-error">Delete</button>
                                        </form> --}}
                                    </div>
                                </td>
                                <td>
                                </td>

                            </tr>
                        @empty

                            <div class="alert alert-warning shadow-lg">
                                <div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <span>No Data</span>
                                </div>
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <a href="{{ route('admin.product.archive') }}" class="link">View Achive</a>
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
