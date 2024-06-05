<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
        #round {
            border-radius: 15px;
        }
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            width: 100%;
        }
        .container {
            border: 1px solid;
            width: 60%;
            height: 600px;
            margin: 20px;
            padding: 10px;
            border-radius: 15px;
        }
        .container h1 {
            text-align: center;
        }
        .container hr {
            width: 90%;
            margin: 0 auto;
        }
        .container p {
            margin-left: 5%;
            text-align: center;
        }
        .container img {
            display: block;
            margin: 0 auto;
            width: 50%;
        }
        .action-buttons {
            
            width: 60%;
            height: 50px;
            text-align: center;
            margin: 20px auto;
            border-radius: 15px;
        }
        .action-buttons button {
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="main_page.php" style="text-decoration-line: none; color: black">
            <h1 style="font-size: 75px;">PHP PROJECT</h1>
        </a>
    </div>
    <div class="container" id="round">
        <!--기능은 post 실행시 login.php로 이동-->
        <form name="login" method="post" action="login.php">
            <br><br><br><br><br><br>
             <div class="action-buttons">
            아이디: <input type="text" name="id"><p></p>
            비밀번호: <input type="password" name="pass"><br>
             </div>
            <br><br>
            <hr>
            <br><br>
            <div class="action-buttons">
                <input type="submit" name="submit" value="로그인">
            </div>
            
        </form>
    </div>
</body>
</html>
