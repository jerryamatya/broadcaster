<?php

use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseQuery;

class ParseTestHelper
{
    public static function setUp()
    {
        ini_set('error_reporting', E_ALL);
        ini_set('display_errors', 1);
        date_default_timezone_set('UTC');
        ParseClient::initialize(
            'SVybRISVg4pUS0jciWYkZH5CSTyPaXAXvdWZjCu6',
            'JthZqiVHiZ2BEEkwxWB2ltriJjmay3z7TRSS6KX5',
            'RH4pRDW25piAJsMUEx3uduzvbSu2t9h37se77mNn'
        );
    }

    public static function tearDown()
    {
    }

    public static function clearClass($class)
    {
        $query = new ParseQuery($class);
        $query->each(
            function (ParseObject $obj) {
                $obj->destroy(true);
            }, true
        );
    }
}
