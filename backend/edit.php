<?php
include "../connect.php";

$promoter_id = $first_name = $middle_name = $last_name = $email = $phone = "";
$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
  if (!isset($_GET['promoter_id'])) {
    header('Location: ../promoters.php');
    exit;
  }
  $promoter_id = $_GET['promoter_id'];
  $sql = "SELECT * FROM promoter WHERE promoter_id=?";
  $stmt = $con->prepare($sql);
  $stmt->bind_param('i', $promoter_id);
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
    $stmt->bind_param('sssssi', $first_name, $middle_name, $last_name, $email, $phone, $promoter_id);
    if (!$stmt->execute()) {
      $error = "Error: " . $stmt->error;
    } else {
      echo "<script>
                window.onload = function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Promoter Updated Successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                    }).then(function() {
                        window.location.href = '../promoters.php';
                    });
                }
            </script>";
    }
  }
}
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Promoter Management System</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
  <link rel="stylesheet" href="../css/bootstrap/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../css/bootstrap/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="../css/bootstrap/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../css/sweetalert2.min.css">
  <link rel="stylesheet" href="../css/style.css">
</head>

<div class="container-fluid">
  <div class="main-block">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1>Edit Promoter</h1>
      <a href="../promoters.php" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Promoters
      </a>
    </div>

    <form method="post" class="edit-form">
      <input type="hidden" name="promoter_id" value="<?php echo $promoter_id; ?>">

      <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" class="form-control" name="first_name" value="<?php echo htmlspecialchars($first_name) ?>" required>
      </div>

      <div class="form-group">
        <label for="middle_name">Middle Name</label>
        <input type="text" class="form-control" name="middle_name" value="<?php echo htmlspecialchars($middle_name) ?>">
      </div>

      <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" name="last_name" value="<?php echo htmlspecialchars($last_name) ?>" required>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($email) ?>" required>
      </div>

      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($phone) ?>" required>
      </div>

      <button type="submit" class="btn btn-primary btn-block">
        <i class="fas fa-save"></i> Update Promoter
      </button>

      <?php if (!empty($error)): ?>
        <div class="alert alert-danger mt-3"><?php echo htmlspecialchars($error) ?></div>
      <?php endif; ?>
    </form>
  </div>
</div>


<script src="../js/jquery/jquery-3.3.1.min.js"></script>
<script src="../js/jquery/jquery.dataTables.min.js"></script>
<script src="../js/bootstrap/dataTables.bootstrap4.min.js"></script>
<script src="../js/bootstrap/dataTables.buttons.min.js"></script>
<script src="../js/bootstrap/buttons.bootstrap4.min.js"></script>
<script src="../js/bootstrap/jszip.min.js"></script>
<script src="../js/bootstrap/pdfmake.min.js"></script>
<script src="../js/bootstrap/vfs_fonts.js"></script>
<script src="../js/bootstrap/buttons.html5.min.js"></script>
<script src="../js/bootstrap/buttons.print.min.js"></script>
<script src="../js/bootstrap/buttons.colVis.min.js"></script>
<script src="../js/bootstrap/dataTables.responsive.min.js"></script>
<script src="../js/sweetalert2.min.js"></script>
<script src="../js/form_validation.js"></script>

<script>
  $(document).ready(function() {
    // Initialize all DataTables
    $('.mydatatable').DataTable({
      dom: 'Bfrtip',
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
      ],
      responsive: true,
      pageLength: 25
    });

    // Active link highlighting
    $('.nav-link').each(function() {
      if (this.href === window.location.href) {
        $(this).addClass('active');
      }
    });
  });
</script>