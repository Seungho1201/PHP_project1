<?php
// 세션 시작
session_start();
if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
} else {
    $id = "";
}

// url에서 넘어온 num 데이터 GET
$num = $_GET['num'];

// 데이터베이스 연결
$con = mysqli_connect("localhost", "user1", "12345", "project1");

// id와 num이 모두 일치하는 데이터를 삭제하는 SQL 쿼리
$sql = "DELETE FROM members_jjim WHERE id = '$id' AND num = '$num'";

// 쿼리 실행
if (mysqli_query($con, $sql)) {
} else {
    echo "데이터 삭제 실패: " . mysqli_error($con);
}

// DB 연결 종료
mysqli_close($con);

// 페이지 이동
echo "
  <script>
      location.href = 'main_page.php';
  </script>
";
?>
