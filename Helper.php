<?php

class Helper
{
    public static function isEmpty($data)
    {
        return $data === '' || $data === null;
    }
}