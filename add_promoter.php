<?php
include('backend/insert.php');
?>

<?php include('header.php'); ?>

<div class="container-fluid">
    <div class="main-block">
        <form id="promoterForm" method="post" onsubmit="return validateForm()">
            <h1>Promoter Registration</h1>
            <div class="info">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Enter first name" required>
                </div>

                <div class="form-group">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" id="middle_name" name="middle_name" class="form-control" placeholder="Enter middle name">
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Enter last name" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter phone number" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter email" required>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>