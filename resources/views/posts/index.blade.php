@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>
<div class="container">
  <!-- 投稿フォーム -->
  {!! Form::open(['url' => '/posts/index']) !!}
  {{Form::token()}}

  <!-- ユーザーIDの隠しフィールド -->
{{ Form::hidden('user_id', Auth::id()) }}

  <div class="form-group">
    {{ Form::input('text', 'newPost',null,['required', 'class' => 'form-control','placeholder' => '投稿内容を確認してください'])}}
  </div>
  <button type="submit" class="btn btn-success pull-right" ><img src="images/post.png" height="30" width="30" alt="送信"></button>
  {!! Form::close() !!}
</div>
<table class="table table-hover">
  @foreach($list as $list)
<tr>
  <td>{{ $list->user_id }}</td>
  <td>{{ $list->post }}</td>
  <td>{{ $list->created_at }}</td>
  <!-- 投稿の編集 -->
<td>
  <div class="content">
    <a class="js-modal-open" href="/post/{{$list->post }}" post_id="{{ $list->id }}">
    <img class="update" src="images/edit.png" height="30" width="30" alt="編集"></a>
  </div>
</td>
<!--  投稿の消去 -->
<td>
    <form action="/post/{{$list->id}}/delete" method="POST" onsubmit="return confirm('この投稿を消去します。よろしいですか？')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
            <img class="Trash" src="/images/trash.png" height="30" width="30" alt="消去">
        </button>
    </form>
</td>
</tr>
  @endforeach
</table>

<!-- モーダル -->
<div class="modal js-modal">
  <div class="modal_bg js-modal-close"></div>
  <div class="modal_content">
    <form action="/post/update" method="post">
      <textarea name="upPost" method="modal_post"></textarea>
      <input type="hidden" name="id" class="modal_id" value="">
      <input type="image" src="/images/edit.png" height="30" width="30" alt="更新">
      {{ csrf_field() }}
    </form>
    <a class="js-modal-close" href="">閉じる</a>
  </div>
</div>


@endsection
