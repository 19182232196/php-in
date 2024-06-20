<?php
session_start();
unset($_SESSION['name']);
unset($_SESSION['name']);
setCookie("PHPSESSID",fals);
echo '<script>location="../login.php"</script>';