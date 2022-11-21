<x-app-layout>

    @forelse ($employees as $employee)
        <table class="table w-full">
            <!-- head -->
            <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tr>
                <th>{{ $employee->id - 1}}</th>
                <td>{{ $employee->name }}</td>
                <td>
                    <div class="flex space-x-10">
                        <button class="btn btn-error">Delete</button>
                        <button class="btn btn-ghost">Restore</button>
                    </div>
                </td>
            </tr>
            <tbody>
            @empty
                no data
    @endforelse
    </tbody>
    </table>
</x-app-layout>
