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

        ol li,
        ul li {
            margin-bottom: 10px;
            text-align: justify;
        }
    </style>
</head>

<body>
    <center>
        <h3>CONFIDENTIALITY AGREEMENT</h3>
    </center>

    <div>
        <p>
            I, the undersigned, contracted by BITSTRING IT SERVICES PRIVATE LIMITED to Infosys to work on an assignment for a client of Infosys acknowledge that:
        </p>

        <ol type="a">
            <li>I am allotted to an engagement (either onsite or offshore), where scope of such services provided to any client, will involve processing of information, including both proprietary and Personal Data of employees, Subcontractors, vendors and client, client end users. </li>
            <li>I am informed that any information that allows the identification of a natural person, either directly or indirectly, is considered Personal Data, including but not limited to information such as an identification number, location data, an online identifier or one or more characteristics specific to the physical, physiological, genetic, mental, economic, cultural or social identity of that natural person.</li>
            <li>Infosys Limited and its affiliates (collectively referred as either “Infosys”) provide specific written instructions with reference to the processing of Personal Data, pursuant to applicable data protection laws and regulations, including and not limited to laws, regulations, such as DIFC Law No. 5, 2020, LGPD (Brazil), POPIA (South Africa), General Data Protection Regulation (GDPR), UK GDPR, Implementing Laws of GDPR etc. (‘Data Protection Legislation”). </li>

        </ol>

        <p style="margin-top: 15px;">Notwithstanding the above, which forms an integral part of my engagement with Infosys, I hereby undertake to:</p>
        <ol type="1">
            <li>Collect and/or process Personal Data only according to the written instructions received by Infosys from the Client, and in any case, according to the applicable data protection provisions, including those set forth in the applicable Data Protection Legislation. </li>
            <li>Process Personal Data only in strict compliance with the law and the instructions received as part of scope of engagement. In particular, I undertake to make sure that all the data processed as a result of the performance of my services is:
                <ul>
                <li>Processed only if and to the extent required to fulfil the purposes of processing (“data minimization”) for the purposes agreed.</li>
                <li>Processed in a manner that ensures appropriate security of the personal data, including protection against unauthorised or unlawful access or processing and against accidental loss, destruction, or damage, using appropriate technical or organisational measures (“integrity and confidentiality”).</li>
            </ul>
            </li>
            
            <li>Observe strictest confidentiality with respect to the personal data I shall collect, process, or access as a result of the performance of my job, and refrain from disclosing it to any other natural or legal person, including co-workers and other staff members, where the latter are not expressly authorised to access such data by virtue of instructions by contract or law. </li>

        </ol>
        <p style="margin-top: 15px;">This non-disclosure and confidentiality obligations are not subject to any time limits and shall survive termination of my relationship (directly or indirectly) with Infosys.  I am aware that any infringement against this obligation or against the applicable Data Protection Legislation may result in significant fines, and potentially cause damage to natural or legal persons, including Infosys. </p>
        <p style="margin-top: 15px;">I am aware of the binding nature of the instructions provided by Infosys and that the breach of any such instructions, and I hereby agree to indemnify Infosys against any such claims or compensations, arising due to any violation of this document.</p>


        <table class="table">
            <tbody>
                <tr>
                    <td>Name: <b><?= ucwords(strtolower($joiningFormDetails['first_name'] . ' ' . $joiningFormDetails['last_name'])) ?></b></td>
                </tr>
                <tr>
                    <td>Signature:</td>
                </tr>
                <tr>
                    <td>Subcontractor ID:</td>
                </tr>
                <tr>
                    <td>Date (dd/mm/yyyy): <b><?= date('d/m/Y') ?></b></td>
                </tr>
                <tr>
                    <td>Place: <b><?=$joiningFormDetails['employee_other_details']['present_address_city'] ?></b></td>
                </tr>

            </tbody>
        </table>
    </div>
</body>

</html>