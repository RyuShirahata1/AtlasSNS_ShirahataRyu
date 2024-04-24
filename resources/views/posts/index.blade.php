@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>
<div class="container">
  <!-- 投稿フォーム -->
  {!! Form::open(['url' => '/posts/index']) !!}
  {{Form::token()}}
  <div class="form-group">
    {{ Form::input('text', 'newPost',null,['required', 'class' => 'form-control','placeholder' => '投稿内容を確認してください'])}}
  </div>
  <button type="submit" class="btn btn-success pull-right"><img src="images/post.png" alt="送信"></button>
  {!! Form::close() !!}
</div>


@endsection
