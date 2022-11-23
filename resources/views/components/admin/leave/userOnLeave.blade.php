<x-app-layout>
    <div class="flex w-full">
        <x-sidebar />
        <div class="flex flex-col w-full">
            <div class="overflow-x-auto" x-data="$store.view">

                <div class="flex justify-center">
                    <div class="tabs">
                        <a href="{{ route('admin.absent.index') }}" class="tab tab-lg tab-bordered">Request</a>
                        <a href="{{route('admin.absent.usersOnLeave')}}" class="tab tab-lg tab-bordered tab-active">Employee On Leave</a>
                    </div>
                </div>
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
                            <th>Reason</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                               <th>{{$user->name}}</th>
                                
                               
                                    @foreach ( $user->absences()->get() as $absent )
                                        <td>{{$absent->reason}}</td>
                                        <td>{{$absent->log_date}}</td>
                                    @endforeach
                              
                                <td>{{$user->on_leave === '1' ? 'On Leave' : 'Active'}}</td>
                                <td>
                                    <form action="{{route('admin.absent.userActive' ,['id' => $user->id])}}" method="post">
                                        @csrf
                                        <input type="hidden" name="active" value="false">
                                        <button class="btn btn-success">Set Active</button>
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

