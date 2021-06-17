@extends('layouts.app')

@section('content')

    <h1> {{ $user->name }} のプロフィール編集ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('profile', '自己紹介') !!}
                    {!! Form::text('profile', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection