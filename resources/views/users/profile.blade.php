@extends('layouts.login')

@section('content')
<p>プロフィール</p>
<form class="" action="{{ route('profile.updated') }}" method="POST" enctype="multipart/form-data">
  <?php $user = Auth::user(); ?>
  <div class="form-update">
  <td><img width="32" src="{{ asset('storage/' . $user->images ) }}"></td>
    <label class="form-group mb-3">
      user name
      <input type="text" value="{{ $user->username }}" class="input" name="name">
    </label><br>
    <label class="form-group mb-3">
      mail adress
      <input type="text" value="{{ $user->mail }}" class="input" name="mail">
    </label><br>
    <label class="form-group mb-3">
      password
      <input type="password" class="input" name="password">
    </label><br>
    <label class="form-group mb-3">
      password comfirm
      <input type="password" value="" class="input" name="password">
      <span class="text-danger">{{$errors->first('password_confirmation')}}</span>
    </label><br>
    <label class="form-group mb-3">
      bio
      <textarea name="bio" rows="2"></textarea>
    </label><br>
    <label class="form-group mb-3">
      icon image
      <input type="file" name="images" class="custom-file-input" id="fileImage">
    </label>
  </div>
  <div class="btn-profileupdate">
    <button type="submit" class="btn btn-primary btn-profileupdate">更新</button>
  </div>
  {{csrf_field()}}

</form>



@endsection
