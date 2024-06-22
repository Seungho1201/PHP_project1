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
        .vertical-hr {
            display: inline-block; /* hr 요소를 인라인 블록으로 만듦 */
            width: 1px; /* 폭을 좁게 설정 */
            height: 10px; /* 높이를 원하는 크기로 설정 */
            background-color: black; /* 선의 색상 설정 */
            margin: 10px; /* 선 주변의 여백 설정 (선택 사항) */
        }
        .container {
            display: flex;
            width: 80%;
            justify-content: center;
        }
        .box {
            width: 50%;
            text-align: center;
            margin: 0 10px; /* 두 div 사이의 간격을 위해 margin 추가 */
            border-radius: 15px; /* #round 스타일에 border-radius 추가 */
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
    if (isset($_SESSION["id"])) $id = $_SESSION["id"];
    else $id = "";
    if (isset($_SESSION["name"])) $name = $_SESSION["name"];
    else $name = "";
    if (isset($_SESSION["grade"])) $grade = $_SESSION["grade"];
    else $grade = "";

    // 0 : 관리자 1 : 일반 2 : 뮤지션 등급
    if ($grade == 0) { $level = "관리자";}
    elseif($grade == 1) { $level = "일반";}
    else { $level = "뮤지션"; }
    ?>
    <header>
    	<?php include "header.php";?>
    </header>
    
    <div style="width: 80%; border: 2px solid; text-align: center;" id='round'>
        <h3>닉네임: <?= $name?> 
            <hr class="vertical-hr">
            아이디 : <?=$id?>
            <hr class="vertical-hr">
            등급 : <?= $level?>
            <hr class="vertical-hr">
            <a href="message.php">쪽지함</a>
            <hr class="vertical-hr">
            <a href="member_modify_form.php">정보 수정</a>
            <?php
            if($grade == 0){
            ?>
            <hr class="vertical-hr">
            <a href="admin.php">관리자 페이지</a>
            <?php
            }
            ?>
        </h3>
    </div>
    <p></p>
    <div class="container">
        <div class="box">
            <h2>작성 글</h2>
            <?php
            $con = mysqli_connect("localhost", "user1", "12345", "project1");
            // 현재 로그인한 id 조회 쿼리문
            $sql = "SELECT title, num FROM board WHERE id = '$id' order by num desc";
            $result =  mysqli_query($con, $sql);
            // 게시글 없을시 게시글 없다고 출력
            if(!mysqli_num_rows($result)){
                echo "게시글 없음";
            }
            ?>
            <?php
            while($row = mysqli_fetch_array($result)) {
            ?>
            <!-- 게시글 반복 출력 -->
            <div style="border: 1px solid;
                        padding: 10px;
                        height: 75px;
                        width: 80%;
                        margin: 0 auto; /* 가로 중앙 정렬 */
                        display: flex; /* 요소를 수평으로 정렬하기 위해 flex 사용 */
                        justify-content: center; /* 가로로 정렬하는 방향을 가운데 정렬 */
                        align-items: center; /* 세로로 정렬하는 방향을 가운데 정렬 */
                        border-radius: 15px;" id="round">
                <h2>        
                    <a href="board_view.php?type=<?=$grade?>&num=<?= $row['num'] ?>" style="text-decoration-line: none; color: black">
                        <p style="font-size:13px"></p>
                        <?= $row['title'] ?>
                    </a>
                    <a href="board_delete.php?num=<?=$row['num']?>" style="text-decoration-line: none; color:black; margin-bottom: -20px;">
                        [삭제]
                    </a>
                </h2>
            </div>
            <p></p>
            <?php
            }
            ?>
        </div>
        <div class="box">
            <h2>찜한 글</h2>
            <?php
            $con = mysqli_connect("localhost", "user1", "12345", "project1");

            // 첫 번째 쿼리를 실행하여 모든 num 값을 배열에 저장
            $sql = "SELECT num FROM members_jjim WHERE id = '$id'";
            $result = mysqli_query($con, $sql);
            if(!mysqli_num_rows($result)){
                echo "게시글 없음";
            }
            $nums = [];

            while ($row = mysqli_fetch_array($result)) {
                $nums[] = $row['num'];
            }

            // 저장된 num 값을 사용하여 두 번째 쿼리를 반복 실행
            foreach ($nums as $num) {
                $sql = "SELECT num, title, grade FROM board WHERE num = '$num' order by num desc";
                $result = mysqli_query($con, $sql);

                if ($row = mysqli_fetch_array($result)) {
            ?>
            <div style="border: 1px solid;
                        padding: 10px;
                        height: 75px;
                        width: 80%;
                        margin-left:auto;
                        margin-right : auto;"
                        id="round">
                <h2>
                    <a href="board_view.php?type=<?=$row['grade']?>&num=<?=$row['num']?>" style="text-decoration-line: none; color:black">
                    <?=$row['title'] ?>
                    </a>
                
                <a href="board_jjim_delete.php?num=<?=$row['num']?>" style="text-decoration-line: none; color:black; margin-bottom: -20px;">
                    [찜 제거]
                </a>
                    </h2>
            </div>
            <p></p>
            <?php
                }
            }

            mysqli_close($con);
            ?>
        </div>
    </div>
</body>
</html>
