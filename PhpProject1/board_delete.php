<?php
    // url에서 넘어온 num 데이터 GET
    $num = $_GET["num"];
    //echo "$num";

    $con = mysqli_connect("localhost", "user1", "12345", "project1");
    // $num과 일치하는 데이터 삭제 쿼리문
    $sql = "delete from board where num = $num";
    mysqli_query($con, $sql);
    
    // 찜 게시판 $num 과 일치하는 데이터도 삭제
    $con = mysqli_connect("localhost", "user1", "12345", "project1");
    $sql = "delete from members_jjim where num = $num";
    mysqli_query($con, $sql);
    
    // DB 연결 종료
    mysqli_close($con);
    
    echo("
       <script>
          location.href = 'main_page.php';
         </script>
       ");
?>

