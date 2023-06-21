<?php

require('connection.php');
session_start();

#for login
if(isset($_POST['login']))
{
    $query = "SELECT * FROM `registered_users` WHERE `email`='{$_POST['email_username']}' OR `username`='{$_POST['email_username']}'";
    $result = mysqli_query($con, $query);

    if($result) 
    {
        if(mysqli_num_rows($result) == 1)
        {
            $result_fetch = mysqli_fetch_assoc($result);
            if(password_verify($_POST['password'], $result_fetch['password']))
            {
                $_SESSION['logged_in']=true;
                $_SESSION['username']=$result_fetch['username'];
                header("location: index.php");
            }
            else
            {
                #if incorrect password
                echo "<script>
                    alert('Incorrect Password');
                    window.location.href='index.php';
                </script>";
            }
        }
        else
        {
            echo "<script>
                alert('Email / Username not registered');
                window.location.href='index.php';
            </script>";
        }
    }
    else
    {
        echo "<script>
            alert('Cannot run query');
            window.location.href='index.php';
        </script>";
    }
}

#for registration
if(isset($_POST['register']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];

    $user_exist_query = "SELECT * FROM `registered_users` WHERE username='$username' OR email='$email'";
    $result = mysqli_query($con, $user_exist_query);

    if($result)
    {
        if(mysqli_num_rows($result) > 0)
        {
            $result_fetch = mysqli_fetch_assoc($result);
            if($result_fetch['username'] == $username)
            {
                echo "<script>
                alert('$username - Username already taken');
                window.location.href='index.php';
                </script>";
            }
            elseif($result_fetch['email'] == $email)
            {
                echo "<script>
                alert('$email - Email already exists');
                window.location.href='index.php';
                </script>";
            }
        }
        else
        {
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $query = "INSERT INTO `registered_users` (`full_name`, `username`, `email`, `password`) VALUES ('$_POST[fullname]','$_POST[username]','$_POST[email]','$password')";
            if(mysqli_query($con, $query))
            {
                echo "<script>
                alert('Registration Successful');
                window.location.href='index.php';
                </script>";
            }
            else
            {
                echo "<script>
                alert('Cannot run query');
                window.location.href='index.php';
                </script>";
            }
        }
    }
    else
    {
        echo "<script>
        alert('Cannot run query');
        window.location.href='index.php';
        </script>";
    }
}

?>
