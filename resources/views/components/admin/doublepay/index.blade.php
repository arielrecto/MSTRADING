@inject('carbon', 'Carbon\Carbon')


<x-app-layout>
    <div class="flex w-full">
        <x-sidebar />
        <div class="flex flex-col w-full">
            <div class="w-full flex flex-row-reverse p-2">
                <label for="my-modal-3" class="btn btn-ghost">Add Double Pay</label>
            </div>
            <div class="overflow-x-auto" x-data="$store.view">
                <table class="table w-full">

                    @if ($errors->any())
                        <div class="alert alert-error shadow-lg">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{!! implode('', $errors->all('<div>:message</div>')) !!}</span>
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

                    <!-- head -->
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>rate</th>
                            <th>type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>edit status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($doublePays as $doublePay)
                            <tr>
                                <th>{{ $doublePay->name }}</th>
                                <th>{{ $doublePay->type }}</th>
                                <td>{{ $doublePay->rate }}</td>
                                <td>{{ $carbon::parse($doublePay->date_start)->format('F d Y') }}</td>
                                <td>{{ $carbon::parse($doublePay->date_end)->format('F d Y') }}</td>
                                <td>{{ $doublePay->is_active ? 'Active' : 'End' }}</td>
                                <td>
                                    <div class="flex space-x-5">
                                        <form action="{{ route('admin.doublepay.inactive', ['id' => $doublePay->id]) }}"
                                            method="post">
                                            @csrf
                                            <button class="btn btn-warning">End</button>
                                        </form>
                                        <form action="{{route('admin.doublepay.delete', ['id' => $doublePay->id])}}" method="post">
                                            @csrf
                                            <button class="btn btn-error">Delete</button>
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
    </div>


    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="my-modal-3" class="modal-toggle" />
    <div class="modal p-10">
        <div class="modal-box relative bg-white">
            <label for="my-modal-3" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
            <form action="{{ route('admin.doublepay.store') }}" method="POST" class="flex flex-col space-y-5">
                @csrf
                <h1 class="3xl capitalize">Set Double Pay</h1>
                <input type="text" placeholder="name" name="name"
                    class="input input-bordered input-info w-full" />
                <input type="text" placeholder="rate" name="rate"
                    class="input input-bordered input-info w-full " />
                <select name="type" class="select select-accent w-full">
                    <option disabled selected>Select Type</option>
                    <option>Holiday</option>
                    {{-- <option>Dark mode</option>
                        <option>Light mode</option> --}}
                </select>
                <label for="date_start" class="label ">Start Date</label>
                <input type="date" placeholder="Start Date" name="date_start"
                    class="input input-bordered input-info w-full " />
                <label for="date_end">End Date</label>
                <input type="date" placeholder="Date End" name="date_end"
                    class="input input-bordered input-info w-full " />
                <button class="btn btn-success">Add</button>
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
