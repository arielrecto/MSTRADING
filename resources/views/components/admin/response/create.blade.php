<x-app-layout>
    <div class="flex w-full">

        <x-sidebar />
        <div class="w-full p-10 flex justify-center">
            <form method="POST" action="{{route('admin.response.store', ['id' => $absent->id]) }}" class="w-1/2 bg-white h-auto p-5 rounded-lg">
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

                @csrf

                <div class="flex justify-center">
                    <h1 class="text-3xl ">Response</h1>
                </div>
                <div class="flex flex-col text-lg fond-semibold">
                    <div class="flex space-x-5">
                        <h1>Response to: </h1>
                        <h1 class="font-bold">{{ $absent->user->name }}</h1>
                    </div>

                    <div>
                        <h1 class="font-bold text-gray-500">
                            Message: 
                        </h1>
                        <h1>
                            {{$absent->reason}}
                        </h1>
                    </div>

                </div>

                <div class="flex flex-col p-5 space-y-5">
                    <div>
                        <label class="uppercase text-grey-100 font-bold text-xl">Title</label>
                        <input type="text" placeholder="Type here"
                            class="input input-bordered input-accent w-full" name="title"/>
                    </div>
                    <div>
                        <label class="uppercase text-grey-100 font-bold text-xl">Reason</label>
                        <textarea class="textarea textarea-accent w-full h-80" name="reason" placeholder="Reason"></textarea>

                    </div>
                </div>
                <div class="flex justify-center">
                    <button
                        class=" m-t-5 flex-shrink-0 bg-blue-600 hover:font-bold hover:bg-msblue-light border-msblue-medium hover:border-msblue-light border-4 text-white py-1 px-2 rounded"
                        type="submit">
                        Send
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
