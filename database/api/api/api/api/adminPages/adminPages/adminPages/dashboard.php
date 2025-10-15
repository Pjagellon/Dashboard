<?php
session_start();
if(!isset($_SESSION['admin'])) { header('Location: login.php'); exit; }
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Chatbot Admin Dashboard</title>
<link rel="stylesheet" href="../additionals/css/chatbot-admin.css">
</head>
<body>
  <h1>Chatbot Management - Dashboard</h1>
  <p>Welcome, <?=htmlspecialchars($_SESSION['admin']['username'])?> — <a href="logout.php">Logout</a></p>
  <nav>
    <a href="faq.php">FAQ Management</a> |
    <a href="history.php">Chat History</a> |
    <a href="settings.php">Settings</a>
  </nav>
  <section>
    <h2>Quick actions</h2>
    <ul>
      <li><a href="faq.php">Add / Edit FAQs</a></li>
      <li><a href="history.php">View chats</a></li>
    </ul>
  </section>
</body>
</html>
