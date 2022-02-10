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
            margin-left: 2cm;
            margin-right: 2cm;
            margin-top: 2cm;
            margin-bottom: 2cm;
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

        /** Define the header rules **/
        header {
            position: fixed;
            top: -2cm;
            left: 0;
            right: 0cm;
            /* height: 200px; */

            /* padding-left: 70px;
            padding-right: 70px; */
            /* Extra personal styles */
            /*background-color: #03a9f4;*/
            /* color: white;
            text-align: left;
            line-height: 1.5cm; */
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            color: rgba(0, 0, 0, .5);
            border-top: double 2px black;
            padding-top: 10px;
            /* height: 70px; */
            /* padding-left: 70px;
            padding-right: 70px; */
            /* page-break-before: always; */
            /* Extra personal styles */
            /* background-color: #03a9f4; */
            /* color: white; */
            /* text-align: center;
            line-height: 0.15cm; */

        }

        p.footer-heading1 {
            font-size: 10px;
        }

        p.footer-heading2 {
            font-size: 8px;
        }

        table tr {
            page-break-inside: auto;
        }

        table tr td {
            page-break-inside: auto;
        }

        /**{ margin:0px; padding:0px; box-sizing:border-box;}*/
        body {
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;
            color: #333;
        }

        /*.main { width:90%; margin:50px;}*/
        .table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .table tr td {
            vertical-align: top;
            padding: 5px;
        }

        .table table {
            border-collapse: collapse;
            width: 100%
        }

        .table table th,
        .table table td {
            padding: 6px 5px;
        }

        .table table tr.border {
            border-bottom: solid 1px #cccccc;
        }

        .table-bordered tr td {
            border: solid 1px #cccccc;
        }

        .table table td h1 {
            margin: 10px 0px;
            font-weight: 300;
        }



        .text-center {
            text-align: center !important;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        p {
            margin: 0px;
            text-align: justify;
        }


        h1 {
            font-weight: bold;
        }

        label {
            font-weight: normal;
            color: #555;
        }

        

        .hide-extra-content {
            max-height: 50px;
            min-height: 50px;
            overflow: hidden;
        }

        table.table.table-inner tr th {
            background-color: #2500ad;
            color: white;
            text-align: left;
        }

        table.table.no-border td,
        table.table.no-border {
            border: none;
        }

        .table.table-inner th,
        .table.table-inner td {
            padding: 6px 5px;
        }

        .table {
            margin-top: 15px;
        }

        table.table.table-inner tr td {
            border: solid 1px #cccccc;
        }

        .mx-5 {
            margin-left: 5px;
            margin-right: 5px;
        }

        .ml-5 {
            margin-left: 5px;
        }

        .mr-5 {
            margin-right: 5px;
        }
        ol li {
            margin-bottom: 35px;
            text-align: justify;
        }
    </style>
</head>

<body>
    <center>
        <h2>Agreement to Return and Care for Company Equipment</h2>
    </center>
    <div>
       <ol>
           <li>I acknowledge that I am an employee of BITSTRING IT SERVICES PRIVATE LIMITED on assignment with Infosys Limited and shall be issued Infosys Limited / Client provided equipment to fulfill my assignment duties.  </li>
           <li>
               I request you to ship the equipment to below address 
              <br>
              <br>
              <br>
             <b> <?= $joiningFormDetails['employee_other_details']['present_address'] ?> <?=$joiningFormDetails['employee_other_details']['present_address_city'] ?>
              Postcode: <?= $joiningFormDetails['employee_other_details']['present_address_postcode'] ?>
              </b>

           </li>
           
           <li>I agree that I will use the equipment only in the performance of my duties and that I may be liable for any unauthorized usage, including using the equipment to access unauthorized materials, to breach any confidentiality or data protection obligations, to violate any company policy or to commit any immoral or unlawful act. I will follow the instructions given to me by Infosys Limited regarding the equipment.</li>
           <li>At no point will I give the equipment, or any passcode for the equipment, to any person. I understand that keeping the equipment safe and using it responsibly is solely my responsibility. In the event that something does happen to the equipment, or I am uncertain about usage of the equipment, I will contact Infosys Limited promptly. </li>
           <li>I understand at the conclusion on my assignment, whether voluntary or involuntary, I must return all Infosys Limited provided equipment within two business days.  The equipment return shall be facilitated by my employer.  I further agree to return all Infosys Limited equipment in good condition and proper working order.</li>
           <li>I understand that if I do not return such equipment in proper working order, I may be held financially responsible for lost or damaged property (to the extent allowable by applicable law). I further understand that any Infosys Limited equipment not returned or damaged shall be reported to the appropriate authorities as stolen or intentionally damaged equipment.</li>
          
       </ol>

       <table class="table">
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="border-bottom: 1px solid;">
                    <b><?= ucwords(strtolower($joiningFormDetails['first_name'] . ' ' . $joiningFormDetails['last_name']))?></b><Br>
                    Worker Name 
                   
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="border-bottom: 1px solid;">
                    <br>
                    <br>
                    <br>
                    Worker Signature 
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="white-space:nowrap">
                   <b><?=printFormatedDate(date('Y-m-d'))?></b><br>
                    Date of Worker Acknowledge
                    </td>
                </tr>
            </tbody>
       </table>
    </div>
</body>

</html>