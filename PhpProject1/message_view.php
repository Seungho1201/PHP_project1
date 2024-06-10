<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <title>PHP 프로그래밍 입문</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/message.css">
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
    <div class="header">
        <a href="main_page.php" style="text-decoration-line: none; color: black">
            <h1 style="font-size: 75px;">PHP PROJECT</h1>
        </a>
    </div>

    <h3 class="title">
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
            // url에서 넘어온 데이터 mode, num 데이터 저장
            $mode = $_GET["mode"];
            $num  = $_GET["num"];

            $con = mysqli_connect("localhost", "user1", "12345", "project1");
            // num과 일치하는 데이터 조회 쿼리문
            $sql = "select * from message where num=$num";
            $result = mysqli_query($con, $sql);

            $row = mysqli_fetch_array($result);
            $send_id    = $row["send_id"];
            $rv_id      = $row["rv_id"];
            $regist_day = $row["regist_day"];
            $subject    = $row["subject"];
            $content    = $row["content"];

            $content = str_replace(" ", "&nbsp;", $content);
            $content = str_replace("\n", "<br>", $content);

            if ($mode=="send")
                $result2 = mysqli_query($con, "select name from members where id='$rv_id'");
            else
                $result2 = mysqli_query($con, "select name from members where id='$send_id'");

            $record = mysqli_fetch_array($result2);
            $msg_name = $record["name"];

            if ($mode=="send")	    	
                echo "송신 쪽지함 > 내용보기";
            else
                echo "수신 쪽지함 > 내용보기";
        ?>
    </h3>
    
    <div class="container" id="round">
        <ul id="view_content">
            <li>
                <span class="col1"><b>제목 :</b> <?=$subject?></span>
                <span class="col2"><?=$msg_name?> | <?=$regist_day?></span>
            </li>
            <li>
                <?=$content?>
            </li>		
        </ul>
        <ul class="buttons">
            <li><button onclick="location.href='message_box.php?mode=rv'">수신 쪽지함</button></li>
            <li><button onclick="location.href='message_box.php?mode=send'">송신 쪽지함</button></li>
            <li><button onclick="location.href='message_response_form.php?num=<?=$num?>'">답변 쪽지</button></li>
            <li><button onclick="location.href='message_delete.php?num=<?=$num?>&mode=<?=$mode?>'">삭제</button></li>
        </ul>
    </div> <!-- message_box -->
</body>
</html>
