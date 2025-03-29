<?php
session_start();
include("connect.php");
include("backend/functions.php");
include_once("backend/insert.php");
$user_data = check_login($con);
?>

<?php include('header.php'); ?>

<div class="container-fluid">
    <div class="main-block">
        <form id="userForm" method="post" onsubmit="return validateUserForm()">
            <h1>Add User</h1>
            <div class="form-group">
                <label for="user_name">Username</label>
                <input type="text" id="user_name" name="user_name" class="form-control" placeholder="Enter username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required>
            </div>

            <div class="form-group" style="display: none;">
                <label for="role">Role</label>
                <input type="text" id="role" name="role" class="form-control" value="1">
            </div>

            <button type="submit" name="submit_user" class="btn btn-primary btn-block">Submit</button>
        </form>
    </div>
</div>

<?php include('footer.php'); ?>