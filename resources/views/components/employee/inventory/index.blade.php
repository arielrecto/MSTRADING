<x-app-layout>



    <div class="w-full flex justify-center p-5 ">
        <div class="overflow-x-auto w-3/4" x-data="$store.view">
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span> {!! implode('', $errors->all('<div>:message</div>')) !!}</span>
                        </div>
                    </div>
                @endif
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <th>{{ $product->id }}</th>
                            <td>
                                {{ $product->product_code }}
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>
                                {{ $product->supplier->name }}
                            </td>
                            <td>
                                <div class="flex space-x-5">
                                    <form action="{{ route('dashboard.getItemPop', ['id' => $product->id]) }}"
                                        method="post">
                                        @csrf
                                        <div class="form-control">
                                            <label class="input-group">
                                                <input type="text" name="quantity" placeholder="Enter Quantity"
                                                    class="input input-bordered" />
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


    </div>

</x-app-layout>
