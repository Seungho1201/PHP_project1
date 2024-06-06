<?php
// 입력 데이터 받기
$name_sql = $_POST["name"];
$id = $_POST["id"];
$pass= $_POST["pass"];
$phone_num= $_POST["phone_num"];
$gender= $_POST["gender"];
$address= $_POST["address"];
$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장
$grade = $_POST["grade"];
$hobby = $_POST["hobby"];
$hello = $_POST["hello"];
$age = $_POST["age"];

// 파일 업로드 처리
$upload_dir = './img/';
$profile_img = $_FILES['profile_img'];
$profile_img_path = '';

if ($profile_img['error'] == UPLOAD_ERR_OK) {
    $tmp_name = $profile_img['tmp_name'];
    $name = basename($profile_img['name']);
    $profile_img_path = $upload_dir . $name;
    if (move_uploaded_file($tmp_name, $profile_img_path)) {
        //echo "파일이 성공적으로 업로드되었습니다.";
    } else {
        //echo "파일 업로드에 실패하였습니다.";
    }
} else {
    echo "파일 업로드에 실패하였습니다. 오류 코드: " . $profile_img['error'];
}

// DB 연결
$con = mysqli_connect("localhost", "user1", "12345", "project1");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// members 테이블에 데이터 삽입
$sql = "INSERT INTO members (name, id, passwd, phone_num, gender, address, regist_day, grade, profile_img, age, hello) 
        VALUES ('$name_sql', '$id', '$pass', '$phone_num', '$gender', "
        . "'$address', '$regist_day', '$grade', '$profile_img_path', '$age', '$hello')";
if (mysqli_query($con, $sql)) {
  
} else {
    echo "오류: " . $sql . "<br>" . mysqli_error($con);
}

// members_hobby 테이블에 데이터 삽입
for ($i = 0; $i < count($hobby); $i++) {
    $sql = "INSERT INTO members_hobby (id, hobby) VALUES ('$id', '$hobby[$i]')";
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
