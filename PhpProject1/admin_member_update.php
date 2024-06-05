<?php
    session_start();
    if (isset($_SESSION["grade"])) $userlevel = $_SESSION["grade"];
    else $userlevel = "";
    
    // 유저 등급이 0이 아닐시 접근 불가
    if ( $userlevel != 0 )
    {
        echo("
            <script>
            alert('관리자가 아닙니다! 회원정보 수정은 관리자만 가능합니다!');
            history.go(-1)
            </script>
        ");
        exit;
    }
    // url에서 num 데이터 GET
    $num   = $_GET["num"];
    // admin.php에서 보낸 데이터 
    $level = $_POST["level"];

    $con = mysqli_connect("localhost", "user1", "12345", "project1");
    // DB update 쿼리문
    $sql = "update members set grade=$level where num=$num";
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
	     <script>
	         location.href = 'admin.php';
	     </script>
	   ";
?>

