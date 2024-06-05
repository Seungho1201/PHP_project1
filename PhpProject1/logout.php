<?php
    // 로그아웃시 세션 해제
    session_start();
    unset($_SESSION["id"]);
    unset($_SESSION["name"]);
    unset($_SESSION["grade"]);
  
  echo("
       <script>
          location.href = 'main_page.php';
         </script>
       ");
?>
