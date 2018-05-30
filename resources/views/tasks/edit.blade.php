@extends('layouts.app')

@section('content')

<h1>id: {{ $task->id }} のタスク編集ページ</h1>
<div class="row">
        <div class="col-xs-12">
        <div class="col-sm-offset-2 col-sm-8">col-sm-8>
        <div class="col-md-offset-2 col-md-8">col-md-8>
        <div class="col-lg-offset-3 col-lg-6">col-lg-6>
    {!! Form::model($task, ['route' => ['task.update', $task->id], 'method' => 'put']) !!}
    <div class="form-group">
       {!! Form::label('status', 'ステータス:') !!}
        {!! Form::text('status', null, ['class' => 'form-control']) !!}
        </div>
   <div class="form-group">
        {!! Form::label('content', 'タスク:') !!}
        {!! Form::text('content', null, ['class' => 'form-control']) !!}
        </div>

        {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}


@endsection