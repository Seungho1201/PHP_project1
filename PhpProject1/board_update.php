<?php
    // url에서 넘어온 num 데이터 GET
    $num = $_GET["num"];

    $subject = $_POST["subject"];
    $content = $_POST["content"];
    
    // 파일 업로드 처리
    $upload_dir = './img/';
    $profile_img = $_FILES['board_img'];
    $profile_img_path = '';

    if ($profile_img['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $profile_img['tmp_name'];
        $name = basename($profile_img['name']);
        $profile_img_path = $upload_dir . $name;
        if (move_uploaded_file($tmp_name, $profile_img_path)) {
            //echo "파일이 성공적으로 업로드되었습니다.";
        } else {
            echo "파일 업로드에 실패하였습니다.";
        }
    } else {
        if ($profile_img['error'] != UPLOAD_ERR_NO_FILE) {
            echo "파일 업로드에 실패하였습니다. 오류 코드: " . $profile_img['error'];
        }
    }

    $con = mysqli_connect("localhost", "user1", "12345", "project1");
    // 게시글의 num와 일치하는 DB 데이터 update
    if (!empty($profile_img_path)) {
        $sql = "update board set title='$subject', text='$content', board_img='$profile_img_path' ";
    } else {
        // 수정할 이미지 없을시 board_img 컬럼 수정 X
        $sql = "update board set title='$subject', text='$content' ";
    }
    $sql .= " where num=$num";
    mysqli_query($con, $sql);

    // DB 연결 종료
    mysqli_close($con);   

   // 페이지 이동
echo "
  <script>
      location.href = 'main_page.php';
  </script>
";
?>
