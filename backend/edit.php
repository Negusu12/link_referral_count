<?php

include "../connect.php";

$promoter_id = $full_name = $remark = "";
$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
  if (!isset($_GET['promoter_id'])) {
    header('Location: ../promoters.php');
    exit;
  }
  $promoter_id = $_GET['promoter_id'];
  $sql = "SELECT * FROM promoter WHERE promoter_id=?";
  $stmt = $con->prepare($sql);
  $stmt->bind_param('i', $promoter_id); // Fix: Add binding for promoter_id
  if (!$stmt->execute()) {
    $error = "Error: " . $stmt->error;
  } else {
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
      header('Location: ../promoters.php');
      exit;
    }
    $row = $result->fetch_assoc();
    $promoter_id = $row["promoter_id"];
    $first_name = $row["first_name"];
    $middle_name = $row["middle_name"];
    $last_name = $row["last_name"];
    $email = $row["email"];
    $phone = $row["phone"];
  }
} else {
  $promoter_id = $_POST["promoter_id"];
  $first_name = $_POST["first_name"];
  $middle_name = $_POST["middle_name"];
  $last_name = $_POST["last_name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];



  if (empty($error)) {
    $sql = "UPDATE promoter SET first_name=?, middle_name=?, last_name=?, email=?, phone=? WHERE promoter_id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ssssss', $first_name, $middle_name,  $last_name, $email,  $phone, $promoter_id);
    if (!$stmt->execute()) {
      $error = "Error: " . $stmt->error;
    } else {
      echo "<script>
        alert('User Updated Successfully');
        window.location.href = '../promoters.php';
      </script>";
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Edit User</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="assets/images/icons/favicon.ico" />

  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #03949B;
      margin: 0;
      padding: 0;
      color: #26225B;
    }

    .container {
      max-width: 600px;
      margin: 50px auto;
      /* Adjusted margin for centering */
      background-color: #FFFFFF;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: #26225B;
      font-size: 28px;
      /* Increased font size */
      text-align: center;
      /* Centered text */
      margin-bottom: 20px;
      /* Added margin */
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
      color: #26225B;
    }

    input,
    textarea,
    select {
      width: 100%;
      padding: 10px;
      border: 1px solid #B2B435;
      border-radius: 5px;
      box-sizing: border-box;
      margin-bottom: 10px;
      /* Added margin for spacing between form elements */
    }

    button {
      background-color: #03949B;
      color: #FFFFFF;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #4D7DBF;
    }

    .alert {
      margin-top: 20px;
      padding: 10px;
      border-radius: 5px;
    }

    .alert-danger {
      background-color: #FFD2D2;
      border: 1px solid #FF5E5E;
      color: #D8000C;
    }

    .alert-success {
      background-color: #DFF2BF;
      border: 1px solid #4F8A10;
      color: #4F8A10;
    }

    .btn-back {
      display: block;
      text-align: right;
      margin-bottom: 10px;
      text-decoration: none;
      color: #03949B;
      font-weight: bold;
    }

    .btn-back:hover {
      color: #4D7DBF;
    }
  </style>
</head>

<body>

  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">

        <div id="box" class="box container">
          <a href="../promoters.php" class="btn-back">Back to Promoters</a>
          <h1>Edit Promoters</h1>
          <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="promoter_id" value="<?php echo $promoter_id; ?>">

            <div class="form-group">
              <label for="full_name">Full Name:</label>
              <input class="input100" type="text" name="first_name" value="<?php echo $first_name ?>" required>
            </div>
            <div class="form-group">
              <label for="full_name">Middle Name:</label>
              <input class="input100" type="text" name="middle_name" value="<?php echo $middle_name ?>" required>
            </div>
            <div class="form-group">
              <label for="full_name">Last Name:</label>
              <input class="input100" type="text" name="last_name" value="<?php echo $last_name ?>" required>
            </div>
            <div class="form-group">
              <label for="full_name">email:</label>
              <input class="input100" type="text" name="email" value="<?php echo $email ?>" required>
            </div>
            <div class="form-group">
              <label for="full_name">Phone:</label>
              <input class="input100" type="text" name="phone" value="<?php echo $phone ?>" required>
            </div>

            <button type="submit">Update</button>
            <?php if (!empty($error)) { ?>
              <div class="alert alert-danger"><?php echo $error ?></div>
            <?php } else if (!empty($success)) { ?>
              <div class="alert alert-success"><?php echo $success ?></div>
            <?php } ?>
          </form>

        </div>
      </div>
    </div>
  </div>
</body>

</html>