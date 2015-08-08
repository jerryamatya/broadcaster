<?php
use Parse\ParseClient;
use Parse\ParsePush;
require 'autoload.php';

        ini_set('error_reporting', E_ALL);
        ini_set('display_errors', 1);
        date_default_timezone_set('UTC');
        ParseClient::initialize(
            'SVybRISVg4pUS0jciWYkZH5CSTyPaXAXvdWZjCu6',
            'JthZqiVHiZ2BEEkwxWB2ltriJjmay3z7TRSS6KX5',
            'RH4pRDW25piAJsMUEx3uduzvbSu2t9h37se77mNn'
        );
        ParsePush::send(
            [
            'data'     => ['alert' => 'sample message'],
            ]
        );
        echo "success";
        print_r(error_get_last ());
?>
