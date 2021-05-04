<?php
    session_start();
    unset($_SESSION["just_registered"]);
    unset($_SESSION['wrong']);
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
        } else{
            $tmp_arr = [];
            array_push($tmp_arr, $data);
            $data = json_encode($tmp_arr);
            file_put_contents('database.json', $data);
        }
        $_SESSION['just_registered'] = "yes";

        header("Location: login.php");

    } elseif (isset($_POST['reset'])) {
        $reading = fopen('database.txt', 'r');
        $writing = fopen('database.tmp', 'w');

        $replaced = false;

        while (!feof($reading)) {
        $line = fgets($reading);
        $to_array = explode(',', $line);
        if (stristr($line,$to_array[2])) {
            $line = "replacement line!\n";
            $replaced = true;
        }
        fputs($writing, $line);
        }
        fclose($reading); fclose($writing);
        // might as well not overwrite the file if we didn't replace anything
        if ($replaced) 
        {
        rename('database.tmp', 'database.txt');
        } else {
        unlink('database.tmp');
        }
    } elseif (isset($_POST['login'])) {
        $u_name = trim($_POST['u_name']);
        $password = trim($_POST['password']);

        $my_file = file_get_contents('database.json');
        $tmp_arr = json_decode($my_file, $associative = true);

        if ($tmp_arr != NULL) {
            if (array_key_exists($u_name, $tmp_arr)) {
                if ($tmp_arr[$u_name]['password'] == $password) {
                    $_SESSION['username'] = $u_name;
                    header("Location: dashboard.php");
                } else {
                    $_SESSION['wrong'] = "The login details you entered are incorrect";
                    header("Location: login.php");
                }
            } else {
                $_SESSION['wrong'] = "The login details you entered are incorrect";
                header("Location: login.php");
            }
        } else {
            $_SESSION['wrong'] = "The login details you entered are incorrect";
            header("Location: login.php");
        }

    }

?>