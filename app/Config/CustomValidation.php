<?php
namespace Config;

class CustomValidation
{
    public function even(string $str, string &$error = null): bool
    {
       
        return (int) $str % 2 == 0;
    }

    public function valid_pan(string $str, string &$error = null): bool
    {

        if (!preg_match("/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/", $str)) {
            $error = "Invalid PAN number";
            return false;
          }
       
        return true;
    }
}