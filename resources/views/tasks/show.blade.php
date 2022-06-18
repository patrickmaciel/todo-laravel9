<x-app-layout>
    <x-slot name="header">Tasks</x-slot>

    <div class="p-12">
        <h1>
            Show Task
            <a class='text-blue-500 underline' href="{{ route('tasks.index') }}">Back to list</a>
        </h1>

        <ul>
            <li>{{ $task->user_id }}</li>
            <li>{{ $task->name }}</li>
            <li>{{ $task->filepath }}</li>
            <li>{{ $task->file_extension }}</li>
            <li>{{ $task->finished }}</li>
            <li>{{ $task->remember_at }}</li>
            <li>{{ $task->cost }}</li>
        </ul>

    </div>
</x-app-layout>
