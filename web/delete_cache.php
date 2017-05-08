<?php

$cachefiles = glob('../var/cache/*');

echo 'TOTAL FILES TO DELETE: '.count($cachefiles);

foreach ($cachefiles as $key => $e) {
    delete_files($e);
    echo $e . ' ELIMINADO<br>';
}


/*
 * php delete function that deals with directories recursively
 */

function delete_files($target) {
    if (is_dir($target)) {
        $files = glob($target . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned

        foreach ($files as $file) {
            delete_files($file);
        }
        echo 'eliminando ' . $target . '<br>';
        rmdir( $target );
    } elseif (is_file($target)) {
        echo 'eliminando ' . $target . '<br>';
        unlink($target);
    }
}
