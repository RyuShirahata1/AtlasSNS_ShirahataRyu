@extends('layouts.login')

@section('content')
<div class="search-form">
  <form action="/search" method="post">
    @csrf
    <input type="search" name="keyword" class="form-control" placeholder="ユーザー名" value="@if(isset($keyword)){{$keyword}}
    @endif">
    <button type="submit" class=""><img src="./images/search.png"></button>
  </form>
</div>

<!--  検索ワードの表示 -->
@if(!empty($keyword))
<p>検索ワード:{{$keyword}}</p>
@endif

<!--  保存されているユーザーの表示 -->
<div class="container-list">
<table class="table table-hover">
@foreach($users as $user)
<!-- 自分以外のユーザーを表示 -->
@if($user->id !== Auth::id())
<tr>
  <td><img src="{{ asset('storage/' . $user->images) }}" height="40" width="40" alt="ユーザーアイコン"></td>
  <td>{{$user->username}}</td>
  <td>
    @if (auth()->user()->isFollowing($user->id))<!-- フォローしたユーザーか -->
    <form action="{{route('unfollow',$user->id)}}" method="post">
      @csrf
      @method('DELETE') <!-- DELETEメソッドを使用するために追加 -->
      <button type="submit" class="btn btn-danger">フォロー解除</button> <!-- ボタンのtypeをsubmitに変更 -->
    </form>
    @else
    <form action="{{route('follow',$user->id)}}" method="post">
      @csrf
      <button type="submit" class="btn btn-primary">フォローする</button> <!-- ボタンのtypeをsubmitに変更 -->
    </form>
    @endif
  </td>
</tr>
@endif
@endforeach
</table>
</div>


@endsection
