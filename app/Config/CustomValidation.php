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
    public function valid_ifsc(string $str, string &$error = null): bool
    {

        if (!preg_match("/^[A-Z]{4}0[A-Z0-9]{6}$/", $str)) {
            $error = "Invalid IFS Code";
            return false;
          }
       
        return true;
    }

    public function valid_month_year(string $str, string &$error = null): bool
    {


        if (!preg_match("/^(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec|JAN|FEB|MAR|APR|MAY|JUN|JUL|AUG|SEP|OCT|NOV|DEC|jan|feb|mar|apr|may|jun|jul|aug|sep|oct|nov|dec)[\- ]{1}[0-9]{4}$/", $str) && strlen($str)>0) {
            $error = "Please enter valid date format MMM-YYYY";
            return false;
          }
       
        return true;
    }


    public function check_from_date_to_date(string $toDate, string $fromDate, &$error =null): bool{

       // echo "fromDate: $fromDate - toDate:$toDate";die;
        $error = "From date should be greater than to date.";

         return strtotime("1 $fromDate") < strtotime("1 $toDate");

        //return true;
    }

}