<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Profile</title>
    <style>
        /** 
        Set the margins of the page to 0, so the footer and the header
        can be of the full height and width !
     **/
        @page {
            /* margin: 0; */
            margin-left: 1.5cm;
            margin-right: 1.5cm;
            margin-top: 2.5cm;
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
            font-size: 10px;
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

        table.table.no-border tr td,
        table.table.no-border {
            border: none !important;
        }

        .table.table-inner th,
        .table.table-inner td {
            padding: 3px 5px;
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

        .width-100 {
            display: inline-block;
            width: 100px;
        }
    </style>
</head>

<body>
    <!-- Tracking start -->

 

    <!-- <header>
        <img src="<?= base_url('/assets/images/bitstring-logo.jpeg') ?>" style="width:200px; ">
    </header> -->
    <!-- <footer class="text-center">
        <p class="footer-heading1"><b>BitString IT Services Private Limited</b></p>
        <p class="footer-heading2">CIN: U72900PN2019PTC187769</p>
        <p class="footer-heading2">Address: D 224, Palladium Exotica, Dhanori, Pune 411015, MH, INDIA</p>
        <p class="footer-heading2">Phone: +91 20 67024898 E-mail: admin@bitstringit.com Website: www.bitstringit.com</p>
    </footer> -->
    <!-- <center>
        <h2>JOINING FORM</h2>
    </center> -->

    <!-- <p>
        Please complete the form in <strong>BLOCK CAPITALS</strong> as fully as possible using sign. No section should be left blank. The information you provide in this form will be subject to verification by the company.
    </p> -->

    <!--table:employe details start-->
    <div style="position: absolute;top:-70px;left:0;">
    <table class="table no-border">
        <tbody>
            <tr>
                <td style="vertical-align:initial;margin:0;padding:0;font-size:18px; ">
                    <?= ucwords(strtolower($joiningFormDetails['first_name'] . ' ' . $joiningFormDetails['last_name'])) ?>
                </td>
                <td style="vertical-align: initial ;text-align: right;">
                    <b><?= $joiningFormDetails['mobile_primary'] ?></b><br>
                    <b><?= $joiningFormDetails['email_primary'] ?></b>
                </td>
            </tr>
        </tbody>
    </table>
        
    </div>
    <table class="table table-inner table-bordered">
        <tbody>
            <tr>
                <th colspan="4">Personal Details: <?= ucwords(strtolower($joiningFormDetails['first_name'] . ' ' . $joiningFormDetails['last_name'])) ?></th>
            </tr>
            <tr>
                <td colspan="2">
                    <div>
                        <label>E-mail Id:</label>
                        <b><?= $joiningFormDetails['email_primary'] ?> <?= $joiningFormDetails['email_alternate']?', '.$joiningFormDetails['email_alternate']:'' ?></b>
                    </div>
                    
                    <div>
                        <label>Mobile No.:</label>
                        <b><?= $joiningFormDetails['mobile_primary'] ?> <?= $joiningFormDetails['mobile_alternate']?', '.$joiningFormDetails['mobile_alternate']:'' ?></b>
                    </div>
                    <div>
                        <label>Date of Birth:</label>
                        <b><?= $joiningFormDetails['dob'] ?></b>
                    </div>
                  
                    
                </td>
                <td colspan="2">
                    <div>
                        <label>Marital Status:</label>
                        <b><?= $joiningFormDetails['marital_status'] ?></b>
                    </div>
                    <div>
                        <label>Gender:</label>
                        <b><?= $joiningFormDetails['gender'] ?></b>
                    </div>
                    <div>
                        <label>Father's Name:</label>
                        <b><?= $joiningFormDetails['father_name'] ?></b>
                    </div>
                   
                   
                </td>
            </tr>



            <tr>

                <td colspan="4">
                    <label>Present Address:</label>
                    <span><?= $joiningFormDetails['present_address'] ?></span>
                    <?php if (!empty($joiningFormDetails['present_address_city'])) { ?>
                        <label class="ml-5">City:</label>
                        <span><?= $joiningFormDetails['present_address_city'] ?></span>
                    <?php } ?>
                    <label class="ml-5">Postcode:</label>
                    <span><?= $joiningFormDetails['present_address_postcode'] ?></span>
                </td>

                
            </tr>
            <tr>
                <td colspan="4">
                    <label>Permanent Address:</label>
                    <span><?= $joiningFormDetails['permanent_address'] ?></span>
                    <?php if (!empty($joiningFormDetails['permanent_address_city'])) { ?>
                        <label class="ml-5">City:</label>
                        <span><?= $joiningFormDetails['permanent_address_city'] ?></span>
                    <?php } ?>
                    <label class="ml-5">Postcode:</label>
                    <span><?= $joiningFormDetails['permanent_address_postcode'] ?></span>
                </td>
            </tr>

            <tr>


                
                <td colspan="1">
                    <label>Current Company:</label>
                    <span><span><?= $joiningFormDetails['current_company'] ?></span></span>

                </td>
                <td colspan="1">
                    <label>Total Experience:</label>
                    <span><?= $joiningFormDetails['total_experience_y'] ?> Years</span> <span><?= $joiningFormDetails['total_experience_m'] ?> Months</span>

                </td>
                <td colspan="2">
                    <label>Relevant Experience:</label>
                    <span><?= $joiningFormDetails['relevant_experience_y'] ?> Years</span> <span><?= $joiningFormDetails['relevant_experience_m'] ?> Months</span>

                </td>
               
                
            </tr>

        </tbody>
    </table>
    


    <!--table:educational qualification start-->
    <table class="table table-inner table-bordered">
        <tbody>
            <tr>
                <th colspan="7">Academic Details</th>
            </tr>
            <tr>
                <td><b>Degree / Course</b></td>
                <td><b>Board / University</b></td>
                <td style="width: 25%;"><b>School / Institution</b></td>
                <td><b>From</b></td>
                <td><b>To</b></td>
                <td><b>Course Type</b></td>
                <td><b>%age / CGPA</b></td>
            </tr>
            <?php if (!empty($joiningFormDetails['education_qualification'])) { ?>
                <?php foreach ($joiningFormDetails['education_qualification'] as $e_qualification) { ?>
                    <tr>
                        <td><?= $e_qualification['degree'] ?></td>
                        <td><?= $e_qualification['university'] ?></td>
                        <td><?= $e_qualification['institution'] ?></td>
                        <td><?= $e_qualification['from_date'] ?></td>
                        <td><?= $e_qualification['to_date'] ?></td>
                        <td><?= $e_qualification['course_type'] ?></td>
                        <td><?= $e_qualification['percentage'] ?></td>
                    </tr>

                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="7"> No data available </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <!--table:educational qualification end-->

    <!--table:Professional qualification start-->
    <table class="table table-inner table-bordered">
        <tbody>
            <tr>
                <th colspan="3">
                    <p>Professional qualifications, memberships & licences</p>
                </th>
            </tr>
            <tr>
                <td style="width: 50%;"><b>Qualification / Body / Institute / Licence</b></td>
                <td><b>Category / Membership level</b></td>
                <td><b>Date</b></td>
            </tr>
            <?php if (!empty($joiningFormDetails['professional_qualification'])) { ?>
                <?php foreach ($joiningFormDetails['professional_qualification'] as $p_qualification) { ?>
                    <tr>
                        <td><?= $p_qualification['qualification'] ?></td>
                        <td><?= $p_qualification['category'] ?></td>
                        <td><?= $p_qualification['date'] ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="3"> No data available </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <!--table:Professional qualification end-->

    <!--table:employment history start-->
    <table class="table table-inner table-bordered">
        <tbody>
            <tr>
                <th>
                    Employment History
                </th>
            </tr>
        </tbody>
    </table>
    <!--table:employment history end-->



    <!--table:previous employer start-->
    <?php $employers =  $joiningFormDetails['employment_history']['employers'] ? (array)$joiningFormDetails['employment_history']['employers'] : []; ?>

    <?php foreach ($employers as $key => $p_employer) {
        $p_employer = (array)$p_employer ?>
        <table class="table table-inner table-bordered">
            <tbody>
                <tr>
                    <th colspan="4">
                        Employer <?= $key + 1 ?>: <?= $p_employer['company'] . " (" . $p_employer['from_date'] . " - " . $p_employer['to_date'] . ")" ?>
                    </th>
                </tr>
                <tr>

                    <td colspan="1">
                        <label>Position held:</label>
                        <span><?= $p_employer['position_held'] ?></span>
                        <br>
                        <label>Department :</label>
                        <span><?= $p_employer['department'] ?></span>
                    </td>
                    <td colspan="2">
                        <label>Nature of job:</label>
                        <span><?= $p_employer['nature_of_job'] ?></span>
                    </td>
                    <td colspan="1">
                        <label>Annual CTC(in Lacs):</label>
                        <span><?= $p_employer['annual_ctc'] ?></span>
                    </td>

                </tr>
                <tr>
                    <td colspan="2">
                        <label>Reason for leaving:</label>
                        <span><?= $p_employer['reason_of_leaving'] ?></span>
                    </td>
                    <td colspan="2">
                        <label>Primary Job Responsibilities:</label>
                        <span><?= $p_employer['job_responsibilities'] ?></span>
                    </td>

                </tr>

                <tr>
                    <td colspan="2">
                        <label>Address:</label>
                        <span><?= $p_employer['address'] ?></span>
                    </td>

                    <td colspan="1">
                        <label>City:</label>
                        <span><?= $p_employer['city'] ?></span>
                    </td>
                    <td colspan="1">
                        <label>Telephone:</label>
                        <span><?= $p_employer['telephone'] ?></span>
                    </td>
                </tr>



                <tr>
                    <td colspan="4">
                        <b>Reporting Manager:</b>

                        <label>Name:</label> <span><?= $p_employer['reporting_manager'] ?></span>
                        <label class="ml-5">Contact No:</label> <span><?= $p_employer['contact_number_manager'] ?></span>
                        <label class="ml-5">E-Mail:</label> <span><?= $p_employer['email_manager'] ?></span>


                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <label>HR Name:</label> <span><?= $p_employer['hr_name'] ?></span>
                        <label class="ml-5">Contact No:</label> <span><?= $p_employer['hr_contact_number'] ?> <?= $p_employer['hr_designation'] ? "(" . $p_employer['hr_designation'] . ")" : "" ?></span>
                        <label class="ml-5">E-Mail:</label> <span><?= $p_employer['hr_email'] ?></span>

                    </td>
                </tr>
            </tbody>
        </table>
    <?php } ?>
    <!--table:previous employer end-->


</body>

</html>