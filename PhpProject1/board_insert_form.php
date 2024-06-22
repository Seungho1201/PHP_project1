<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
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
    </style>
</head>
<body>
    <?php
    // 세션 시작
    session_start();
    if (isset($_SESSION["id"])) {
        $id = $_SESSION["id"];
    } else {
        $id = "";
    }
    if (isset($_SESSION["name"])) {
        $name = $_SESSION["name"];
    } else {
        $name = "";
    }
    if (isset($_SESSION["grade"])) {
        $grade = $_SESSION["grade"];
    } else {
        $grade = "";
    }

    // url에서 넘어온 grade데이터 GET
    $grade = $_GET['grade'];
    ?>

    <header>
    	<?php include "header.php";?>
    </header>
    <div style="border: 1px solid; width: 60%; height: 600px;" id="round">
        <!-- 기능은 post 실행시board_insert.php?grade=넘어온 데이터 로 이동-->
        <form name="insert" method="post" action="board_insert.php?grade=<?=$grade?>" enctype="multipart/form-data">
            <h1 style="text-align:center">제목: <input type="text" name="title"></h1>
            <hr style="width: 90%">
            <p style="margin-left:10%">내용 : <input type="textarea" name="text" style="width: 85%; height: 70%;"></p>
            <p style="margin-left:10%">이미지 삽입 : <input type="file" name="board_img"></p>
            <div><input type="submit"></div>
        </form>
    </div>
</body>
</html>
