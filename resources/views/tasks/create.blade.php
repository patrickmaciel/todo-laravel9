<x-app-layout>
    <x-slot name="header">Tasks</x-slot>

    <div class="p-12">
        <h1>
            Create new Task
            <a class='text-blue-500 underline' href="{{ route('tasks.index') }}">Back to list</a>
        </h1>

        <form action="{{ route('tasks.store') }}" method="POST" class='flex flex-col items-start gap-4' enctype="multipart/form-data" >
            @csrf

            <label for="name">
                <input type="text" name='name' value="{{ old('name') }}" placeholder="your name">
                @error('name') {{ $message }} @enderror
            </label>

            <label for="filepath">
                <input type="file" name='filepath' value="{{ old('filepath') }}" placeholder="your filepath">
                @error('filepath') {{ $message }} @enderror
            </label>

            <label for="remember_at">
                <input type="date" name='remember_at' value="{{ old('remember_at') }}" placeholder="your remember_at">
                @error('remember_at') {{ $message }} @enderror
            </label>

            <label for="finished">
                <input type="checkbox" name='finished' value="{{ old('finished', 1) }}" placeholder="your finished">Finished
                @error('finished') {{ $message }} @enderror
            </label>

            <label for="cost">
                <input type="text" name='cost' value="{{ old('cost') }}" placeholder="your cost">
                @error('cost') {{ $message }} @enderror
            </label>

            <button class='p-2 border-gray-300 border-2' type="submit">Save</button>
        </form>

    </div>
</x-app-layout>
