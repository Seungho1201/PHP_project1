<!DOCTYPE html>
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
        .action-buttons a {
            margin: 0 10px;
            text-decoration: none;
        }
    </style>
</head>
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

    $num = $_GET['num'];
    $type = $_GET['type'];
    ?>
    
    <div class="header">
        <a href="main_page.php" style="text-decoration-line: none; color: black">
            <h1 style="font-size: 75px;">PHP PROJECT</h1>
        </a>
    </div>
    
    <?php
     $con = mysqli_connect("localhost", "user1", "12345", "project1");
     // 접속한 게시글의 num과 일치하는 게시글 DB 조회
     $sql = "SELECT id, title, text, write_day, board_img FROM board WHERE num = $num";
     $result =  mysqli_query($con, $sql);
     $row = mysqli_fetch_array($result);

    $title = $row["title"];
    $text = $row["text"];
    $write_day = $row["write_day"];
    $w_id= $row["id"];
    $img = ($row['board_img']) ? $row['board_img'] : '';    
    ?>
    
    <div class="container" id="round">
        <h1><?= $title ?></h1>
        <hr>
        <p>작성 아이디 : <?=$w_id?></p>
        
        <div>
            <img src="<?=$img?>">
        </div>
        
        <p><?=$text?></p>
    </div>

    <div class="action-buttons" id="round">
        <a href="board_list.php?type=<?=$type?>">[이전페이지]</a>
        <a href="board_jjim.php?num=<?=$num?>">[찜하기]</a>
        <?php
            // 글쓴이와 현재 로그인한 유저와 동일 시 수정, 삭제 링크 표시
            if($id == $row['id']){
        ?>
            <a href="board_update_form.php?num=<?=$num?>">[수정]</a>
            <a href="board_delete.php?num=<?=$num?>">[삭제]</a>
        <?php
        }
        ?>
    </div>
</body>
</html>
