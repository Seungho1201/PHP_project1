<!DOCTYPE html>
<html lang="ko">
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/board.css">
<script>
function check_input() {
    if (!document.board_form.subject.value) {
        alert("제목을 입력하세요!");
        document.board_form.subject.focus();
        return;
    }
    if (!document.board_form.content.value) {
        alert("내용을 입력하세요!");
        document.board_form.content.focus();
        return;
    }
    document.board_form.submit();
}
</script>
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
</style>
</head>
<body> 
<?php
$num  = $_GET["num"];

$con = mysqli_connect("localhost", "user1", "12345", "project1");
$sql = "select * from board where num=$num";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$title = $row["title"];
$content = $row["text"];
$file_name = $row["board_img"];
?>
    <header>
    	<?php include "header.php";?>
    </header>
<div class="container" id="round">
    <!-- 기능은 post 실행시 board_update.php?num=게시글번호 로 이동 -->
    <form name="board_form" method="post" action="board_update.php?num=<?=$num?>" enctype="multipart/form-data">
        <h1>제목 :<input name="subject" type="text" value="<?=$title?>"></h1>
        <hr> 
        <p>내용 :<textarea name="content" rows="10" cols="50"><?=$content?></textarea></p>
        <p>첨부 파일 :<?=$file_name?></p>
        <p>이미지 교체 : <input type="file" name="board_img"></p>
    </form>
</div>
<div class="action-buttons" id="round">
    <button type="button" onclick="check_input()">수정하기</button>
</div>
</body>
</html>
