<?php
    session_start();
    if (isset($_SESSION["grade"])) $userlevel = $_SESSION["grade"];
    else $userlevel = "";

    // 유저 등급이 0이 아닐시 접근 불가
    if ( $userlevel != 0 )
    {
        echo("
                    <script>
                    alert('관리자가 아닙니다! 회원 삭제는 관리자만 가능합니다!');
                    history.go(-1)
                    </script>
        ");
                exit;
    }
    // 삭제할 데이터 넘겼는지 조회
    if (isset($_POST["item"]))
        $num_item = count($_POST["item"]); 
    else
        echo("
                <script>
                alert('삭제할 게시글을 선택해주세요!');
                history.go(-1)
                </script>
        ");

    $con = mysqli_connect("localhost", "user1", "12345", "project1");
    // 넘긴 데이터가 존재할 때 까지 반복
    for($i=0; $i<count($_POST["item"]); $i++){
        $num = $_POST["item"][$i];

        $sql = "select * from board where num = $num";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);

        $copied_name = $row["board_img"];
        
        // 파일 삭제
        if ($copied_name)
        {
          
            unlink($copied_name);
        }

        $sql = "delete from board where num = $num";
        mysqli_query($con, $sql);
    }       

    mysqli_close($con);

    echo "
	     <script>
	         location.href = 'admin.php';
	     </script>
	   ";
?>

