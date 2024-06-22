<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
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
        
        <header>
            <?php include "header.php";?>
        </header>
        
        <?php      
        // url에서 넘어온 type 데이터 GET
        $type = $_GET['type'];
        // type값 0 : 공지사항, 1 : 일반, 2 : 뮤지션
        if($type == 0) { echo "<h1>공지사항 게시판</h1>";}
        else if($type == 1) { echo "<h1>일반 게시판</h1>";}
        else { echo "<h1>뮤지션 게시판</h1>"; }
        
        $con = mysqli_connect("localhost", "user1", "12345", "project1");
        // DB에서 grade와 변수 type이 일치하는 모든 게시글 검색 쿼리문 
        $sql = "SELECT title, num, id FROM board WHERE grade = $type ORDER BY num DESC";
        $result =  mysqli_query($con, $sql);
        
        // 게시글이 존재할 때 까지 반복
        while($row = mysqli_fetch_array($result)) {
        ?>
        
            <div style="width:50%;
                        height: 50px;
                        border: 1px solid;
                        border-radius: 15px;
                        text-align: center;">
                <p style="font-size: 13px;"></p>
                <a href="board_view.php?type=<?=$type?>&num=<?=$row['num']?>"> <?= $row['title']?></a>
                <?php
                // 해당 게시글의 글쓴 유저와 동일시 삭제와 수정 링크 풀력
                if($row["id"] == $id){
                ?>
                <a href="board_delete.php?num=<?=$row["num"]?>">[삭제]</a>
                <?php
                }
                ?>
            </div>
            <p style="font-size: 5px"></p>
        <?php
        }
        // DB 연결 종료
        mysqli_close($con);
        ?>
 
    </body>
</html>
