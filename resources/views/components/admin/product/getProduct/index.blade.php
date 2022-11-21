<x-app-layout>
    <div class="flex w-full">
        <x-sidebar />
        <div class="flex flex-col w-full">

            <div class="flex justify-center">
                <div class="tabs">
                    <a href="{{route('admin.product.index')}}" class="tab tab-lg tab-bordered">Order Products</a>
                    <a href="{{route('admin.product.recieved')}}" class="tab tab-lg tab-bordered">Arrived Products</a>
                    <a href="{{route('admin.product.stock')}}" class="tab tab-lg tab-bordered">Product Stocks</a>
                    <a href="{{route('admin.product.pop')}}" class="tab tab-lg tab-bordered tab-active">Pop Products</a>
                    <a href="{{route('admin.supplier.index')}}" class="tab tab-lg tab-bordered">Supplier</a>
                    <a href="{{route('admin.category.index')}}" class="tab tab-lg tab-bordered">Category</a>
                    <a href="{{route('admin.category.index')}}" class="tab tab-lg tab-bordered">Record</a>
                </div>
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
                            <th>id</th>
                            <th>Product Code</th>
                            <th>Name</th>
                            <th>description</th>
                            <th>quantity</th>
                            <th>category</th>
                            <th>Supplier Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>


                    @if ($errors->any())

                    <div class="alert alert-error shadow-lg">
                        <div>
                          <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                          <span> {!! implode('', $errors->all('<div>:message</div>')) !!}</span>
                        </div>
                    </div>
                    @endif
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <th>{{ $product->id }}</th>
                                <td>
                                    {{$product->product_code}}
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>
                                    {{$product->supplier->name}}
                                </td>
                                <td>
                                    <div class="flex space-x-5">
                                        <form action="{{route('admin.product.popStore', ['id' => $product->id])}}"
                                            method="post">
                                            @csrf
                                            <div class="form-control">
                                                <label class="input-group">
                                                  <input type="text" name="quantity" placeholder="Enter Quantity" class="input input-bordered" />
                                                  <span><button>GET ITEM</button></span>
                                                </label>
                                              </div>
                                        </form>
                                    </div>
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
