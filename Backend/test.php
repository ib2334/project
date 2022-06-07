<?php
    $l1="ziad";
    $l2="fehr";
    $filename = "../Invoices/test.txt";
    $line_i_am_looking_for = 1;
    $lines = file( $filename , FILE_IGNORE_NEW_LINES );
    $lines[$line_i_am_looking_for] = $l1.$l2;
    file_put_contents( $filename , implode( "\n", $lines ));
?>