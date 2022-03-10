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

    <?php
    // echo "<pre>";
    // print_r($joiningFormDetails);
    // die;
    ?>

    <header>
        <img src="<?= base_url('/assets/images/bitstring-logo.jpeg') ?>" style="width:200px; ">
    </header>
    <footer class="text-center">
        <p class="footer-heading1"><b>BitString IT Services Private Limited</b></p>
        <p class="footer-heading2">CIN: U72900PN2019PTC187769</p>
        <p class="footer-heading2">Address: D 224, Palladium Exotica, Dhanori, Pune 411015, MH, INDIA</p>
        <p class="footer-heading2">Phone: +91 20 67024898 E-mail: admin@bitstringit.com Website: www.bitstringit.com</p>
    </footer>
    <center>
        <h2>JOINING FORM</h2>
    </center>

    <!-- <p>
        Please complete the form in <strong>BLOCK CAPITALS</strong> as fully as possible using sign. No section should be left blank. The information you provide in this form will be subject to verification by the company.
    </p> -->

    <!--table:employe details start-->
    <div style="position: absolute;top:-70px;right:0;">
        <b><?= ucwords(strtolower($joiningFormDetails['first_name'] . ' ' . $joiningFormDetails['last_name'])) ?></b><br>
        <b><?= $joiningFormDetails['mobile_primary'] ?></b><br>
        <b><?= $joiningFormDetails['email_primary'] ?></b>
    </div>
    <table class="table table-inner table-bordered">
        <tbody>
            <tr>
                <th colspan="4">Employee Details: <?= ucwords(strtolower($joiningFormDetails['first_name'] . ' ' . $joiningFormDetails['last_name'])) ?></th>
            </tr>
            <tr>
                <td colspan="2">
                    <div>
                        <label>E-mail Id:</label>
                        <b><?= $joiningFormDetails['email_primary'] ?></b>
                    </div>
                    <div>
                        <label>Mobile Tel. No.:</label>
                        <b><?= $joiningFormDetails['mobile_primary'] ?></b>
                    </div>
                    <div>
                        <label>Date of Birth:</label>
                        <b><?= $joiningFormDetails['dob'] ?></b>
                    </div>
                    <div>
                        <label>Marital Status:</label>
                        <b><?= $joiningFormDetails['employee_other_details']['marital_status'] ?></b>
                    </div>
                    <div>
                        <label>Gender:</label>
                        <b><?= $joiningFormDetails['employee_other_details']['gender'] ?></b>
                    </div>
                    <div>
                        <label>Blood Group:</label>
                        <b><?= $joiningFormDetails['employee_other_details']['blood_group'] ?></b>
                    </div>
                    <div>
                        <label>Place of Birth:</label>
                        <b><?= $joiningFormDetails['place_of_birth'] ?></b>
                    </div>
                    <div>
                        <label>Nationality:</label>
                        <b><?= $joiningFormDetails['nationality'] ?></b>
                    </div>
                </td>
                <td colspan="2">
                    <div>
                        <label>Father's Name:</label>
                        <b><?= $joiningFormDetails['father_name'] ?></b>
                    </div>

                    <div>
                        <label>Mother’s Name:</label>
                        <b><?= $joiningFormDetails['mother_name'] ?></b>
                    </div>
                    <?php if ($joiningFormDetails['employee_other_details']['marital_status'] == 'Married') { ?>
                        <div>
                            <label>Spouse’s Name:</label>
                            <b><?= $joiningFormDetails['spouse_name'] ?></b>
                        </div>
                    <?php } ?>
                    <div>
                        <label>Emergency Contact Name:</label>
                        <b><?= $joiningFormDetails['employee_other_details']['emergency_contact_name'] ?></b>
                    </div>
                    <div>
                        <label>Emergency Mobile No.:</label>
                        <b><?= $joiningFormDetails['employee_other_details']['emergency_contact_mobile'] ?></b>
                    </div>
                    <div>
                        <label>PAN No:</label>
                        <b><?= $joiningFormDetails['pan_number'] ?></b>
                    </div>
                    <div>
                        <label>Aadhar No.:</label>
                        <b><?= $joiningFormDetails['aadhar_number'] ?></b>
                    </div>
                    <div>
                        <label>UAN No:</label>
                        <b><?= isset($joiningFormDetails['employee_other_details']['uan_number'])?$joiningFormDetails['employee_other_details']['uan_number']:'' ?></b>
                    </div>
                    <div>
                        <label>Medical conditions, if any:</label>
                        <span><?= isset($joiningFormDetails['employee_other_details']['medical_condition'])?$joiningFormDetails['employee_other_details']['medical_condition']:'' ?></span>
                    </div>
                </td>
            </tr>


            <!-- <tr>
                <td colspan="4">

                    <label for="">Bank details</label>
                    <div>
                        <label for="">Name:</label>
                        <span><?= $joiningFormDetails['employee_other_details']['bank_name_branch'] ?></span>
                        <label class="ml-5">A/c No:</label>
                        <span><?= $joiningFormDetails['employee_other_details']['bank_account_number'] ?></span>
                        
                    </div>
                </td>
            </tr> -->



            <tr>

                <td colspan="2">
                    <label>Present Address:</label>
                    <span><?= isset($joiningFormDetails['employee_other_details']['present_address'])?$joiningFormDetails['employee_other_details']['present_address']:'' ?></span>
                    <?php if (!empty($joiningFormDetails['employee_other_details']['present_address_city'])) { ?>
                        <label class="ml-5">City:</label>
                        <span><?= $joiningFormDetails['employee_other_details']['present_address_city'] ?></span>
                    <?php } ?>
                    <label class="ml-5">Postcode:</label>
                    <span><?= $joiningFormDetails['employee_other_details']['present_address_postcode'] ?></span>
                </td>

                <td colspan="2">
                    <label>For how long are you residing at this address (Year/Months):</label>
                    <span><?= $joiningFormDetails['employee_other_details']['present_address_residing_duration'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <label>Permanent Address:</label>
                    <span><?= $joiningFormDetails['employee_other_details']['permanent_address'] ?></span>
                    <?php if (!empty($joiningFormDetails['employee_other_details']['permanent_address_city'])) { ?>
                        <label class="ml-5">City:</label>
                        <span><?= $joiningFormDetails['employee_other_details']['permanent_address_city'] ?></span>
                    <?php } ?>
                    <label class="ml-5">Postcode:</label>
                    <span><?= $joiningFormDetails['employee_other_details']['permanent_address_postcode'] ?></span>
                </td>
            </tr>

            <tr>


                <td colspan="2">
                    <label>Nature of Job hired for (Permanent/Contractual):</label>
                    <span><?= isset($joiningFormDetails['employee_other_details']['nature_of_job_hired'])?$joiningFormDetails['employee_other_details']['nature_of_job_hired']:'' ?></span>

                </td>
                <td colspan="1">
                    <label>Total Experience (Years):</label>
                    <span><span><?= isset($joiningFormDetails['employee_other_details']['total_experience'])?$joiningFormDetails['employee_other_details']['total_experience']:'' ?></span></span>

                </td>
                <td colspan="1">
                    <label>Date of Joining:</label>
                    <span><?= isset($joiningFormDetails['employee_other_details']['date_of_joining'])?$joiningFormDetails['employee_other_details']['date_of_joining']:'' ?></span>

                </td>
            </tr>

        </tbody>
    </table>
    <!--table:employe details end-->
    <table class="table table-inner ">
        <tbody>
            <tr>
                <th colspan="3">Bank Details (for salary)</th>
            </tr>
            <!-- <tr>
                <td><label>Bank Name</label></td>
                <td><label>Account Number</label></td>
                <td><label>IFSC Code</label></td>
            </tr> -->
            <tr>
                <td>
                    <label for="">Bank Name:</label>
                    <span><?= $joiningFormDetails['employee_other_details']['bank_name_branch'] ?></span>
                </td>
                <td>
                    <label class="ml-5">Account No:</label>
                    <span><?= $joiningFormDetails['employee_other_details']['bank_account_number'] ?></span>
                </td>
                <td>
                    <label for="" class="ml-5">IFSC Code:</label>
                    <span><?= $joiningFormDetails['employee_other_details']['bank_ifsc_code'] ?></span>
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
                    <ul>
                        <li>Professional qualifications obtained or being studied for</li>
                        <li>Memberships of professional bodies</li>
                        <li>Professional licenses, certificates or registrations, including registrations with a regulatory body (e.g. ICAI) and whether you are in an approved regulatory role</li>
                    </ul>
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
            <tr>
                <td>
                    <p> Starting with your <b>most recent employer</b> please give details of your complete employment history since you left full time education. Include any periods of self-employment, unemployment, maternity leave or <b>military service.</b> Include all part time and temporary employment and provide details of both the agencies and placements. Under ‘position held’ state clearly if you were a partner or had an ownership interest in any of the employing companies, or if the position was part time. If you are aware that one of your employers has changed its trading name, please provide the former name first, followed by the new name.</p>
                    <p><b>Please sign an authorization letter to allow us to do a complete background check.</b></p>
                </td>
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

    <!--table:Gap declaration start-->
    <table class="table table-inner table-bordered">
        <tbody>
            <tr>
                <th colspan="4">
                    GAP DECLARATION*
                </th>
            </tr>
            <tr>
                <td style="width: 5%;"><b>Sr.No.</b></td>
                <td style="width: 65%;"><b>Particulars (Reason)</b></td>
                <td><b>From</b></td>
                <td><b>To</b></td>
            </tr>
            <?php if (!empty($joiningFormDetails['gap_declaration'])) { ?>
                <?php foreach ($joiningFormDetails['gap_declaration'] as $key => $gap) { ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $gap['particular'] ?></td>
                        <td><?= $gap['from_date'] ?></td>
                        <td><?= $gap['to_date'] ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="4"> No data available </td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="4">
                    <p>* GAP Declaration to be filed when there is a time gap between two Employments OR between Education and Employment OR between Education and Education.</p>
                    <p>* Any gap of more than 3 months to be filled in with complete details and supporting documents.</p>
                </td>
            </tr>
        </tbody>
    </table>
    <!--table:Gap declaration end-->




    <!--table:previous addresses start-->
    <table class="table table-inner table-bordered">
        <tbody>
            <tr>
                <th colspan="3">Previous Addresses</th>
            </tr>
            <tr>
                <td colspan="3">
                    <p>Please include full personal address history to cover the last 7 years including dates.</p>
                </td>
            </tr>

            <tr>
                <td style="width: 50%;">Address</td>
                <td>Postcode</td>
                <td>Dates resident at this address (from and to)</td>
            </tr>

            <?php if (!empty($joiningFormDetails['background_info']['previous_address'])) { ?>
                <?php foreach ($joiningFormDetails['background_info']['previous_address'] as $key => $address) { ?>
                    <tr>

                        <td><?= $address->address ?></td>
                        <td><?= $address->postcode ?></td>
                        <td><?= "$address->from_date - $address->to_date" ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="3"> No data available </td>
                </tr>
            <?php } ?>

        </tbody>
    </table>
    <!--table:previous addresses end-->

    <!--table:mediclam/medical insurance start-->
    <table class="table table-inner table-bordered">
        <tbody>
            <tr>
                <th colspan="4">Mediclaim / Medical Insurance</th>
            </tr>

            <tr>
                <td>
                    <b>Full Name </b>
                </td>
                <td>
                    <b>Relationship</b>
                </td>
                <td>
                    <b>Date of Birth</b>
                </td>
                <td>
                    <b>Age</b>
                </td>
            </tr>
            <?php if (!empty($joiningFormDetails['mediclaim'])) { ?>
                <?php foreach ($joiningFormDetails['mediclaim'] as $key => $mediclaim) { ?>
                    <tr>
                        <td><?= $mediclaim['name'] ?></td>
                        <td><?= $mediclaim['relationship'] ?></td>
                        <td><?= $mediclaim['dob'] ?></td>
                        <td><?= $mediclaim['age'] ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="4"> No data available </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <p>* Please submit passport size photograph of all the members mentioned above.</p>
    <!--table:mediclam/medical insurance end-->

    <table class="table table-inner table-bordered">
        <tbody>
            <tr>
                <th colspan="3">Employees Close Relatives working with BitString, if any</th>
            </tr>

            <tr>
                <td>
                    <b>Name </b>
                </td>
                <td>
                    <b>Relationship</b>
                </td>
                <td>
                    <b>Position</b>
                </td>
            </tr>
            <?php if (!empty($joiningFormDetails['background_info']['relative_with_bitstring'])) { ?>
                <?php foreach ($joiningFormDetails['background_info']['relative_with_bitstring'] as $key => $relative) {
                    $relative = (array)$relative; ?>
                    <tr>
                        <td><?= $relative['name'] ?></td>
                        <td><?= $relative['relationship'] ?></td>
                        <td><?= $relative['position'] ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="3"> No data available </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>


    <!--table:background information start-->
    <table class="table table-inner table-bordered">

        <tbody>
            <tr>
                <th colspan="12">
                    <p><b>Background Information</b></p>
                    <p>If you respond ‘yes’ to any of the questions please provide full details on a separate sheet and attach to this application.</p>

                </th>
            </tr>
            <tr>
                <th colspan="12">
                    Criminal and civil record
                </th>
            </tr>
            <tr>
                <td colspan="11">
                    <?= getBackgroundInformationQuestion('C01') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['criminal_and_civil_record']->C01 ? "Yes" : "No" ?>
                </td>
            </tr>

            <tr>
                <td colspan="11">
                    <?= getBackgroundInformationQuestion('C02') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['criminal_and_civil_record']->C02 ? "Yes" : "No" ?>
                </td>
            </tr>

            <tr>
                <td colspan="11">
                    <?= getBackgroundInformationQuestion('C03') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['criminal_and_civil_record']->C03 ? "Yes" : "No" ?>
                </td>
            </tr>

            <tr>
                <td colspan="11">
                    <?= getBackgroundInformationQuestion('C04') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['criminal_and_civil_record']->C04 ? "Yes" : "No" ?>
                </td>
            </tr>

            <tr>
                <td colspan="11">
                    <?= getBackgroundInformationQuestion('C05') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['criminal_and_civil_record']->C05 ? "Yes" : "No" ?>
                </td>
            </tr>

            <tr>
                <td colspan="11">
                    <?= getBackgroundInformationQuestion('C06') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['criminal_and_civil_record']->C06 ? "Yes" : "No" ?>
                </td>
            </tr>

            <tr>
                <td colspan="11">
                    <?= getBackgroundInformationQuestion('C07') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['criminal_and_civil_record']->C07 ? "Yes" : "No" ?>
                </td>
            </tr>

            <tr>
                <td colspan="11">
                    <?= getBackgroundInformationQuestion('C08') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['criminal_and_civil_record']->C08 ? "Yes" : "No" ?>
                </td>
            </tr>

            <tr>
                <th colspan="12">
                    Business Interests
                </th>
            </tr>
            <tr>
                <td colspan="11">
                    <?= getBackgroundInformationQuestion('B01') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['business_interest']->B01 ? "Yes" : "No" ?>
                </td>
            </tr>
            <tr>
                <td colspan="11">
                    <?= getBackgroundInformationQuestion('B02') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['business_interest']->B02 ? "Yes" : "No" ?>
                </td>
            </tr>
            <tr>
                <td colspan="11">
                    <?= getBackgroundInformationQuestion('B03') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['business_interest']->B03 ? "Yes" : "No" ?>
                </td>
            </tr>
            <tr>
                <td colspan="11">
                    <?= getBackgroundInformationQuestion('B04') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['business_interest']->B04 ? "Yes" : "No" ?>
                </td>
            </tr>


            <tr>
                <th colspan="12">
                    Other actions and disqualifications
                </th>
            </tr>
            <tr>
                <td colspan="11">
                    <?= getBackgroundInformationQuestion('O01') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['other_disqualification']->O01 ? "Yes" : "No" ?>
                </td>
            </tr>
            <tr>
                <td colspan="11">
                    <?= getBackgroundInformationQuestion('O02') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['other_disqualification']->O02 ? "Yes" : "No" ?>
                </td>
            </tr>
            <tr>
                <td colspan="11">
                    <?= getBackgroundInformationQuestion('O03') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['other_disqualification']->O03 ? "Yes" : "No" ?>
                </td>
            </tr>
            <tr>
                <td colspan="11">
                    <?= getBackgroundInformationQuestion('O04') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['other_disqualification']->O04 ? "Yes" : "No" ?>
                </td>
            </tr>

        </tbody>
    </table>
    <!--table:background information end-->

    <!--table:declaration start-->
    <table class="table table-inner table-bordered">
        <tbody>
            <tr>
                <th colspan="6">Data Protection</th>
            </tr>
            <tr>
                <td colspan="6">
                    <p>I <?= $joiningFormDetails['first_name'] . " " . $joiningFormDetails['last_name'] ?> hereby give my consent to the employer or any agent thereof to process the data supplied in this application form for the purposes of recruitment and selection. I accept that this data may be sent and processed in or outside India.</p>
                    <p>You have the right to apply for a copy of our information and to have any inaccuracies corrected.</p>
                </td>
            </tr>

            <tr>
                <td colspan="6">
                    <b>Applicant’s signature: </b>
                    <br>
                    <br>
                </td>
            </tr>

            <tr>
                <td colspan="5"><label>Full Name:</label> <?= $joiningFormDetails['first_name'] . " " . $joiningFormDetails['last_name'] ?> </td>
                <td><label>Date:</label> <?= $joiningFormDetails['is_accept_declaration'] ? printFormatedDate($joiningFormDetails['is_accept_declaration']) : '' ?> </td>
            </tr>
        </tbody>
    </table>

    <table class="table table-inner table-bordered">
        <tbody>
            <tr>
                <th colspan="6">Declaration & Authorization</th>
            </tr>
            <tr>
                <td colspan="6">
                    <p>I <?= $joiningFormDetails['first_name'] . " " . $joiningFormDetails['last_name'] ?> certify that to the best of my knowledge all the information given in this form is true and complete. I understand that any appointment offered will be subject to the information given on this form being correct. I understand that any offer of employment is conditional upon the verification of any or all of the information I have supplied. I understand and accept that the provision of misleading, false or inaccurate information or the omission of a material fact may be legitimate cause for the immediate withdrawal of any offer of employment or, if I am already employed, for disciplinary action up to and including dismissal.</p>
                    <p>I <?= $joiningFormDetails['first_name'] . " " . $joiningFormDetails['last_name'] ?> authorize BitString IT Services Pvt Ltd or any agent thereof to verify information presented on this form and to make inquiries of the school, college or university where a qualification was gained as well as approach previous employers and personal references for verification of my employment records. I acknowledge that all referees are disclosing the above information at my express request and that I will make no claim whatsoever against such referee, its agents and/or employees arising out of disclosure of such information. This shall be the case whether the content of any such document obtained is accurate or inaccurate and/or any information is true or untrue.</p>
                </td>
            </tr>

            <tr>
                <td colspan="6">
                    <b>Employee's signature: </b>
                    <br>
                    <br>
                </td>
            </tr>

            <tr>
                <td colspan="5"><label>Full Name:</label> <?= $joiningFormDetails['first_name'] . " " . $joiningFormDetails['last_name'] ?> </td>
                <td><label>Date:</label> <?= $joiningFormDetails['is_accept_declaration'] ? printFormatedDate($joiningFormDetails['is_accept_declaration']) : '' ?> </td>
            </tr>
        </tbody>
    </table>
    <!--table:declaration end-->

    <!--table:Annexure start-->
    <div style="page-break-before: always;">
        <h3><u>Annexure</u></h3>
        <b>List of Documents to be submitted on Joining:</b>
        <ol>
            <li>Education documents
                <ul>
                    <li>Your degree/s - Graduation or Post Graduation (last highest degree) certificate photocopy & final year/ semester mark sheet</li>
                </ul>
            </li>
            <li>Employment documents
                <ul>
                    <li>Resignation e-mail/letter copy of the last company.</li>
                    <li>Last 3 months salary slip</li>
                    <li>Full & Final settlement letter</li>
                    <li>Relieving & Experience letter copies of last 2 employment</li>
                    <li>Internship/Apprentice letter, if applicable</li>
                </ul>
            </li>
            <li>Identification documents required:
                <ul>
                    <li>Pan card & Aadhar Card copy, or</li>
                    <li>Passport copy, or</li>
                    <li>Class 10th (X th) certificate</li>
                </ul>
            </li>
        </ol>


        <p>Please Note: If you “DO NOT” have a PAN card, apply for it immediately, by logging to the below link <a target="_blank" href="https://tin.tin.nsdl.com/pan/index.html">https://tin.tin.nsdl.com/pan/index.html</a></p>

        <p>Any delays in submitting the PAN number, may delay our payroll team in processing your salary.</p>

    </div>
    <!--table:Annexure end-->

</body>

</html>