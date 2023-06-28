<!--INCLUDES-->
<script src="../../public/jquery.js"></script>
<script src="../../public/bootstrap-5.3.0-dist/js/bootstrap.min.js"></script>
<script src="../../public/bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="../../public/bootstrap-5.3.0-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../../public/css/style.css">
<link href="../../public/fontawesome-free-6.3.0-web/css/fontawesome.css" rel="stylesheet">
<link href="../../public/fontawesome-free-6.3.0-web/css/brands.css" rel="stylesheet">
<link href="../../public/fontawesome-free-6.3.0-web/css/solid.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start();

if (!isset($_SESSION['Token']) && basename($_SERVER['PHP_SELF']) != 'login.php' && basename($_SERVER['PHP_SELF']) != 'register.php') {
    header("Location: /WEBPHP/view/usuario/login.php");
    exit;
}
?>
