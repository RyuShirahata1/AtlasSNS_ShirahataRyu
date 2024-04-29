$(function () {
  $(".nav-btn").on("click", function () {
    $(this).next().slideToggle(300);
    $(this).toggleClass("open", 300);
  });
});

$(function () {
  // 編集ボタンがクリックされた時の処理
  $('.js-modal-open').on('click', function () {
    // モーダルの表示
    $('.js-modal').fadeIn();
    // 投稿の内容を取得し変数へ格納
    var post = $(this).attr('post');
    // 投稿のIDを取得し変数へ格納
    var post_id = $(this).attr('post_id');
    // 取得した投稿をモーダルの中に表示
    $('.modal_post').text(post);
    // 取得した投稿のIDをモーダルの中にセット
    $('.modal_id').val(post_id);
    return false;
  });

  // モーダルを閉じる時の処理
  $('.js-modal-close').on('click', function () {
    // モーダルを非表示にする
    $('.js-modal').fadeOut();
    return false;
  });
});
