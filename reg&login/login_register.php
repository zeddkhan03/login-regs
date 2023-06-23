<?php

require('connection.php');
session_start();

$data = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

function updateReferral(mysqli $con, $referralCode)
{
    $stmt = $con->prepare("SELECT email, referral_point FROM `registered_users` WHERE `referral_code`= ?");//prevent sql injection
    
    $stmt->bind_param('s', $referralCode);
    $stmt->execute();
    $stmt->bind_result($email, $point);
    $stmt->store_result();

    if ($stmt->fetch()) {
        
        $point += 10;
        $update_query = $con->prepare("UPDATE `registered_users` SET `referral_point`= ? WHERE `email`= ?");//prevent sql injection
        $update_query->bind_param('is', $point, $email);
        $update_query->execute();

        if ($update_query->affected_rows != 1) {
            echo "
                    <script>
                        alert('Cannot update referral point');
                        window.location.href='index.php';
                    </script>
                ";
            exit;
        }
    } else {
        echo "
                <script>
                    alert('Referral Code does not exist');
                    window.location.href='index.php';
                </script>
            ";
        exit;
    }
}


#for login
if (isset($data['login'])) {
    $stmt = $con->prepare("SELECT username, password FROM `registered_users` WHERE `email`= ? OR `username`= ?");//prevent sql injection
    
    $stmt->bind_param('ss', $data['email_username'], $data['email_username']);
    $result = $stmt->execute();
    $stmt->bind_result($user, $pass);
    
    if ($stmt->fetch()) {

        if (password_verify($data['password'], $pass)) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $user;
            header("location: index.php");
        } else {
            #if incorrect password
            echo "
                    <script>
                        alert('Incorrect Password');
                        //window.location.href='index.php';
                    </script>
                ";
        }
        
    } else {
        echo "
                <script>
                    alert('Email / Username not registered');
                    window.location.href='index.php';
                </script>
            ";
    }
}

#for registration
if (isset($data['register'])) {
    $username = $data['username'];
    $email = $data['email'];

    $stmt = $con->prepare("SELECT full_name, username, email FROM `registered_users` WHERE username = ? OR email = ?");//prevent sql injection
    $stmt->bind_param('ss', $username, $email);
    $stmt->execute();
    $stmt->bind_result($full, $user, $emailUser);
    
    if ($stmt->fetch()) {

        if ($user == $username) {
            echo "
                    <script>
                        alert('$username - Username already taken');
                        window.location.href='index.php';
                    </script>
                ";
        } elseif ($emailUser == $email) {
            echo "
                    <script>
                        alert('$email - Email already exists');
                        window.location.href='index.php';
                    </script>
                ";
        }

    } else {
        if ($data['referralcode'] != '') {
            updateReferral($con, $data['referralcode']);
        }

        $referral_code = bin2hex(random_bytes(4));

        $password = password_hash($data['password'], PASSWORD_BCRYPT);
        $referralPoint = 0;
        
        $insertStmt = $con->prepare("INSERT INTO 
                        `registered_users` 
                        (`full_name`, `username`, `email`, `password`, `referral_code`, `referral_point`) 
                    VALUES 
                        (?, ?, ?, ?, ?, ?)
                ");
        $insertStmt->bind_param('sssssi',$data['fullname'], $data['username'], $data['email'], $password, $referral_code, $referralPoint);
        $insertStmt->execute();
        var_dump($insertStmt);

        if ($insertStmt->insert_id > 0) {
            echo "
                    <script>
                        alert('Registration Successful');
                        window.location.href='index.php';
                    </script>
                ";
        } else {
            echo "
                    <script>
                        alert('Cannot run query. Error:' + {$insertStmt->error});
                        window.location.href='index.php';
                    </script>
                ";
        }
    }
}

?>
