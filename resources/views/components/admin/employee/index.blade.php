@props(['employees' => []])




<div class="flex justify-center w-full p-10">
    <div class="grid grid-cols-4 gap-4 w-2/3">
        @forelse ($employees as $employee)
            <div class="rounded-3xl shadow-xl max-w-xs my-3 bg-blue-500">
                <div class="flex justify-center -mt-8">
                    @if($employee->image()->count() === 0)
                    <img src="https://xsgames.co/randomusers/avatar.php?g=male" alt="" class="h-auto w-20">
                    @else
                    <img src="{{asset('public/Image/' . $employee->image->image_dir)}}" alt="" class="h-auto w-20">
                    @endif
                </div>
                <div class="text-center px-3 pb-6 pt-2">
                    <h3 class="text-white text-sm bold font-sans">{{$employee->name}}</h3>

                    @if($employee->is_admin === '1')
                       <p class="mt-2 font-sans font-light text-white">Position: Admin</p>
                    @else 
                         <p class="mt-2 font-sans font-light text-white">Position: {{$employee->position->name ?? 'N/A'}}</p>
                    @endif

                    @if($employee->profile()->count() !== 0)
                    <h3 class="text-white text-sm bold font-sans">{{$employee->profile->status}}</h3>
                    @endif
                </div>
                
                <div class="flex justify-center pb-3 text-white">
                    <div class="text-center mr-3 border-r pr-3">
                        <a href="{{route('admin.employee.show', ['id'=> $employee->id])}}"> View Profile</a>
                    </div>
                    <div class="text-center">
                    </div>
                </div>
            </div>
        @empty
            no data
        @endforelse
    </div>
</div>
{{$employees->links()}}