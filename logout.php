<?php
session_start();
$_SESSION['login'] == "";

session_unset();
$_SESSION['action1'] = "Đăng xuất thành công..!";
?>
<script language="javascript">
    document.location = "login.php";
</script>