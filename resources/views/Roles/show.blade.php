<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                All Permissions
            </h2>
            <a href="{{ route('roles.create') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">Create</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('message')

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr class="border-b">
                            <th class="px-6 py-5 text-left">Name</th>
                            <th class="px-6 py-5 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @if ($roles->isNotEmpty())
                            @foreach ($roles as $value)
                                <tr class="border-b">
                                    <td class="px-6 py-5">{{ $value->name }}</td>

                                    <td class="px-6 py-5">
                                        {{ $value->permissions->pluck('name')->implode(',') }}
                                    </td>
                                    <td class="px-6 py-5 flex gap-2">
                                        <a href="{{ route('role.edit', $value->id) }}"
                                            class="bg-slate-700 text-sm rounded-md text-white px-2 py-1">Update</a>
                                        <a href="{{ route('role.delete', $value->id) }}"
                                            class="bg-red-700 text-sm rounded-md text-white px-2 py-1">Delete</a>


                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="px-6 py-5 text-center text-gray-500">No permissions found.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="py-2">
                    {{ $roles->links() }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
