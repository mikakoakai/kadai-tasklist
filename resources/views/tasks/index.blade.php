@extends('layouts.app')

@section('content')

<h1>タスク一覧</h1>

    @if (count($tasks) > 0)
    <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>ステータス</th>
                    <th>タスク</th>
                </tr>
            </thead>
        <tbody>
            @foreach ($tasks as $task)
            <tr>
               <td>{!! link_to_route('task.show', $task->id, ['id' => $task->id]) !!}</td>
               <td>{{$task->status}} </td>
               <td>{{ $task->content }}</td>
               </tr>
            @endforeach
        </tbody>
        </table>
    @endif
    <button type="button" class="btn btn-default">
  <span class="glyphicon glyphicon-download-alt"></span>
         {!! link_to_route('task.create', '新規タスクの投稿', null, ['class'=> 'btn btn-info']) !!}
            </button>
@endsection