<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>SimpleSYS</title>
</head>
<body>
    <?php
        session_start();
        echo $_SESSION["Token"];
        echo "<br>";
        echo $_SESSION["UserId"];
    ?>
</body>
</html>