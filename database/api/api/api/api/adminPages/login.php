<?php
// adminPages/login.php
session_start();
include_once(__DIR__ . '/../database/db_connect.php');

if(isset($_SESSION['admin'])) {
  header('Location: dashboard.php'); exit;
}
$msg = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $u = $_POST['username'] ?? '';
  $p = $_POST['password'] ?? '';
  $stmt = $conn->prepare("SELECT id,username,password FROM tbl_admin WHERE username = ?");
  $stmt->bind_param("s",$u);
  $stmt->execute();
  $res = $stmt->get_result();
  if($row = $res->fetch_assoc()){
    if(password_verify($p, $row['password'])){
      $_SESSION['admin'] = ['id'=>$row['id'],'username'=>$row['username']];
      header('Location: dashboard.php'); exit;
    }
  }
  $msg = 'Invalid credentials';
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Admin Login</title></head>
<body>
  <h2>Sign Wizard - Admin Login</h2>
  <?php if($msg):?><p style="color:red"><?=htmlspecialchars($msg)?></p><?php endif;?>
  <form method="post">
    <input name="username" placeholder="username" required><br><br>
    <input name="password" type="password" placeholder="password" required><br><br>
    <button type="submit">Login</button>
  </form>
</body></html>
