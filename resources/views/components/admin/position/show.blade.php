<x-app-layout>
    <div class="flex w-full">
        <x-sidebar />
        <div class="flex flex-col w-full">
            <div class="w-full flex flex-row-reverse p-2">
                <label for="my-modal-3" class="btn btn-ghost">Add Position</label>
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
                            <th>Position</th>
                            <th>Work Hours</th>
                            <th>Break Hours</th>
                            <th>Salary Rate</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($positions as $position)
                            <tr>
                                <th>{{ $position->name }}</th>
                                <td> {{ $position->hours_work }}</td>
                                <td> {{ $position->break_hours }}</td>
                                <td> ₱ {{ $position->salary_rate }}</td>
                                <td>
                                    <div class="flex space-x-5">
                                        <div>
                                            <a href="{{ route('admin.position.edit', ['id' => $position->id]) }}"><button
                                                    class="btn btn-success"><i class="ri-pencil-line"></i></button></a>
                                        </div>
                                        <div>
                                            <form action="{{route('admin.position.delete', ['id' => $position->id])}}" method="post">
                                                @csrf
                                                <button class="btn btn-error"><i
                                                        class="ri-delete-bin-line"></i></button>
                                            </form>
                                        </div>
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
            <form action="{{ route('admin.position.create') }}" method="POST" class="flex flex-col space-y-5">
                @csrf
                <h1 class="3xl capitalize">Add Position & Salary</h1>
                <input type="text" placeholder="Position Name" name="name"
                    class="input input-bordered input-info w-full" />
                <input type="text" placeholder="Salary Rate" name="salary_rate"
                    class="input input-bordered input-info w-full " />
                <input type="text" placeholder="Hours Work" name="hours_work"
                    class="input input-bordered input-info w-full " />
                <input type="text" placeholder="Break Hours" name="break_hours"
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
