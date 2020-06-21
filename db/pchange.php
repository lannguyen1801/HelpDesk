<?php
if (isset($_SESSION['id'])== false) {
    // Nếu người dùng chưa đăng nhập thì chuyển hướng website sang trang đăng nhập
    header('Location: ../Login.php');
}
?>
