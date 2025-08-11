<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Permission/Create
            </h2>
            <a href="{{ route('permissions') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('role.edit.post', $role->id) }}" method="post">
                        @csrf
                        <div>
                            <label for="" class="text-sm font-medium">Name</label>
                            <div class="my-3">
                                <input placeholder="Enter Name" value="{{ $role->name }}" type="text"
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg " name="name" id="">
                                @error('name')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror

                            </div>
                            <div class="grid grid-cols-4">

                                @if ($permission->IsNotEmpty())
                                    @foreach ($permission as $value)
                                        <div class="mt-3">

                                            <input {{ $haspermissions->contains($value->name) ? 'checked' : '' }}
                                                type="checkbox" name="permissions[]" id="permission-{{ $value->id }}"
                                                class="rounded" value="{{ $value->name }}">
                                            <label for="permission-{{ $value->id }}">{{ $value->name }}</label>
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
