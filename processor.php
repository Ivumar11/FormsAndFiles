<?php
    session_start();
    $msg = "Guest";
    if(isset($_POST['register'])) {
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $u_name = $_POST['u_name'];
        $password = $_POST['password'];

        $msg = "You are welcome, " . $f_name . ".";
        $new_line = $f_name . ',' . $l_name . ',' . $u_name . ',' . $password . "\n";
        $my_file = fopen('database.txt', 'a');
        fwrite($my_file, $new_line);
        fclose($my_file);
        //echo $new_line;

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
        $my_file = fopen('database.txt', 'r');

        $msg = "The password or username provided, is incorrect";
        while (!feof($my_file)) {
            $line = fgets($my_file);
            if ($line == "") continue;
            $to_array = explode(',', $line);
            if (trim($to_array[2]) == $u_name && trim($to_array[3]) == $password) {
                $msg = "You are now logged in, " . $u_name;
                break;
            }
        }

    }

?>

<html>
    <center>
    <h1><?php echo $msg ?></h1>
    <button type='submit' name='logout' style="padding: 10px; background: blue; color: white">LOGOUT</>
    </center>
</html>