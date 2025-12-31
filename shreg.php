<?php
include "connection.php";
error_reporting(E_ALL);

$msg = "";

/* FORM SUBMIT */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $un = mysqli_real_escape_string($con, trim($_POST['un']));
    $ps = trim($_POST['ps']);

    if ($un == "" || $ps == "") {
        $msg = "<div class='msg error'>All fields are required</div>";
    } else {
        /* CHECK IF USER EXISTS */
        $check = mysqli_query($con, "SELECT id FROM shift WHERE uname='$un'");
        if (mysqli_num_rows($check) > 0) {
            $msg = "<div class='msg error'>Username already exists. <a href='shlogin.php' style='color:white; font-weight:bold;'>Login here</a></div>";
        } else {
            /* INSERT USER */
            if (mysqli_query($con, "INSERT INTO shift (uname,upass) VALUES('$un','$ps')")) {
                $msg = "<div class='msg success'>Account created! <a href='shlogin.php' style='color:white; font-weight:bold;'>Login now</a></div>";
            } else {
                $msg = "<div class='msg error'>Database error occurred</div>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *{box-sizing:border-box;font-family:'Segoe UI',sans-serif}
        body{margin:0;min-height:100vh;display:flex;justify-content:center;align-items:center;background:#111;}
        .wrapper{position:relative}
        .container{width:900px;height:480px;display:flex;border-radius:14px;overflow:hidden;box-shadow:0 20px 40px rgba(0,0,0,.5);}
        .left{flex:1;background:linear-gradient(135deg,#22c55e,#16a34a);color:#fff;padding:60px 50px;display:flex;flex-direction:column;justify-content:center;}
        .right{flex:1;background:#2b2c3f;padding:60px 50px;color:#fff;}
        .right input{width:100%;padding:14px;margin-bottom:18px;border-radius:10px;border:1px solid #444;background:#3a3b55;color:#fff;}
        .right button{width:100%;padding:14px;border:none;border-radius:12px;background:#22c55e;color:#fff;font-size:16px;cursor:pointer;margin-bottom: 15px;}
        .msg{position:absolute;top:-55px;left:50%;transform:translateX(-50%);padding:10px 20px;border-radius:8px;font-size:14px;width:100%;text-align:center;}
        .success{background:#16a34a;color:#fff}
        .error{background:#dc2626;color:#fff}
        .login-link {text-align: center; font-size: 14px; color: #aaa;}
        .login-link a {color: #22c55e; text-decoration: none;}
    </style>
</head>
<body>

<div class="wrapper">
    <?= $msg ?>
    <div class="container">
        <div class="left">
            <h1>Welcome.</h1>
            <p>"Sign up safely.
Your info stays secure.
Start using your account now.".Create your account securely.</p> 
        </div>
        <div class="right">
            <h2>Register</h2>
            <form method="POST" onsubmit="shiftn()">
                <input type="text" name="un" placeholder="Username" required>
                <input type="password" id="ps" name="ps" placeholder="Password" required>
                <button type="submit"> <b> Create Account <b></button>
                <div class="login-link">
                   <b> Already have an account? <a href="shlogin.php">Log In</a><b>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function shiftn(){
    let p=document.getElementById("ps").value;
    let r="",l=p.length;
    for(let i=0;i<l;i++){
        let c=p.charCodeAt(i)+l;
        if(c>126) c=(c%127)+33;
        r+=String.fromCharCode(c);
    }
    document.getElementById("ps").value=r;
}
</script>
</body>
</html>