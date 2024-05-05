<h1>
    Hello from index blade
</h1>

{{-- <div>
    @if(count($tasks))
        @foreach ($tasks as $task)
            <div>{{ $task->title }}</div>
        @endforeach
    @else
        <div>There are NO tasks.</div>
    @endif
</div> --}}

<div>
    @forelse( $tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['id' => $task->id]) }}">
                {{ $task->title }}
            </a>
        </div>
        <div>{{ $task ->title }}</div>
    @empty
        <div>There are NO tasks.</div>
    @endforelse
</div>