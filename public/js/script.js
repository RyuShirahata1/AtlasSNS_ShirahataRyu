$(function () {
  $(".nav-btn").on("click", function () {
    $(this).next().slideToggle(300);
    $(this).toggleClass("open", 300);
  });
});
