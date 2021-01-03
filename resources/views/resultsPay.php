<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
    if (session('status')!=null)
        echo "<h2>".session('status')."</h2>";
?>
</body>
</html>
