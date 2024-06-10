<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <title>PHP 프로그래밍 입문</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/message.css">
    <script>
        function check_input() {
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
            width: 600px; /* 고정 폭 설정 */
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
            width: 600px; /* 고정 폭 설정 */
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
    <section>
        <div class="header">
            <a href="main_page.php" style="text-decoration-line: none; color: black">
                <h1 style="font-size: 75px;">PHP PROJECT</h1>
            </a>
        </div>
        <div class="container" id="round">
            <h3 id="write_title">
                답변 쪽지 보내기
            </h3>
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
                // url에서 넘어온 num 데이터 GET (쪽지 번호)
                $num  = $_GET["num"];

                $con = mysqli_connect("localhost", "user1", "12345", "project1");
                // 쪽지 기본키 $num이랑 일치하는 DB 데이터 조회
                $sql = "select * from message where num=$num";
                $result = mysqli_query($con, $sql);

                $row = mysqli_fetch_array($result);
                $send_id      = $row["send_id"];
                $rv_id        = $row["rv_id"];
                $subject      = $row["subject"];
                $content      = $row["content"];

                $subject = "RE: ".$subject; 

                $content = "> ".$content; 
                $content = str_replace("\n", "\n>", $content);
                $content = "\n\n\n-----------------------------------------------\n".$content;
                // 이 쪽지를 보낸 유저인 send_id 데이터 DB 조회 후 $result2 변수에 저장
                $result2 = mysqli_query($con, "select name from members where id='$send_id'");
                $record = mysqli_fetch_array($result2);
                $send_name = $record["name"];
            ?>		
            <form name="message_form" method="post" action="message_insert.php?send_id=<?=$id?>">
                <input type="hidden" name="rv_id" value="<?=$send_id?>">
                <div id="write_msg">
                    <ul>
                        <li>
                            <span class="col1">보내는 사람 : </span>
                            <span class="col2"><?=$id?></span>
                        </li>	
                        <li>
                            <span class="col1">수신 아이디 : </span>
                            <span class="col2"><?=$send_name?>(<?=$send_id?>)</span>
                        </li>	
                        <li>
                            <span class="col1">제목 : </span>
                            <span class="col2"><input name="subject" type="text" value="<?=$subject?>"></span>
                        </li>	    	
                        <li id="text_area">	
                            <span class="col1">글 내용 : </span>
                            <span class="col2">
                                <textarea name="content"><?=$content?></textarea>
                            </span>
                        </li>
                    </ul>
                    <button type="button" onclick="check_input()">보내기</button>
                </div>
            </form>
        </div> <!-- message_box -->
    </section> 
</body>
</html>
