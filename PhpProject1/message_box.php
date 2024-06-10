<!DOCTYPE html>
<html>
<head> 
    <meta charset="utf-8">
    <title>PHP 프로그래밍 입문</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/message.css">
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
    <div class="header">
        <a href="main_page.php" style="text-decoration-line: none; color: black">
            <h1 style="font-size: 75px;">PHP PROJECT</h1>
        </a>
    </div>
    <div class="container" id="round">
        <h3 style="text-align: center;">
            <?php
            // 현재 페이지 없을시 기본값 1
            if (isset($_GET["page"]))
                $page = $_GET["page"];
            else
                $page = 1;

            $mode = $_GET["mode"];

            if ($mode=="send")
                echo "송신 쪽지함 > 목록보기";
            else
                echo "수신 쪽지함 > 목록보기";
            ?>
        </h3>
        <hr>
        <div>
            <ul id="message">
                <li>
                    <span class="col1">번호</span>
                    <span class="col2">제목</span>
                    <span class="col3">
                        <?php
                        if ($mode=="send")
                            echo "받은이";
                        else
                            echo "보낸이";
                        ?>
                    </span>
                    <span class="col4">등록일</span>
                </li>
                <?php
                $con = mysqli_connect("localhost", "user1", "12345", "project1");
                // url의 mode가 send 이면 $sql 변수에 massage테이블의 send_id컬럼이 $userid와 일치하는 모든 행 내림차순으로 저장
                if ($mode=="send")
                    
                    $sql = "select * from message where send_id='$id' order by num desc";
                // url이 send가 아닐 시 $sql 변수에 massage테이블의 rv_id컬럼이 $userid와 일치하는 모든 행 내림차순으로 저장
                else
                    $sql = "select * from message where rv_id='$id' order by num desc";

                $result = mysqli_query($con, $sql);
                $total_record = mysqli_num_rows($result); // 전체 글 수

                $scale = 10;

                // 전체 페이지 수($total_page) 계산 
                if ($total_record % $scale == 0)     
                    $total_page = floor($total_record/$scale);      
                else
                    $total_page = floor($total_record/$scale) + 1; 

                // 표시할 페이지($page)에 따라 $start 계산  
                $start = ($page - 1) * $scale;      

                $number = $total_record - $start;

                for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
                {
                    mysqli_data_seek($result, $i);
                    // 가져올 레코드로 위치(포인터) 이동
                    $row = mysqli_fetch_array($result);
                    // 하나의 레코드 가져오기
                    $num    = $row["num"];
                    $subject     = $row["subject"];
                    $regist_day  = $row["regist_day"];

                    if ($mode=="send")
                        $msg_id = $row["rv_id"];
                    else
                        $msg_id = $row["send_id"];

                    $result2 = mysqli_query($con, "select name from members where id='$msg_id'");
                    $record = mysqli_fetch_array($result2);
                    $msg_name     = $record["name"];      
                ?>
                <li>
                    <span class="col1"><?=$number?></span>
                    <span class="col2"><a href="message_view.php?mode=<?=$mode?>&num=<?=$num?>"><?=$subject?></a></span>
                    <span class="col3"><?=$msg_name?>(<?=$msg_id?>)</span>
                    <span class="col4"><?=$regist_day?></span>
                </li>   
                <?php
                   $number--;
                }
                mysqli_close($con);
                ?>
            </ul>
            <ul id="page_num">    
                <?php
                if ($total_page>=2 && $page >= 2)    
                {
                    $new_page = $page-1;
                    echo "<li><a href='message_box.php?mode=$mode&page=$new_page'>◀ 이전</a> </li>";
                }       
                else 
                    echo "<li>&nbsp;</li>";

                // 게시판 목록 하단에 페이지 링크 번호 출력
                for ($i=1; $i<=$total_page; $i++)
                {
                    if ($page == $i)     // 현재 페이지 번호 링크 안함
                    {
                        echo "<li><b> $i </b></li>";
                    }
                    else
                    {
                        echo "<li> <a href='message_box.php?mode=$mode&page=$i'> $i </a> <li>";
                    }
                }
                if ($total_page>=2 && $page != $total_page)       
                {
                    $new_page = $page+1;    
                    echo "<li> <a href='message_box.php?mode=$mode&page=$new_page'>
다음 ▶</a> </li>";
                }
                else 
                    echo "<li>&nbsp;</li>";
                ?>
            </ul> <!-- page -->        
            <ul class="buttons">
                <li><button onclick="location.href='message_box.php?mode=rv'">수신 쪽지함</button></li>
                <li><button onclick="location.href='message_box.php?mode=send'">송신 쪽지함</button></li>
                <li><button onclick="location.href='message.php'">쪽지 보내기</button></li>
            </ul>
        </div>
    </div> <!-- container -->
</body>
</html>
