<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                All Articles
            </h2>
            @can('create articles')
                <a href="{{ route('article.create') }}"
                    class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">Create</a>
            @endcan

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('message')

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr class="border-b">
                            <th class="px-6 py-5 text-left">Title</th>
                            <th class="px-6 py-5 text-left">Author</th>
                            <th class="px-6 py-5 text-left">Created At</th>
                            <th class="px-6 py-5 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @if ($article->isNotEmpty())
                            @foreach ($article as $value)
                                <tr class="border-b">
                                    <td class="px-6 py-5">{{ $value->title }}</td>
                                    <td class="px-6 py-5">{{ $value->author }}</td>
                                    <td class="px-6 py-5">
                                        {{ $value->created_at->format('d M, Y') }}
                                    </td>
                                    <td class="px-6 py-5 flex gap-2">
                                        @can('update articles')
                                            <a href="{{ route('article.edit', $value->id) }}"
                                                class="bg-slate-700 text-sm rounded-md text-white px-2 py-1">Update</a>
                                        @endcan

                                        @can('delete articles')
                                            <a href="{{ route('article.delete', $value->id) }}"
                                                class="bg-red-700 text-sm rounded-md text-white px-2 py-1">Delete</a>
                                        @endcan



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
                    {{ $article->links() }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
