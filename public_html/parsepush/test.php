<?php
use Parse\ParseClient;
use Parse\ParsePush;
require 'autoload.php';

$android = 

        ini_set('error_reporting', E_ALL);
        ini_set('display_errors', 1);
        date_default_timezone_set('UTC');
        //ParseClient::initialize(
            //'SVybRISVg4pUS0jciWYkZH5CSTyPaXAXvdWZjCu6',
           // 'JthZqiVHiZ2BEEkwxWB2ltriJjmay3z7TRSS6KX5',
           // 'RH4pRDW25piAJsMUEx3uduzvbSu2t9h37se77mNn'
        //);
        ParseClient::initialize(
           'fPSUGZ0H5wm7UPgcEYQ3EImEgv3HuidGeFXFDDJw',
           '6VIhRzVVQN8oBsYjbZ2SYCmBzEqK4C499o4Q25KD',
           'c6akmuK1fHz8RcYuwn6bh5EhaXvqeeZdezc6xbpj'
        );        
        ParsePush::send(
            [
            'channel'=>['broadcast'],
            'data'     => ['alert' => 'sample message'],
            ]
        );
        echo "success";
        print_r(error_get_last ());
?>
