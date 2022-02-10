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
        ol li, ul li {
            margin-bottom: 10px;
            text-align: justify;
        }
    </style>
</head>

<body>
    <center>
        <h3>Infosys Limited Information Security Awareness Acknowledgement</h3>
    </center>
 
    <div>
        <p>
        I <?=strtoupper($joiningFormDetails['first_name'] . ' ' . $joiningFormDetails['last_name'])?>  acknowledge that I have read and understood the information security awareness guidelines (Infosys Limited Information Security Do’s and Don’ts) shared by Infosys Limited on <?=date('d/m/Y')?>.
        </p>

        <p style="margin-top: 15px;">I hereby understand and agree to -</p>
        <ul>
            <li>Comply with Infosys and Infosys client’s policies communicated to me. For the purposes of this acknowledgment, communication shall include communication through display on Infosys’ website, as the case may be or through specific documentation provided to me.</li>
            <li>Abide by all the guidelines outlined in the Infosys Limited Information Security Do’s and Don’ts document.</li>
            <li>Not share or misuse Infosys or Infosys’ client assigned access credentials.</li>
            <li>Safeguard Infosys and Infosys’ client assigned assets</li>
            <li>Not share Infosys or Infosys’ client confidential data outside the secure network and/ or with any unauthorized individuals.</li>
        </ul>
	
        <p style="margin-top: 15px;">I agree that if I fail to comply with the above undertakings, my access may be revoked immediately, and Infosys Limited and [[insert client name]] can take all remedies available under law against me, including damages for breach of this undertaking.</p>


       <table class="table">
            <tbody>
                <tr>
                    <td>Signature</td><td colspan="2" style="border-bottom: 1px solid;"></td>
                </tr>
                <tr>
                    <td>Name</td><td colspan="2" style="border-bottom: 1px solid;"><b><?= ucwords(strtolower($joiningFormDetails['first_name'] . ' ' . $joiningFormDetails['last_name']))?></b></td>
                </tr>
                <tr>
                    <td>Emp. No.</td><td colspan="2" style="border-bottom: 1px solid;"></td>
                </tr>
                <tr>
                    <td>Organization Name</td><td colspan="2" style="border-bottom: 1px solid;"></td>
                </tr>
                <tr>
                    <td>Infosys Project Manager</td ><td colspan="2" style="border-bottom: 1px solid;"></td>
                </tr>
                <tr>
                    <td>Client Name</td><td colspan="2" style="border-bottom: 1px solid;"></td>
                </tr>
                <tr>
                    <td>Date (dd/mm/yyyy)</td><td colspan="2" style="border-bottom: 1px solid;"><b><?=date('d/m/Y')?></b></td>
                </tr>
                
            </tbody>
       </table>
    </div>
</body>

</html>