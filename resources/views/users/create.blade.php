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
                    <form method="POST" action="{{ route('user.post') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="" class="text-sm font-medium">Name</label>
                            <div class="my-3">
                                <input placeholder="Enter Name" value="{{ old('name') }}" type="text"
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg " name="name" id="">
                                @error('name')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror

                            </div>
                            <label for="" class="text-sm font-medium">Email</label>
                            <div class="my-3">
                                <input placeholder="Enter Email" value="{{ old('email') }}" type="text"
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg " name="email" id="">
                                @error('email')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror

                            </div>
                            <label for="" class="text-sm font-medium">password</label>
                            <div class="my-3">
                                <input placeholder="Enter Password" value="{{ old('password') }}" type="text"
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg " name="password" id="">
                                @error('password')
                                    <p class="text-red-400 font-medium">{{ $message }}</p>
                                @enderror

                            </div>

                            <button class="bg-slate-700 text-sm rounded-md text-white mt-5 px-5 py-3">Submit</button>
                        </div>



                        <!-- Email Address -->


                        <!-- Password -->


                        <!-- Confirm Password -->


                </div>
                </form>

            </div>
        </div>
    </div>
    </div>
</x-app-layout>
