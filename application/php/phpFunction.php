<?php

function rmRec($path)
{
    echo $path;
    if (is_file($path)) unlink($path);
    if (is_dir($path)) {
        $arr = array_diff(scandir($path), ['.', '..']);
        foreach ($arr as $p) {
            $path1 = $path . DIRECTORY_SEPARATOR . $p;
            if (is_file($path1)) unlink($path1);
                rmRec($path1);
                rmdir($path1);
        }
        rmdir($path);
    }
}

function __e() {
    $textError = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/lang/ru/error.json');
    return json_decode($textError);
}
