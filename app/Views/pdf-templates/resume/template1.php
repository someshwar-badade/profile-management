<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Joining Form</title>
    <style>
        /** 
        Set the margins of the page to 0, so the footer and the header
        can be of the full height and width !
     **/
        @page {
            /* margin: 0; */
            margin-left: .75cm;
            margin-right: .75cm;
            margin-top: .75cm;
            margin-bottom: .75cm;
            /* margin-bottom: 250px; */
            /* page-break-after: always; */
        }



        * {
            border-collapse: collapse;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            /* margin-top: 7cm; */
            /* margin-left: 2cm;
            margin-right: 2cm; */
            /* margin-bottom: 8cm;  */
            /* padding-top: 380px;
            margin-bottom: 0px; */
            /* padding-bottom: 70px; */
            /* padding-left: 70px;
            padding-right: 70px; */
            /* border: 1px solid black; */
            padding: 0;
        }
        .table{
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .table tr td, .table tr th {
            padding: 5px 10px;
        }

        .table-border tr td, .table-border tr th{
            border: 1px solid #000;
        }

        img.user-image{
            width: 100px;
            height:100px;
            object-fit: contain;
            border-radius: 5px;
        }

       
    </style>
</head>

<body>
<table class="table table-border">
    <tbody>
    <tr>
        <td colspan="3">
            <center>
            <img class="user-image" src="<?=base_url('/assets/images/placeholder-employee.jpg')?>">
            </center>
        </td>
        <td colspan="9">text</td>
    </tr>
    <tr>
        <td colspan="3">text</td>
        <td colspan="9">text</td>
    </tr>
    </tbody>
</table>
</body>

</html>