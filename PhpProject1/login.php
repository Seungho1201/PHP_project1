<?php
// login_form에서 넘어온 데이터 변수에 저장
 $id   = $_POST["id"];
 $pass = $_POST["pass"];

$con = mysqli_connect("localhost", "user1", "12345", "project1");
// members테이블에 유저가 입력한 $id가 있는지 조회하는 쿼리문
$sql = "select * from members where id='$id'";
$result = mysqli_query($con, $sql);
$num_match = mysqli_num_rows($result);
// 존재 유무 조건문
if(!$num_match) {
     echo("
           <script>
             window.alert('등록되지 않은 아이디입니다!')
             history.go(-1)
           </script>
         ");
} else {
        $row = mysqli_fetch_array($result);
        $db_pass = $row["passwd"];

        mysqli_close($con);
        // 유저가 입력한 비밀번호 일치하는지 검증하는 조건문
        if($pass != $db_pass)
        {

           echo("
              <script>
                window.alert('비밀번호가 틀립니다!')
                history.go(-1)
              </script>
           ");
           exit;
        } else {
            // 로그인 성공시 세션 시작
            session_start();
            $_SESSION["id"] = $row["id"];
            $_SESSION["name"] = $row["name"];
            $_SESSION["grade"] = $row["grade"];
            
            echo("
              <script>
                location.href = 'main_page.php';
              </script>
            ");
        }
     }   

?>
