<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>PHP 프로그래밍 입문</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/admin.css">
</head>
<style>
    .header {
        text-align: center;
        width: 100%;
    }
    #round {
        border-radius: 15px;
    }

 
    .col7 button,
    .col8 button {
        padding: 5px 10px;
        border: none;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
    }
    .col7 button:hover,
    .col8 button:hover {
        background-color: #0056b3;
    }
    #member_title {
        margin-top: 20px;
        font-size: 18px;
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
    if (isset($_SESSION["grade"])) $userlevel = $_SESSION["grade"];
    else $grade = "";

    // 유저 등급이 0이 아닐시 접근 불가
    if ( $userlevel != 0 )
    {
        echo("
                    <script>
                    alert('관리자만 입장 가능합니다!');
                    history.go(-1)
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
    <div style="border: 2px solid; width: 80%; margin-left: auto; margin-right: auto" id="round">
   	<div id="admin_box">
	    <h3 id="member_title">
	    	관리자 모드 > 회원 관리
		</h3>
	    <ul id="member_list">
				<li>
					<span class="col1">번호 |</span>
					<span class="col2">아이디 |</span>
					<span class="col3">이름 |</span>
					<span class="col4">레벨 |</span>
					<span class="col5">가입일 |</span>
					<span class="col6">수정 |</span>
					<span class="col7">삭제</span>
				</li>
<?php
	$con = mysqli_connect("localhost", "user1", "12345", "project1");
        // 전체 회원 내림차순 조회
	$sql = "select * from members order by num desc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); // 전체 회원 수

	$number = $total_record;
    // sql 실행 결과 데이터가 존재할때 까지 반복
   while ($row = mysqli_fetch_array($result))
   {
        $num         = $row["num"];
	$id          = $row["id"];
	$name        = $row["name"];
	$level       = $row["grade"]; 
        $regist_day  = $row["regist_day"];
?>
			
		<li>
                <!-- 변수 출력 -->
		<form method="post" action="admin_member_update.php?num=<?=$num?>">
			<span class="col1"><?=$number?></span>
			<span class="col2"><?=$id?></a></span>
			<span class="col3"><?=$name?></span>
			<span class="col4"><input type="text" name="level" value="<?=$level?>"></span>
			<span class="col5"><?=$regist_day?></span>
			<span class="col6"><button type="submit">수정</button></span>
			<span class="col7"><button type="button" onclick="location.href='admin_member_delete.php?num=<?=$num?>'">삭제</button></span>
		</form>
		</li>	
			
<?php
            // 다음 데이터
   	    $number--;
   }
?>
	    </ul>
            <hr style="border: 1px solid; width: 80%; margin-left: auto; margin-right: auto">
	    <h3 id="member_title">
	    	관리자 모드 > 게시판 관리
		</h3>
	    <ul id="board_list">
		<li class="title">
			<span class="col1">선택</span>
			<span class="col2">번호</span>
			<span class="col3">이름</span>
			<span class="col4">제목</span>
			<span class="col5">파일명</span>
			<span class="col6">작성일</span>
		</li>
        <!-- form의 기능은 post 실행시 admin_bard_delete.php로 이동 -->
	<form method="post" action="admin_board_delete.php">
<?php
        // board(게시글) 테이블에서 모든 데이터 내림차순 조회
	$sql = "select * from board order by num desc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); // 전체 글의 수

	$number = $total_record;
   // sql 결과가 존재할 때 까지 반복
   while ($row = mysqli_fetch_array($result))
   {
          $num         = $row["num"];
	  $name        = $row["title"];
	  $subject     = $row["text"];
	  $file_name   = $row["board_img"];
          $regist_day  = $row["write_day"];
          $regist_day  = substr($regist_day, 0, 10)
?>
		<li>
                    <span class="col1"><input type="checkbox" name="item[]" value="<?=$num?>"></span>
                    <span class="col2"><?=$number?></span>
                    <span class="col3"><?=$name?></span>
                    <span class="col4"><?=$subject?></span>
                    <span class="col5"><?=$file_name?></span>
                    <span class="col6"><?=$regist_day?></span>
		</li>	
<?php
   	   $number--;
   }
   mysqli_close($con);
?>
		<button type="submit">선택된 글 삭제</button>
            </form>
        </ul>
    </div>
</body>
</html>
