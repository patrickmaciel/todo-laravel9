<x-app-layout>
    <x-slot name="header">Tasks</x-slot>

    <div class="p-12">
        <h1>
            All tasks
            <a class='text-blue-500 underline' href="{{ route('tasks.create') }}">Create new</a>
        </h1>

        <div>
            <div class="tasks flex flex-col space-y-4">
                <div class="search">
                    <form action="{{ route('tasks.index') }}" method='GET' class='flex flex-col'>
                        <input type="text" name='search' placeholder='Type what you need to search here'>
                    </form>
                </div>

                <div class="task-cards flex flex-wrap gap-2">
                @foreach ($tasks as $task)
                    <div class="task border-2 p-2 rounded-md">
                        <div>
                            <strong>{{ $task->name }}</strong>&nbsp;<br>
                            <a class='text-green-500 underline cursor-pointer' href="{{ route('tasks.show', $task->id) }}">SHOW </a>&nbsp;
                            <a class='text-blue-500 underline cursor-pointer' href="{{ route('tasks.edit', $task->id) }}">EDIT</a>&nbsp;

                            <form class='inline' action="{{ route('tasks.destroy', $task->id) }}" method='post'>
                                @csrf
                                @method('delete')
                                <a class='text-red-500 underline cursor-pointer' href="#" onClick='event.preventDefault(); this.parentElement.submit();'>DELETE</a>
                            </form>
                        </div>
                        <p>
                            @if (!empty($task->filepath))
                                @if (isImage($task->file_extension))
                                    <strong>IMG: </strong><img src="{{ asset($task->filepath) }}" width='80px' alt="{{ $task->name }}">
                                @else
                                    <strong>FILE: </strong><a class='text-blue-500 underline cursor-pointer' href="{{ asset($task->filepath) }}">{{ $task->filename }}</a>
                                @endif
                                <br>
                            @endif
                            {{ $task->filepath }} |
                            {{ $task->file_extension }}
                        </p>
                        <p><em>{{ $task->finished }}</em> | {{ $task->remember_at }}</p>
                        <p>{{ $task->cost }}</p>
                    </div>
                @endforeach
                </div>
            </div>

            <div class="pagination">

            </div>
        </div>
    </div>
</x-app-layout>
