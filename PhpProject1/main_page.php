<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        .content {
            display: flex;
            width: 100%;
            box-sizing: border-box;
        }
        .side {
            width: 30%;
            padding: 10px;
            text-align: center;
            box-sizing: border-box;
        }
        .side div {
            border: 2px solid;
            margin-bottom: 10px;
        }
        .side .notice {
            height: 300px;
        }
        .side .board {
            height: 500px;
        }
        .main {
            width: 50%;
            padding: 10px;
            text-align: center;
            box-sizing: border-box;
        }
        .recommendation {
            margin-top: 10px;
            border: 2px solid;
            width: 20%;
            text-align: center;
            padding: 0px;
            box-sizing: border-box;
        }
        .list_box {
            background-color: gray;
        }
    </style>
</head>
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

<body>
    <!--헤더 부분 -->
    <div class="header">
        <h1 style="font-size: 75px;">PHP PROJECT</h1>
    </div>

    <!--좌측 30% 공지사항, 일반게시판 중앙 50% 뮤지션 좌측 20% 추천-->
    <div class="content">
        <!--좌측 30% 공지사항 및 일반게시판-->
        <div class="side">
            <!-- 공지사항 부분 -->
            <div class="notice" id="round">
                <h1>공연 공지사항</h1>
                <?php
                    $con = mysqli_connect("localhost", "user1", "12345", "project1");
                    // grade 0번이 관리자 게시글 번호
                    $sql = "SELECT title, num FROM board WHERE grade = 0 ORDER BY num DESC";
                    $result = mysqli_query($con, $sql);
                    // 게시글 없을시 게시글 없다고 출력
                    if (!mysqli_num_rows($result)) {
                        echo "게시글 없음";
                    } else {
                ?>
                <?php
                        // sql 결과가 있을때 까지 최대 3개 (최신글로)
                        $i = 0;
                        while ($row = mysqli_fetch_array($result)) {
                            // 글 3개 넘어가면 출력 중단 break
                            if ($i > 2) { break; }
                ?>
                        <!-- 게시글 반복 출력 -->
                        <div style="width:95%;height: 50px;text-align: center; margin-left: auto;margin-right: auto;"
                            id="round"
                            class="list_box">
                            <!-- 게시글 출력 -->
                            <a href="board_view.php?type=0&num=<?= $row['num'] ?>"
                               style="text-decoration-line: none; color: white">
                                <p style="font-size:13px"></p>
                                <?= $row['title'] ?>
                            </a>
                        </div>
                <?php
                        $i++;
                        }
                    }
                    // 글 3개 초과시 더보기 링크 출력
                    if (mysqli_num_rows($result) > 3) {
                ?>
                        <a href="board_list.php?type=0"> 더보기</a>
                <?php
                    // 관리자 (grade가 0 일때만 글작성 표시)
                    } if ($grade == 0) {
                ?>
                    <a href="board_insert_form.php?grade=0"> 글작성</a>
                <?php
                    }
                ?>
            </div>
            <!-- 일반 게시판 -->
            <div class="board" id="round">
                <h1>일반 게시판</h1>
                <?php
                    $con = mysqli_connect("localhost", "user1", "12345", "project1");
                    // grade 0번이 관리자 게시글 번호
                    $sql = "SELECT title, num FROM board WHERE grade = 1 ORDER BY num DESC";
                    $result = mysqli_query($con, $sql);

                    // 게시글 없을시 게시글 없다고 출력
                    if (!mysqli_num_rows($result)) {
                        echo "게시글 없음";
                    } else {
                        // sql 결과가 있을때 까지 최대 3개 (최신글로)
                        $i = 0;
                        while ($row = mysqli_fetch_array($result)) {
                            if ($i > 5) { break; }
                ?>
                        <!-- 게시글 반복 출력 -->
                        <div style="width:95%;height: 50px;text-align: center;margin-left: auto;margin-right: auto;"
                            id="round"
                            class="list_box">
                            <!--게시글 링크-->
                            <a href="board_view.php?type=1&num=<?= $row['num'] ?>"
                               style="text-decoration-line: none; color: white">
                                <p style="font-size:13px"></p>
                                <?= $row['title'] ?>
                            </a>
                        </div>
                <?php
                            $i++;
                        }
                    }
                    // 게시글 6개 초과시 더보기 링크 출력
                    if (mysqli_num_rows($result) > 5) {
                ?>
                        <!-- url -->
                        <a href="board_list.php?type=1"> 더보기</a>
                <?php
                    }
                ?>
                    <!-- 일반유저 (아무나 입력 가능) -->
                    <a href="board_insert_form.php?grade=1"> 글작성</a>
            </div>
        </div>

        <!--중앙 뮤지션 게시판-->
        <div class="main">
            <?php
                // 게시글의 grade가 2(뮤지션 등급)인 것만
                $sql = "SELECT title, num, board_img FROM board WHERE grade = 2 ORDER BY num DESC";
                $result = mysqli_query($con, $sql);
                 // 게시글 없을시 게시글 없다고 출력
                    if (!mysqli_num_rows($result)) {
                        echo "게시글 없음";
                    } else {
                // sql 결과가 있을때 까지 최대 5개 (최신글로)
                $i = 0;
                while ($row = mysqli_fetch_array($result)) {
                    if ($i > 4) { break; }
            ?>
            <div style="border: 2px solid; padding: 10px; height: 15%;" id="round">
                <h1>
                    <a href="board_view.php?type=2&num=<?= $row['num']?>" style="text-decoration-line: none; color: black">
                        <div style='display: flex; align-items: center; justify-content: space-between;'>
                            <div style='margin-left: 50px;'>
                                <?= $row['title']?>
                            </div>
                            <img src="<?= $row['board_img'] ?>" style='width: 150px; margin-right: 20px;' id='round'>
                        </div>
                    </a>
                </h1>
            </div>

            <p style="font-size :5px"></p>

            <?php
                    $i++;
                    }  
                 
                if (mysqli_num_rows($result) > 5) {
            ?>
                    <!-- 게시글이 5개 이상이면  더보기 출력-->
                    <a href="board_list.php?type=2"> 더보기</a>
            <?php
                    } 
                }
                if ($grade == 2) {
            ?>
                    <!-- 뮤지션 유저 (현재 grade가 2 일때만 글작성 표시) -->
                    <a href="board_insert_form.php?grade=2"> 글작성</a>
            <?php
                }
            ?>
        </div>

        <!--찜 게시판-->
        <div class="recommendation" id="round">
            <?php
                if (!$id) {
            ?>
            <div style="text-align : center;">
                <a href="member_form.php">회원 가입</a> | <a href="login_form.php">로그인</a>
            </div>

            <?php
                } else {
                    $con = mysqli_connect("localhost", "user1", "12345", "project1");
                    $sql = "SELECT profile_img, name FROM members WHERE id = '$id'";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($result);

                    if ($row['profile_img'] == null) {
                        $img = '';
                    } else {
                        $img = $row['profile_img'];
                    }
            ?>
            <p> <?= $name ?> 님 | <a href="mypage.php">Mypage</a> | <a href="logout.php">로그아웃</a></p>
            <div style="text-align: center;">
                <img src="<?= $img?>" style="width: 200px;">
            </div>
            <?php
                }
            ?>
            <h1>찜 게시판</h1>
            <?php
                $con = mysqli_connect("localhost", "user1", "12345", "project1");

                // 첫 번째 쿼리를 실행하여 모든 num 값을 배열에 저장
                $sql = "SELECT num FROM members_jjim WHERE id = '$id'";
                $result = mysqli_query($con, $sql);

                $nums = [];
                $i = 0;

                while ($row = mysqli_fetch_array($result)) {
                    $nums[] = $row['num'];
                }

                // 저장된 num 값을 사용하여 두 번째 쿼리를 반복 실행
                foreach ($nums as $num) {
                    $sql = "SELECT num, title, grade FROM board WHERE num = '$num'";
                    $result = mysqli_query($con, $sql);
                    // 메인페이지에선 4개만 출력
                    if ($i > 3) { break; }
                    if ($row = mysqli_fetch_array($result)) {
            ?>
            <div style="border: 2px solid; padding: 10px; height: 10%; width: 80%; margin-left:auto; margin-right : auto;"
                id="round">
                <h2>
                    <a href="board_view.php?type=<?=$row['grade']?>&num=<?=$row['num']?>"
                       style="text-decoration-line: none; color:black">
                        <?=$row['title'] ?>
                    </a>
                </h2>
                <a href="board_jjim_delete.php?num=<?=$row['num']?>"
                   style="text-decoration-line: none; color:black">
                    [찜 제거]
                </a>
            </div>
            <p></p>
            <?php
                    }
                    $i++;
                }
                // DB 접속 해제
                mysqli_close($con);
            ?>
        </div>
    </div>
</body>
</html>
