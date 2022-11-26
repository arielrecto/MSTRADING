<x-app-layout>
    <table class="table w-full">
        <!-- head -->
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Date Join</th>
                <th>Date Leave</th>
                <th>Reason</th>
            </tr>
        </thead>

    @forelse ($employees as $employee)
    
            <tr>
                <th>{{ $employee->id - 1}}</th>
                <td>{{ $employee->name }}</td>
                <td>{{$employee->created_at}}</td>
                <td>{{$employee->deleted_at}}</td>
                <td>{{$employee->reason}}</td>
            </tr>
            <tbody>
            @empty
                no data
    @endforelse
    </tbody>
    </table>
</x-app-layout>
