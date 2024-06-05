<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/message.css">
<script>
  function check_input() {
      if (!document.message_form.rv_id.value)
      {
          alert("수신 아이디를 입력하세요!");
          document.message_form.rv_id.focus();
          return;
      }
      if (!document.message_form.subject.value)
      {
          alert("제목을 입력하세요!");
          document.message_form.subject.focus();
          return;
      }
      if (!document.message_form.content.value)
      {
          alert("내용을 입력하세요!");    
          document.message_form.content.focus();
          return;
      }
      document.message_form.submit();
   }
</script>
</head>
<style>
    #round {
        border-radius: 15px;
    }
    body {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0;
        padding: 0;
    }
    .header {
        text-align: center;
        width: 100%;
    }
    .container {
        border: 1px solid;
        width: 60%;
        height: 600px;
        margin: 20px;
        padding: 10px;
        border-radius: 15px;
        text-align: center; /* 전체 내용 가운데 정렬 */
    }
    .container h1 {
        text-align: center;
    }
    .container hr {
        width: 90%;
        margin: 0 auto;
    }
    .container p {
        margin-left: 5%;
        text-align: center;
    }
    .container img {
        display: block;
        margin: 0 auto;
        width: 50%;
    }
    .action-buttons {
        border: 1px solid;
        width: 60%;
        height: 50px;
        text-align: center;
        margin: 20px auto;
        border-radius: 15px;
    }
    .action-buttons button {
        margin: 0 10px;
    }
    /* 쪽지 작성 폼의 요소들을 가운데 정렬 */
    #message_box {
        margin: 0 auto;
        width: 80%;
        text-align: left;
    }
    #write_msg ul {
        list-style: none;
        padding: 0;
    }
    #write_msg ul li {
        margin-bottom: 10px;
    }
    #write_msg ul li span.col1 {
        display: inline-block;
        width: 120px;
    }
    #write_msg ul li span.col2 {
        display: inline-block;
        width: calc(100% - 120px);
    }
    #write_title {
    text-align: center; /* 가운데 정렬 */
}
</style>

<body> 
    <?php
    // 세션 시작
    session_start();
    if (isset($_SESSION["id"])) $id = $_SESSION["id"];
    else $id = "";
    if (isset($_SESSION["name"])) $name = $_SESSION["name"];
    else $name = "";
    if (isset($_SESSION["grade"])) $grade = $_SESSION["grade"];
    else $grade = "";
?>
<?php
    // 로그인 해야만 접속 가능
    if (!$id )
    {
        echo("<script>
                alert('로그인 후 이용해주세요!');
                history.go(-1);
                </script>
            ");
        exit;
    }
?>

 <div class="header">
        <a href="main_page.php" style="text-decoration-line: none; color: black">
            <h1 style="font-size: 75px;">PHP PROJECT</h1>
        </a>
    </div>
    </div>
    <div class="container" id="round">
    <div id="message_box">
        <h3 id="write_title" >
                쪽지 보내기
                        <hr>
        </h3>
        <ul class="top_buttons">
                <li><span><a href="message_box.php?mode=rv">수신 쪽지함 </a></span></li>
                <li><span><a href="message_box.php?mode=send">송신 쪽지함</a></span></li>
        </ul>
        <form  name="message_form" method="post" action="message_insert.php?send_id=<?=$id?>">
            <div id="write_msg">
                <ul>
                <li>
                    <span class="col1">보내는 사람 : </span>
                    <span class="col2"><?=$id?></span>
                </li>    
                <li>
                    <span class="col1">수신 아이디 : </span>
                    <span class="col2"><input name="rv_id" type="text"></span>
                </li>    
                <li>
                    <span class="col1">제목 : </span>
                    <span class="col2"><input name="subject" type="text"></span>
                </li>            
                <li id="text_area">   
                    <span class="col1">내용 : </span>
                    <span class="col2">
                        <textarea name="content"></textarea>
                    </span>
                </li>
                </ul>
                <button type="button" onclick="check_input()">보내기</button>
            </div>          
        </form>
    </div> <!-- message_box -->
    </div>
</body>
</html>
