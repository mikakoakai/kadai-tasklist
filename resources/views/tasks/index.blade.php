@extends('layouts.app')

@section('content')

<h1>メッセージ一覧</h1>

    @if (count($tasks) > 0)
        <ul>
            @foreach ($tasks as $task)
                <li>{{ $task->content }}</li>
            @endforeach
        </ul>
    @endif


    @foreach ($tasks as $task)
                <li>{!! link_to_route('task.show', $task->id, ['id' => $task->id]) !!} : {{ $task->content }}</li>
            @endforeach
            {!! link_to_route('task.create', '新規メッセージの投稿') !!}
            
@endsection