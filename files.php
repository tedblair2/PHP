<?php
//working with files
$file = 'key.text';
if (file_exists($file)) {
    //reading a file
    echo readfile($file) . '<br />';

    //copying a file
    copy($file, 'new.text');

    //absolute path
    echo realpath($file) . '<br />';

    //file size
    echo filesize($file) . '<br />';
    unlink('new.text'); // deleting a file

    //rename file
    // rename($file, 'keyfile.txt') . '<br />';
} else {
    echo 'File does not exist';
}
