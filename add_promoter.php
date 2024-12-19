<?php
include('backend/insert.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Contact form</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <style>
        /* Reset some default browser styles */
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f5f7fa;
            /* Light background */
            color: #333;
            /* Neutral text color */
        }

        .main-block {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            /* Full-screen height */
        }

        .left-part {
            background: linear-gradient(45deg, #34495e, #2ecc71);
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .left-part i {
            font-size: 50px;
            margin: 10px 0;
            animation: float 3s infinite ease-in-out;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        form {
            background: #ffffff;
            /* White form background */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        form h1 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
            color: #34495e;
        }

        form .info label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #34495e;
        }

        form .info input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #dcdcdc;
            border-radius: 5px;
            background: #f5f7fa;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
        }

        form .info input:focus {
            border-color: #2ecc71;
            /* Highlight border when focused */
            box-shadow: 0 0 5px rgba(46, 204, 113, 0.5);
            background: #fff;
        }

        button {
            width: 100%;
            background: #2ecc71;
            /* Green button */
            border: none;
            padding: 15px;
            font-size: 16px;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            font-weight: bold;
        }

        button:hover {
            background: #27ae60;
            /* Darker green on hover */
        }

        button:active {
            transform: scale(0.98);
            /* Slight shrink effect on click */
        }

        @media (max-width: 768px) {
            .main-block {
                flex-direction: column;
            }

            .left-part {
                border-radius: 10px 10px 0 0;
                width: 100%;
                padding: 30px;
            }

            form {
                border-radius: 0 0 10px 10px;
            }
        }
    </style>
</head>

<body>
    <div class="main-block">
        <form id="promoterForm" method="post" onsubmit="return validateForm()">
            <h1>Add Promoter</h1>
            <div class="info">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" placeholder="Enter first name">

                <label for="middle_name">Middle Name</label>
                <input type="text" id="middle_name" name="middle_name" placeholder="Enter middle name">

                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" placeholder="Enter last name">

                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" placeholder="Enter phone number">

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter email">
            </div>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>

    <script src="js/sweetalert2.min.js"></script>
    <script src="js/form_validation.js"></script>
</body>


</html>