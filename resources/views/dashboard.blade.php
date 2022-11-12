<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="overflow-x-auto">
                <table class="table w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Name</th>
                            <th>no. attendance</th>
                            <th>Favorite Color</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $employees as $employee)
            
                        <tr>
                            <th>{{$employee->id}}</th>
                            <td>{{$employee->name}}</td>
                            <td>{{$employee->attendances()->count()}}</td>
                            <td>Blue</td>
                        </tr>

                            
                        @empty
                        <div class="alert alert-warning shadow-lg">
                            <div>
                              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                              <span>No Data</span>
                            </div>
                          </div>
                        @endforelse
                    
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
