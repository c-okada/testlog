$(function () {
  $('input[type=file]').change(function () {
    var file = $(this).prop('files')[0];

    // 画像以外は処理を停止
    if (!file.type.match('image.*')) {
      // クリア
      $(this).val('');
      $('.c-file__img').html('');
      return;
    }

    // 画像表示
    var reader = new FileReader();
    reader.onload = function () {
      var img_src = $('<img>').attr('src', reader.result);
      $('.c-file__img').html(img_src);
      $('.imgarea').removeClass('noimage');
    }
    reader.readAsDataURL(file);
  });
});