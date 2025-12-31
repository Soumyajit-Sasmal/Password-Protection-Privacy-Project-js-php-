<?php
require_once "connection.php"; 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$message = "";
$msg_type = "";

if (isset($_GET['msg'])) {
    $message = htmlspecialchars($_GET['msg']);
    $msg_type = $_GET['type'] === 'success' ? 'green' : '#ffcc00';
}

// Logout
if (isset($_POST['logout'])) {
    header("Location: homepage.php");
    exit;
}

// Delete user
if (isset($_POST['delete'])) {
    $id = intval($_POST['delete']);
    $stmt = $con->prepare("DELETE FROM shift WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: ".$_SERVER['PHP_SELF']."?msg=".urlencode("User deleted successfully!")."&type=success");
    exit;
}

// Update user
if (isset($_POST['update_user'])) {
    $id = intval($_POST['user_id']);
    $uname = trim($_POST['uname']);
    $upass = trim($_POST['upass']);
    if ($uname && $upass) {
        $stmt = $con->prepare("UPDATE shift SET uname=?, upass=? WHERE id=?");
        $stmt->bind_param("ssi", $uname, $upass, $id);
        $stmt->execute();
        header("Location: ".$_SERVER['PHP_SELF']."?msg=".urlencode("User updated!")."&type=success");
        exit;
    } else {
        $message = "⚠ All fields required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title> Admin Panel</title>
<style>
body{font-family:sans-serif; background:#111; color:#fff; margin:0;}
.navbar{display:flex; justify-content:space-between; padding:15px 5%; background:#222; border-bottom:2px solid #ff9900;}
.logout-btn{background:#ff3b3b;color:#fff;padding:8px 20px;border:none;cursor:pointer;}
.container{width:90%; margin:auto; margin-top:30px;}
table{width:100%; border-collapse:separate; border-spacing:0 10px;}
th{background:#ff9900;color:#000;padding:12px;}
td{background:#1a1a1a;padding:12px;text-align:center;}
.btn{padding:6px 12px;border:none;border-radius:4px;cursor:pointer;}
.upd{background:#00a8ff;color:#fff;}
.del{background:#ff3b3b;color:#fff;}
.msg{text-align:center;margin:15px;padding:10px;font-weight:bold;}
.modal{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);justify-content:center;align-items:center;}
.modal-content{background:#222;padding:20px;border-radius:8px;width:300px;}
.modal input{width:100%;padding:8px;margin:8px 0;border-radius:4px;border:1px solid #555;background:#333;color:#fff;}
.close-btn{float:right;cursor:pointer;color:#ff3b3b;font-weight:bold;}
</style>
</head>
<body>

<div class="navbar">
    <div>ADMIN PANEL</div>
    <form method="post"><button class="logout-btn" name="logout">  LOGOUT </button></form>
</div>

<?php if($message): ?>
<div class="msg" style="color: <?= $msg_type ?>;"><?= $message ?></div>
<?php endif; ?>

<div class="container">
    <table>
        <thead>
            <tr><th>ID</th><th>Username</th><th>Password</th><th>Action</th></tr>
        </thead>
        <tbody>
        <?php
        $res = $con->query("SELECT * FROM shift ORDER BY id");
        while($row = $res->fetch_assoc()):
        ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['uname']) ?></td>
                <td><?= htmlspecialchars($row['upass']) ?></td>
                <td>
                    <button class="btn upd" onclick="openModal(<?= $row['id'] ?>,'<?= addslashes($row['uname']) ?>','<?= addslashes($row['upass']) ?>')">Update</button>
                    <form method="post" style="display:inline">
                        <button class="btn del" name="delete" value="<?= $row['id'] ?>" onclick="return confirm('Delete this user?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="updateModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">×</span>
        <form method="post">
            <input type="hidden" name="user_id" id="modal_id">
            <label>Username</label>
            <input type="text" name="uname" id="modal_uname" required>
            <label>Password</label>
            <input type="text" name="upass" id="modal_upass" required>
            <button class="btn upd" name="update_user" style="width:100%; margin-top:10px;">Update</button>
        </form>
    </div>
</div>

<script>
function openModal(id, uname, upass){
    document.getElementById('modal_id').value = id;
    document.getElementById('modal_uname').value = uname;
    document.getElementById('modal_upass').value = upass;
    document.getElementById('updateModal').style.display = "flex";
}
function closeModal(){
    document.getElementById('updateModal').style.display = "none";
}
</script>

</body>
</html>
