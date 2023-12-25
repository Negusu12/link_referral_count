<?php
include('backend/insert.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Contact form</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
</head>

<body>
    <div class="main-block">
        <div class="left-part">
            <i class="fas fa-envelope"></i>
            <i class="fas fa-at"></i>
            <i class="fas fa-mail-bulk"></i>
        </div>
        <form method="post">
            <h1>Contact Us</h1>
            <div class="info">
                <input class="fname" type="text" name="full_name" placeholder="Full name">
                <input type="text" name="remark" placeholder="Remark">
            </div>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>

    <script src="js/sweetalert2.min.js"></script>
</body>

</html>