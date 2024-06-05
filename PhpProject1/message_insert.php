<meta charset='utf-8'>
<?php

    // url의 send_id 데이터 GET
    $send_id = $_GET["send_id"];
    
    // 사용자가 입력한 수신 id데이터를 $rv_id 변수에 저장
    $rv_id = $_POST['rv_id'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];
        // htmlspecialchars 함수는 특수문자를 HTML엔티티로 변환 즉, 버그나 SQL 인젝션 방지

	$subject = htmlspecialchars($subject, ENT_QUOTES);
	$content = htmlspecialchars($content, ENT_QUOTES);
	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

        // 현재 로그인 정보인 $send_id가 없으면 false인데 !로 조건문을 참으로 생성
	if(!$send_id) {
                // 로그인상태가 아닐 시 로그인 메시지 출력 후 이전 페이지
		echo("
			<script>
			alert('로그인 후 이용해 주세요! ');
			history.go(-1)
			</script>
			");
		exit;
	}

	$con = mysqli_connect("localhost", "user1", "12345", "project1");
        // $sql 변수에 사용자가 입력한 수신자 id를 조회한 테이블의 데이터 저장
	$sql = "select * from members where id='$rv_id'";
	$result = mysqli_query($con, $sql);
	$num_record = mysqli_num_rows($result);

	if($num_record)
	{
            // 사용자가 message_form에서 입력한 데이터 DB에 insert
            $sql = "insert into message (send_id, rv_id, subject, content,  regist_day) ";
            $sql .= "values('$send_id', '$rv_id', '$subject', '$content', '$regist_day')";
		mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
	} else {
            // 수신자 id가 DB에 존재하지 않을 때 경고메세지 출력 후 이전 페이지
		echo("
			<script>
			alert('수신 아이디가 잘못 되었습니다!');
			history.go(-1)
			</script>
			");
		exit;
	}

	mysqli_close($con);                // DB 연결 끊기

	echo "
	   <script>
	    location.href = 'message.php?mode=send';
	   </script>
	";
?>

  
