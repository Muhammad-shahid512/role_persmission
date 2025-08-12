<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User/Edit
            </h2>
            <a href="{{ route('users') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('update', $user->id) }}" method="post">
                        @csrf
                        <div>
                            <label for="" class="text-sm font-medium">Name</label>
                            <div class="my-3">
                                <input placeholder="Enter Name" value="{{ old('name', $user->name) }}" type="text"
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg " name="name" id="">
                                @error('name')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror

                            </div>
                            <label for="" class="text-sm font-medium">Name</label>
                            <div class="my-3">
                                <input placeholder="Enter Name" value="{{ old('email', $user->email) }}" type="text"
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg " name="email" id="">
                                @error('name')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror

                            </div>
                            <div class="grid grid-cols-4">

                                @if ($roles->IsNotEmpty())
                                    @foreach ($roles as $value)
                                        <div class="mt-3">

                                            <input {{ $hasroles->contains($value->id) ? 'checked' : '' }}
                                                type="checkbox" name="roles[]" id="roles-{{ $value->id }}"
                                                class="rounded" value="{{ $value->name }}">
                                            <label for="roles-{{ $value->id }}">{{ $value->name }}</label>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                            <button class="bg-slate-700 text-sm rounded-md text-white mt-5 px-5 py-3">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
