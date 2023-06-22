<?php

require('connection.php');
session_start();

function updateReferral()
{
    $query = "SELECT * FROM `registered_users` WHERE `referral_code`='{$_POST['referralcode']}'";
    $result = mysqli_query($GLOBALS['con'], $query);
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $result_fetch = mysqli_fetch_assoc($result);
            $point = $result_fetch['referral_point'] + 10;
            $update_query = "UPDATE `registered_users` SET `referral_point`='$point' WHERE `email`='$result_fetch[email]'";
            if (!mysqli_query($GLOBALS['con'], $update_query)) {
                echo "<script>
                alert('Cannot update referral point');
                window.location.href='index.php';
                </script>";
                exit;
            }
        } else {
            echo "<script>
            alert('Invalid Referral Code');
            window.location.href='index.php';
            </script>";
            exit;
        }
    } else {
        echo "<script>
        alert('Referral Code does not exist');
        window.location.href='index.php';
        </script>";
        exit;
    }
}


#for login
if (isset($_POST['login'])) {
    $query = "SELECT * FROM `registered_users` WHERE `email`='{$_POST['email_username']}' OR `username`='{$_POST['email_username']}'";
    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $result_fetch = mysqli_fetch_assoc($result);
            if (password_verify($_POST['password'], $result_fetch['password'])) {
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $result_fetch['username'];
                header("location: index.php");
            } else {
                #if incorrect password
                echo "<script>
                    alert('Incorrect Password');
                    window.location.href='index.php';
                </script>";
            }
        } else {
            echo "<script>
                alert('Email / Username not registered');
                window.location.href='index.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Cannot run query');
            window.location.href='index.php';
        </script>";
    }
}

#for registration
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $user_exist_query = "SELECT * FROM `registered_users` WHERE username='$username' OR email='$email'";
    $result = mysqli_query($con, $user_exist_query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $result_fetch = mysqli_fetch_assoc($result);
            if ($result_fetch['username'] == $username) {
                echo "<script>
                alert('$username - Username already taken');
                window.location.href='index.php';
                </script>";
            } elseif ($result_fetch['email'] == $email) {
                echo "<script>
                alert('$email - Email already exists');
                window.location.href='index.php';
                </script>";
            }
        } else {
            if ($_POST['referralcode'] != '') {
                updateReferral();
            }

            $referral_code = bin2hex(random_bytes(4));

            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $query = "INSERT INTO `registered_users` (`full_name`, `username`, `email`, `password`, `referral_code`, `referral_point`) VALUES ('$_POST[fullname]','$_POST[username]','$_POST[email]','$password','$referral_code',0)";
            if (mysqli_query($con, $query)) {
                echo "<script>
                alert('Registration Successful');
                window.location.href='index.php';
                </script>";
            } else {
                echo "<script>
                alert('Cannot run query');
                window.location.href='index.php';
                </script>";
            }
        }
    } else {
        echo "<script>
        alert('Cannot run query');
        window.location.href='index.php';
        </script>";
    }
}

?>
