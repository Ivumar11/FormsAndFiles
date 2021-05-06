<?php
    session_start();
    unset($_SESSION["just_registered"]);
    unset($_SESSION['msg']);
    if(isset($_POST['register'])) {
        $username = trim($_POST['u_name']);
        $data = [$username => [ "f_name" => trim($_POST['f_name']),
        "l_name" => trim($_POST['l_name']),
        "u_name" => trim($_POST['u_name']),
        "password" => trim($_POST['password'])
        ]];

        $my_file = file_get_contents('database.json');
        $tmp_arr = json_decode($my_file, $associative = true);
        if ($tmp_arr != NULL) {
            array_push($tmp_arr, $data);
            $data = json_encode($tmp_arr);
            file_put_contents('database.json', $data);
        } else {
            $tmp_arr = [];
            array_push($tmp_arr, $data);
            $data = json_encode($tmp_arr);
            file_put_contents('database.json', $data);
        }
        $_SESSION['just_registered'] = "yes";

        header("Location: login.php");

    } elseif (isset($_POST['reset'])) {
        $u_name = trim($_POST['u_name']);
        $new_password = trim($_POST['new_password']);
        $confirm_password = trim($_POST['confirm_password']);
        if ($new_password != $confirm_password) {
            $_SESSION['msg'] = "The passwords you provided don't match. Please confirm password accurately.";
            header("Location: reset.php");
            exit();
        }

        $my_file = file_get_contents('database.json');
        $tmp_arr = json_decode($my_file, $associative = true);

        if ($tmp_arr != NULL) {
            foreach($tmp_arr as $x => &$x_value) {
                foreach($x_value as $y => &$y_value) {
                    if ($y == $u_name) {
                        $y_value["password"] = $new_password;
                        $_SESSION['msg'] = "Your password has been succesfully reset. Enter your details below to login.";
                        
                        $data = json_encode($tmp_arr);
                        file_put_contents('database.json', $data);
                        
                        header("Location: login.php");
                        exit();
                    }
                }
                unset($y_value);
            }

            $_SESSION['msg'] = "Oops... Seems like you are not a registered user. If you feel otherwise, try to enter your username again accurately";
            header("Location: reset.php");
        }

        
    } elseif (isset($_POST['login'])) {
        $u_name = trim($_POST['u_name']);
        $password = trim($_POST['password']);

        $my_file = file_get_contents('database.json');
        $tmp_arr = json_decode($my_file, $associative = true);

        if ($tmp_arr != NULL) {
            foreach($tmp_arr as $x => $x_value) {
                foreach($x_value as $y => $y_value) {
                    if ($y == $u_name && $y_value["password"] == $password) {
                        $_SESSION['username'] = $u_name;
                        header("Location: dashboard.php");
                        exit();
                    }
                }
            }

            $_SESSION['msg'] = "The login details you entered are incorrect";
            header("Location: login.php");
        }

    }

?>