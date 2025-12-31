<?php
include "connection.php";
error_reporting(E_ALL); // Turned on for debugging, set to 0 in production

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $un = $_POST['un'] ?? null;
    $ps = $_POST['ps'] ?? null;

    if ($un && $ps) {
        // PREPARED STATEMENT (Prevents SQL Injection)
        $stmt = $con->prepare("SELECT id FROM shift WHERE uname=? AND upass=?");
        $stmt->bind_param("ss", $un, $ps);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            $found_id = $user['id'];
            $msg = "<div class='msg success'>Welcome back! Login successful (ID-$found_id)</div>";
        } else {
            $msg = "<div class='msg error'>Invalid username or password</div>";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Secure Login Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary: #6d5dfc;
            --primary-light: #8f6bff;
            --bg-dark: #111;
            --card-bg: #2b2c3f;
            --input-bg: #3a3b55;
        }

        * { box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: var(--bg-dark);
            color: #fff;
        }

        /* Notifications */
        .msg {
            position: fixed;
            top: 25px;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 500;
            animation: slideDown 0.4s ease;
            z-index: 1000;
        }
        @keyframes slideDown { from { transform: translateY(-50px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .success { background: #16a34a; }
        .error { background: #dc2626; }

        /* Layout */
        .container {
            width: 850px;
            display: flex;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.6);
            background: var(--card-bg);
        }

        .left {
            flex: 1;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .left h1 { font-size: 48px; margin: 0 0 20px; }
        .left p { font-size: 16px; line-height: 1.6; opacity: 0.8; }

        .right {
            flex: 1.2;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right h2 { margin-bottom: 30px; font-size: 28px; }

        /* Form Styling */
        .input-group { margin-bottom: 20px; }
        
        input {
            width: 100%;
            padding: 14px 18px;
            border-radius: 12px;
            border: 2px solid transparent;
            background: var(--input-bg);
            color: #fff;
            font-size: 15px;
            transition: 0.3s;
        }

        input:focus {
            outline: none;
            border-color: var(--primary-light);
            background: #444564;
        }

        button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
            margin-top: 10px;
        }

        button:active { transform: scale(0.98); }

        .link { margin-top: 25px; text-align: center; color: #aaa; font-size: 14px; }
        .link a { color: var(--primary-light); text-decoration: none; font-weight: 600; }

        @media(max-width: 800px) {
            .container { flex-direction: column; width: 90%; }
            .left { padding: 40px; }
        }
    </style>
</head>
<body>

    <?php echo $msg; ?>

    <div class="container">
        <div class="left">
            <h1>Hello.</h1>
            <p> Welcome back!  
Enter your details to access your account safely. Your data is subtly secured before login.</p> 
        </div>

        <div class="right">
            <h2>Sign In</h2>
            <form id="loginForm" action="" method="POST">
                <div class="input-group">
                    <input type="text" name="un" placeholder="Username" required autocomplete="off">
                </div>
                <div class="input-group">
                    <input type="password" id="ps_display" placeholder="Password" required>
                    <input type="hidden" name="ps" id="ps_hidden">
                </div>
               <b> <button type="submit">LOGIN</button> <b>
            </form>
          <b>  <div class="link">
                Don't have an account? <a href="shreg.php">Create one</a><b>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('loginForm').onsubmit = function() {
        const passField = document.getElementById("ps_display");
        const hiddenField = document.getElementById("ps_hidden");
        const val = passField.value;
        let conv = "";
        const len = val.length;

        // Custom Shift Logic
        for (let i = 0; i < len; i++) {
            let convasc = val.charCodeAt(i) + len;
            if (convasc > 126) {
                convasc = (convasc % 127) + 33;
            }
            conv += String.fromCharCode(convasc);
        }

        // Set the hidden field to the shifted value
        hiddenField.value = conv;
        
        // Optional: Clear the visible password field so the 
        // raw password isn't even in the DOM during submission
        passField.disabled = true; 
        return true;
    };
    </script>
</body>
</html>



<!--
function shiftn(){
    var pas = document.getElementById("ps").value;
    var conv = "";
    var len = pas.length;

    for (var i=0;i<len;i++){
        var convasc = pas.charCodeAt(i) + len;
        if (convasc > 126)
            convasc = (convasc % 127) + 33;
        conv += String.fromCharCode(convasc);
    }
    document.getElementById("ps").value = conv;
}-->