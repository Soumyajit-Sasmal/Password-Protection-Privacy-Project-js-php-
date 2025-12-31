    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Status Bar Fixed</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding-top: 60px; /* space for fixed bar */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #1a1a1a;
            color: #fff;
        }

        /* ===== FIXED STATUS BAR ===== */
        .status-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: #2d2d2d;
            color: #ffffff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #444;
            font-size: 14px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.4);
            z-index: 9999;
        }

        .status-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Indicators */
        .indicator {
            height: 8px;
            width: 8px;
            border-radius: 50%;
            display: inline-block;
        }

        .online {
            background-color: #2ecc71;
            box-shadow: 0 0 8px #2ecc71;
        }

        .offline {
            background-color: #e74c3c;
            box-shadow: 0 0 8px #e74c3c;
        }

        .timestamp {
            color: #aaa;
            font-family: monospace;
        }

        .db-name {
            font-weight: bold;
            text-transform: uppercase;
            color: #3498db;
        }
    </style>
</head>

<body>

<!-- ===== STATUS BAR ===== -->
<div class="status-bar">
<?php
    date_default_timezone_set("Asia/Kolkata");

    $sn = "localhost";
    $un = "root";
    $ps = "";
    $dn = "entry";

    $con = new mysqli($sn, $un, $ps, $dn);

    if ($con->connect_error) {
        echo '
        <div class="status-item">
            <span class="indicator offline"></span>
            <span>Connection Failed</span>
        </div>';
    } else {
        echo '
        <div class="status-item">
            <span class="indicator online"></span>
            <span>Server: <strong>'.$sn.'</strong></span>
        </div>

        <div class="status-item">
            <span class="timestamp">'.date("d M Y | h:i:s A").'</span>
        </div>

        <div class="status-item">
            Database: <span class="db-name">'.$dn.'</span>
            <span style="color:#2ecc71;font-size:11px;">ACTIVE</span>
        </div>';
    }
?>
</div>



</body>
</html>  
