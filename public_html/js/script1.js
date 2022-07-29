

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
  
  //hiddenにデータを格納するためにインプットを作成
  const input = document.createElement('input');
  var html = document.getElementById("log");
  
  　switch (true) {
  　case "開始" == e.value ://スタート
  　　this.mstart = new Date;
      $mstart = disptime (this.mstart);
      e.value = $mstart
      //時間型をDBの型に変更(フォーマット)
      $start = this.mstart.getTime();

      input.setAttribute('type', 'hidden');
      input.setAttribute('name', 'start');
      input.setAttribute('value', $start);
      html.append(input);
      // html.insertBefore(input,html);
      // this.insertAdjacentHTML(
      //   'afterend',
      //   '<input type="hidden" value="'+$($mstart)+'"'>
      // );
  　　break;
  　　
  　case "終了" == e.value ://終わり
  　　this.mend = new Date;
      $mend = disptime (this.mend);
      e.value = $mend
      //時間型をDBの型に変更(フォーマット)
      $end = this.mend.getTime();

      input.setAttribute('type', 'hidden');
      input.setAttribute('name', 'finish');
      input.setAttribute('value', $end);
      html.append(input);
  　　break;

  　case "記録する" == e ://経過
  　　var d = new Date;
  　　tz = d.getTimezoneOffset () * 60 * 1000;
  　　this.mcalc = new Date (this.mend - this.mstart + tz);
      $mcalc = disptime (this.mcalc);
      //時間型をDBの型に変更(フォーマット)
      $calc = this.mcalc.getTime();
      
      input.setAttribute('type', 'hidden');
      input.setAttribute('name', 'time');
      input.setAttribute('value', $calc);
      html.append(input);
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