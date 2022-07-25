<?php
require_once(__DIR__ .'/header.php');
?>

  <div class="l-title">
    <h2 class="c-title">検針記録</h2>
  </div>

  <form action="" method="post" id="log" class="form">
    <div class="l-log">
      <button class="btn c-btn c-btn__start">開始</button>
      <input type="hidden" name="">
      <button class="btn c-btn c-btn__fin">終了</button>
      <input type="hidden" name="">
    </div>

    <div class="l-count">
      <input type="text" class="c-count"><span class="c-value">/件</span>
    </div>

    <div class="l-remarks">
      <p class="c-item">備忘録：</p>
      <p class="c-remark"></p>
    </div>

    <div class="l-score">
      <input type="submit" class="btn c-btn c-btn__score">記録する</input>
    </div>
  </form>
 
  <!-- JS有り -->
  <div class="l-title">
    <h2 class="c-title">検針記録</h2>
  </div>

  <form action="check.php" method="post" id="log" class="form">
    <div div class="l-log">
      <p><input type="button" value="開始" class="btn c-btn btn__start">:<label></label></p>
      <!-- <input type="hidden" name="$"> -->

      <p><input type="button" value="終了" class="btn c-btn c-btn__fin">:<label></label></p>
      <!-- <input type="hidden" name="$"> -->

    </div>

    <div class="l-count">
      <input type="text" class="c-count"><span class="c-value">/件</span>
    </div>

    <div class="l-remarks">
      <p class="c-item">備忘録：</p>
      <p class="c-remark"></p>
    </div>

    <div class="l-score">
    <p><input type="submit" value="記録" class="btn c-btn c-btn__score"></p>
    <input type="hidden" name="<?php echo $mcalc; ?>">
    </div>
  </form>
  <script>
//まずその機能で使われるであろう変数を全部含んだ入れ物を作る
function Timer (startbtn, startview, endbtn, endview, calcbtn, calcview) {
　this.startbtn = startbtn;
　this.startview = startview;
　this.endbtn = endbtn;
　this.endview = endview;
　this.calcbtn = calcbtn;
　this.calcview = calcview;
}
//そういえば時間も格納しなければ。Timerに付け加える。
Timer.prototype.mstart = null;//スタート時間を記憶する
Timer.prototype.mend = null;//終わり
Timer.prototype.mcalc = null;//経過

//時分を表示する関数が必要だな
function disptime (time) {
　return [
　　zp (time.getHours ()), '時 ',
　　zp (time.getMinutes ()), '分 ',
　　zp (time.getSeconds ()), '秒'
　].join ('');
}
//ゼロパディグしない
function zp(n) {
　return ('00' + n).slice (-2);
}


//ボタンが押されたときの処理を作る
function clickHandleEvent (event) {
　var e = event.target;
　var sa, d, tz;

　switch (true) {
　case this.startbtn == e ://スタート
　　this.mstart = new Date;
　　this.startview.textContent = disptime (this.mstart);
　　break;
　　
　case this.endbtn == e ://終わり
　　this.mend = new Date;
　　this.endview.textContent = disptime (this.mend);
　　break;
　
　case this.calcbtn == e ://経過
　　var d = new Date;
　　tz = d.getTimezoneOffset () * 60 * 1000;
　　this.mcalc = new Date (this.mend - this.mstart + tz);
　　this.calcview.textContent = disptime (this.mcalc);
　　break;
　}
}
//上(ボタンが押されたときの処理)の処理をTimerにつける
Timer.prototype.handleEvent = clickHandleEvent;
//これでオブジェクトは完成


//_______
//ここからはオブジェクトを使うための設定

//ボタンを集める
var btn = document.querySelectorAll ('input[type="button"]');
//ラベルを集める
var lbl = document.querySelectorAll ('label');
//Timerからあらたしいオブジェクトを作る
var timer1 = new Timer (btn[0],lbl[0],btn[1],lbl[1],btn[2],lbl[2]);
//documentにclickイベントとして登録する
document.addEventListener ('click', timer1, false);

//蛇足。ついでにもう一つ作る
var timer2 = new Timer (btn[3],lbl[3],btn[4],lbl[4],btn[5],lbl[5]);
document.addEventListener ('click', timer2, false);

</script>