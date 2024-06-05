<?php
    // 세션 시작
    session_start();
    if (isset($_SESSION["id"])) $id = $_SESSION["id"];
        else $id = "";
        
    //board_insert_form.php로 넘어온 데이터 처리
    $title = $_POST['title'];
    $text = $_POST['text'];
    $grade = $_GET['grade'];
    $write_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

    // 파일 업로드 처리
    $upload_dir = './img/';
    $board_img = $_FILES['board_img'];
    $board_img_path = '';

if ($board_img['error'] == UPLOAD_ERR_OK) {
    
    $tmp_name = $board_img['tmp_name'];
    $name = basename($board_img['name']);
    $board_img_path = $upload_dir . $name;
    if (move_uploaded_file($tmp_name, $board_img_path)) {
        //echo "파일이 성공적으로 업로드되었습니다.";
    } else {
        //echo "파일 업로드에 실패하였습니다.";
    }
} else {
    echo "파일 업로드에 실패하였습니다. 오류 코드: " . $board_img['error'];
}
//    echo "$id ";
//    echo "$title ";
//    echo "$text ";
//    echo "$write_day ";
//    echo "$grade ";
//    echo "$board_img_path";


    // DB 연결
    $con = mysqli_connect("localhost", "user1", "12345", "project1");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // members 테이블에 데이터 삽입
    // grade는 공지게시판, 일반게시판, 뮤지션 게시판 구분을 위함 (하나의 DB에 저장 후 grade로 구분)
    $sql = "INSERT INTO board (title, id, grade, write_day, text, board_img) 
            VALUES ('$title', '$id', '$grade', '$write_day', '$text', '$board_img_path')";
    if (mysqli_query($con, $sql)) {
        //echo "새 레코드가 성공적으로 생성되었습니다.";
    } else {
        echo "오류: " . $sql . "<br>" . mysqli_error($con);
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
