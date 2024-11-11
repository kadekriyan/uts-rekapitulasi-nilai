<?php
include '../class/function.php';

$logout = $dosen->logout();
echo "<script> window.location.href = 'index.php'</script>";
exit();