<?php
include('connect.php');

if (isset($_POST['submit'])) {
    $first_name = addslashes($_POST['first_name']);
    $middle_name = addslashes($_POST['middle_name']);
    $last_name = addslashes($_POST['last_name']);
    $phone = addslashes($_POST['phone']);
    $email = addslashes($_POST['email']);

    // Insert the new promoter into the database
    $sql = "INSERT INTO promoter(first_name, middle_name, last_name, phone, email) 
            VALUES ('$first_name', '$middle_name', '$last_name', '$phone', '$email')";
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Get the ID of the newly inserted promoter
        $promoter_id = mysqli_insert_id($con);

        // Generate the referral link
        $referral_link = "localhost/referral/link.php?promoter_id=$promoter_id";

        // Properly escape JavaScript and handle inline HTML
        echo "<script>
        window.onload = function() {
            Swal.fire({
                icon: 'success',
                title: 'Promoter Added Successfully',
                html: 'Use the following link for referral:<br>' +
                      '<div style=\"margin-top: 10px;\">' +
                      '<input type=\"text\" id=\"referralLink\" value=\"$referral_link\" readonly style=\"width: 100%; padding: 5px;\">' +
                      '<button id=\"copyButton\" style=\"margin-top: 10px; padding: 5px; background-color: #4CAF50; color: white; border: none; cursor: pointer;\">Copy to Clipboard</button>' +
                      '</div>',
                showConfirmButton: true,
                confirmButtonText: 'OK'
            }).then(function() {
                // Redirect only after the user confirms
                window.location.href = 'add_promoter.php';
            });

            // Add event listener for the copy button
            document.addEventListener('click', function(event) {
                if (event.target && event.target.id === 'copyButton') {
                    const linkInput = document.getElementById('referralLink');
                    linkInput.select();
                    linkInput.setSelectionRange(0, 99999); // For mobile devices
                    navigator.clipboard.writeText(linkInput.value)
                        .then(() => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Copied!',
                                text: 'The link has been copied to your clipboard.'
                            });
                        })
                        .catch(err => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Unable to copy the link.'
                            });
                        });
                }
            });
        }
        </script>";
    } else {
        echo "<script>
        window.onload = function() {
            Swal.fire({
                icon: 'error',
                title: 'Something went wrong. Make sure all fields are inserted correctly.',
                showConfirmButton: true,
                confirmButtonText: 'OK'
            });
        }
        </script>";
    }
}
