@inject('carbon', 'Carbon\Carbon')


<x-app-layout>
    <div class="flex w-full">
        <x-sidebar />
        <div class="flex flex-col w-full">
            <div class="w-full flex flex-row-reverse p-2">
                <label for="my-modal-3" class="btn btn-ghost">Add Goverment Agencies</label>
                {{-- <label for="my-modal-3"><a href="{{route('admin.tax.create')}}" class="btn btn-ghost">Add Tax</a></label> --}}
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
                            <th>Name</th>
                            <th>Rate</th>
                            <th>Range</th>
                            <th>Year</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($deductions as $deduction)
                            <tr>
                               <th>{{ $deduction->name }}</th>
                                <td> {{ $deduction->amount }} %</td>
                                <td>₱{{number_format($deduction->range, 2, '.', ',')}} - Above</td>
                                <td>{{$carbon::parse($deduction->created_at)->format('Y')}}</td>
                                <td>
                                    <form action="{{route('admin.deduction.destroy', ['id' => $deduction->id])}}" method="post">
                                        @csrf
                                        <button class="btn btn-error">Delete</button>
                                    </form>
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
            <form action="{{ route('admin.deduction.store') }}" method="POST" class="flex flex-col space-y-5">
                @csrf
                <h1 class="text-3xl capitalize">Deduction Salary</h1>
                <h1 class="">Goverment Agency</h1>
                <select name="name" class="select select-accent w-full">
                    <option disabled selected>Select Goverment Agency</option>
                    <option value="Phil Health">Phil Health</option>
                    <option value="SSS">SSS</option>
                    <option value="Pag Ibig">Pag Ibig</option>
                  </select>
                  <div class="form-control">
                    <h1>Salary Range</h1>
                    <label class="input-group input-group-md">
                      <span>₱</span>
                      <input type="text" name="range" placeholder="Salary Above" class="input input-bordered input-md w-full" />
                    </label>
                  </div>
                  <div class="form-control">
                    <label class="label">
                      <span class="label-text">Rate</span>
                    </label>
                    <label class="input-group">
                      <input name="amount" type="text" placeholder="" class="input input-bordered w-full" />
                      <span>%</span>
                    </label>
                  </div>
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
admin.attendance.index
