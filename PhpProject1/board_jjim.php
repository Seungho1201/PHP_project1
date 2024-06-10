<?php
// 세션 시작
session_start();
if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
} else {
    $id = false;
}

if (!$id )
    {
        echo("<script>
                alert('로그인 후 이용해주세요!');
                history.go(-1);
                </script>
            ");
        exit;
    }
// url에서 넘어온 num데이터 get (이때 num 데이터는 게시글의 num)
$num = $_GET['num'];
$con = mysqli_connect("localhost", "user1", "12345", "project1");

// 데이터베이스 연결 확인
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// 중복 체크 쿼리
// DB엔 현재 로그인 한 유저의 id와 게시글 번호인 num 둘 다(AND) 없어야 함
$check_sql = "SELECT * FROM members_jjim WHERE id = '$id' AND num = '$num'";
$check_result = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_result) > 0) {
    // 이미 존재하는 경우
    echo "이미 찜한 항목입니다.";
} else {
    // 존재하지 않는 경우, 삽입
    $sql = "INSERT INTO members_jjim (id, num) VALUES ('$id', '$num')";
    if (mysqli_query($con, $sql)) {
    } else {
        echo "에러: " . $sql . "<br>" . mysqli_error($con);
    }
}
// DB 연결 해제
mysqli_close($con);

// 페이지 이동
echo "
  <script>
      location.href = 'main_page.php';
  </script>
";
?>
