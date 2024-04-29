@extends('layouts.login')

@section('content')
<div class="container">
  <h2 class="page-header"></h2>
  {!! Form::open(['url' => 'users/search']) !!}

  <div class="form-group">
    {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => 'ユーザー名']) !!}
  </div>

  <button type="submit" class=""><img src="./images/search.png"></button>
  {!! Form::close() !!}
</div>


@endsection
