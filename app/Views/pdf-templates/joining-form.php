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

        table.table.no-border td,
        table.table.no-border {
            border: none;
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

    <p>
        Please complete the form in <strong>BLOCK CAPITALS</strong> as fully as possible using sign. No section should be left blank. The information you provide in this form will be subject to verification by the company.
    </p>

    <!--table:employe details start-->
    <table class="table table-inner table-bordered">
        <tbody>
            <tr>
                <th colspan="2">Employee Details</th>
            </tr>
            <tr>
                <td colspan="2">
                    <label>First Name:</label>
                    <span><?= $joiningFormDetails['first_name'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>Last Name:</label>
                    <span><?= $joiningFormDetails['last_name'] ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Father’s Name:</label>
                    <span><?= $joiningFormDetails['father_name'] ?></span>
                </td>
                <td>
                    <label>Mother’s Name:</label>
                    <span><?= $joiningFormDetails['mother_name'] ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Marital Status:</label>
                    <span><?= $joiningFormDetails['employee_other_details']['marital_status'] ?></span>
                </td>
                <td>
                    <label>Spouse’s Name (if applicable):</label>
                    <span><?= $joiningFormDetails['spouse_name'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>Kid(s) Name (if applicable):</label>
                    <span><?= $joiningFormDetails['kids_name'] ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Home Tel. No.:</label>
                    <span><?= $joiningFormDetails['employee_other_details']['home_tel_no'] ?></span>
                </td>
                <td>
                    <label>Mobile Tel. No.:</label>
                    <span><?= $joiningFormDetails['mobile_primary'] ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Emergency Contact Name:</label>
                    <span><?= $joiningFormDetails['employee_other_details']['emergency_contact_name'] ?></span><br>
                    <label>Relation:</label>
                    <span><?= $joiningFormDetails['employee_other_details']['emergency_contact_relation'] ?></span><br>

                </td>
                <td>
                    <label>Emergency Mobile No.:</label>
                    <span><?= $joiningFormDetails['employee_other_details']['emergency_contact_mobile'] ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>PAN No:</label>
                    <span><?= $joiningFormDetails['pan_number'] ?></span>

                </td>
                <td>
                    <label>Aadhar No.:</label>
                    <span><?= $joiningFormDetails['aadhar_number'] ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>UAN No:</label>
                    <span><?= $joiningFormDetails['employee_other_details']['uan_no'] ?></span>

                </td>
                <td>
                    <label>Bank Name & Branch.:</label>
                    <span><?= $joiningFormDetails['employee_other_details']['bank_name_branch'] ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Bank A/c No:</label>
                    <span><?= $joiningFormDetails['employee_other_details']['bank_account_number'] ?></span>

                </td>
                <td>
                    <label>IFS Code:</label>
                    <span><?= $joiningFormDetails['employee_other_details']['bank_ifsc_code'] ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Total Experience:</label>
                    <span></span>

                </td>
                <td>
                    <label>Blood Group:</label>
                    <span><?= $joiningFormDetails['employee_other_details']['blood_group'] ?></span><br>
                    <label>Medical conditions, if any:</label>
                    <span><?= $joiningFormDetails['employee_other_details']['medical_condition'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>Present Address:</label>
                    <span><?= $joiningFormDetails['employee_other_details']['present_address'] ?></span>

                </td>
            </tr>
            <tr>
                <td>
                    <label>Postcode:</label>
                    <span><?= $joiningFormDetails['employee_other_details']['present_address_postcode'] ?></span>

                </td>
                <td>
                    <label>For how long are you residing at this address (Year/Months):</label>
                    <span><?= $joiningFormDetails['employee_other_details']['present_address_residing_duration'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>Permanent Address:</label>
                    <span><?= $joiningFormDetails['employee_other_details']['permanent_address'] ?></span>

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>Postcode:</label>
                    <span><?= $joiningFormDetails['employee_other_details']['permanent_address_postcode'] ?></span>

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>Email Id:</label>
                    <span><?= $joiningFormDetails['email_primary'] ?></span>

                </td>
            </tr>
            <tr>
                <td>
                    <label>Date of Birth (DD/MM/YY):</label>
                    <span><?= $joiningFormDetails['dob'] ?></span>

                </td>
                <td>
                    <label>Place of Birth (Town/Country):</label>
                    <span><?= $joiningFormDetails['place_of_birth'] ?></span>

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>Nationality (both, if dual national):</label>
                    <span><?= $joiningFormDetails['nationality'] ?></span>

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>Nature of Job hired for (Permanent/Contractual):</label>
                    <span><?= $joiningFormDetails['employee_other_details']['nature_of_job_hired'] ?></span>

                </td>
            </tr>

        </tbody>
    </table>
    <!--table:employe details end-->

    <!--table:educational qualification start-->
    <table class="table table-inner table-bordered">
        <tbody>
            <tr>
                <th colspan="7">Educational Qualifications</th>
            </tr>
            <tr>
                <td><b>Degree / Course</b></td>
                <td><b>Course Title along with Board / University</b></td>
                <td style="width: 25%;"><b>Name and full address of school/Institution </b></td>
                <td><b>From (MM/YYYY)</b></td>
                <td><b>To (MM/YYYY)</b></td>
                <td><b>Full time / Part Time/ off campus / Open Univ.</b></td>
                <td><b>%age/ CGPA</b></td>
            </tr>
            <?php if (!empty($joiningFormDetails['education_qualification'])) { ?>
                <?php foreach ($joiningFormDetails['education_qualification'] as $e_qualification) { ?>
                    <tr>
                        <td><?= $e_qualification->degree ?></td>
                        <td><?= $e_qualification->university ?></td>
                        <td><?= $e_qualification->institution ?></td>
                        <td><?= $e_qualification->from_date ?></td>
                        <td><?= $e_qualification->to_date ?></td>
                        <td><?= $e_qualification->course_type ?></td>
                        <td><?= $e_qualification->percentage ?></td>
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
                    <p>Professional qualifications, memberships &licences</p>
                    <ul>
                        <li>Professional qualifications obtained or being studied for</li>
                        <li>Memberships of professional bodies</li>
                        <li>Professional licenses, certificates or registrations, including registrations with a regulatory body (e.g. ICAI) and whether you are in an approved regulatory role</li>
                    </ul>
                </th>
            </tr>
            <tr>
                <td style="width: 50%;"><b>Qualification/Body/Institute / Licence</b></td>
                <td><b>Category/Membership level</b></td>
                <td><b>Dates (MM/YY)</b></td>
            </tr>
            <?php if (!empty($joiningFormDetails['professional_qualification'])) { ?>
                <?php foreach ($joiningFormDetails['professional_qualification'] as $p_qualification) { ?>
                    <tr>
                        <td><?= $p_qualification->qualification ?></td>
                        <td><?= $p_qualification->category ?></td>
                        <td><?= $p_qualification->date ?></td>
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

    <!--table:employment summary start-->
    <table class="table table-inner table-bordered">
        <tbody>
            <tr>
                <th colspan="5">
                    Employment Summary
                </th>
            </tr>
            <tr>
                <td colspan="2"><b>Dates (MM/YYYY)</b></td>
                <td rowspan="2" style="width: 40%;"><b>Name of Organization</b></td>
                <td rowspan="2"><b>Reason for Leaving</b></td>
                <td rowspan="2"><b>Explain Employment gap (if Any)</b></td>
            </tr>
            <tr>
                <td><b>From</b></td>
                <td><b>To</b></td>
            </tr>

            <?php if (!empty($joiningFormDetails['employment_history']['employment_summary'])) { ?>
                <?php foreach ($joiningFormDetails['employment_history']['employment_summary'] as $e_summary) { ?>
                    <tr>
                        <td><?= $e_summary->date_from ?></td>
                        <td><?= $e_summary->date_to ?></td>
                        <td><?= $e_summary->company ?></td>
                        <td><?= $e_summary->reason_for_leaving ?></td>
                        <td><?= $e_summary->gap ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="5"> No data available </td>
                </tr>
            <?php } ?>

        </tbody>
    </table>
    <!--table:employment summary end-->

    <!--table:previous employer start-->
    <?php $p_employer =  $joiningFormDetails['employment_history']['previous_employer'] ? (array)$joiningFormDetails['employment_history']['previous_employer'] : null; ?>

    <table class="table table-inner table-bordered">
        <tbody>
            <tr>
                <th colspan="4">
                    Previous Employer
                </th>
            </tr>
            <tr>
                <td>
                    <label>Position held:</label>
                    <span><?= $p_employer['position_held'] ?></span>
                </td>
                <td>
                    <label for="">Dates (MM/YYYY)</label>
                </td>
                <td>
                    <label for="">From:</label>
                    <span><?= $p_employer['from_date']  ?></span>
                </td>
                <td>
                    <label for="">To:</label>
                    <span><?= $p_employer['to_date']  ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <label for="">Company:</label>
                    <span><?= $p_employer['company'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">Department:</label>
                    <span><?= $p_employer['department'] ?></span>
                </td>
                <td colspan="2">
                    <label for="">Nature of Job:</label>
                    <span><?= $p_employer['nature_of_job'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <label for="">Address:</label>
                    <span><?= $p_employer['address'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">City:</label>
                    <span><?= $p_employer['city'] ?></span>
                </td>
                <td colspan="2">
                    <label for="">Telephone:</label>
                    <span><?= $p_employer['telephone'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <label for="">Main Job Responsibilities:</label>
                    <span><?= $p_employer['job_responsibilities'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">Annual CTC(in Lacs):</label>
                    <span><?= $p_employer['annual_ctc'] ?></span>
                </td>
                <td colspan="2">
                    <label for="">Name of Reporting Manager:</label>
                    <span><?= $p_employer['reporting_manager'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">Contact No. of Manager:</label>
                    <span><?= $p_employer['contact_number_manager'] ?></span>
                </td>
                <td colspan="2">
                    <label for="">E-Mail ID of Manager:</label>
                    <span><?= $p_employer['email_manager'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <label for="">Reason for leaving:</label>
                    <span><?= $p_employer['reason_of_leaving'] ?></span>
                </td>
            </tr>
        </tbody>
    </table>
    <!--table:previous employer end-->

    <!--table:previous-to-previous employer start-->
    <?php $p_to_p_employer =  $joiningFormDetails['employment_history']['previous_to_previous_employer'] ? (array)$joiningFormDetails['employment_history']['previous_to_previous_employer'] : null; ?>
    <table class="table table-inner table-bordered">
        <tbody>
            <tr>
                <th colspan="4">
                    Previous to Previous Employer
                </th>
            </tr>
            <tr>
                <td>
                    <label>Position held:</label>
                    <span><?= $p_to_p_employer['position_held'] ?></span>
                </td>
                <td>
                    <label for="">Dates (MM/YYYY)</label>
                </td>
                <td>
                    <label for="">From:</label>
                    <span><?= $p_to_p_employer['from_date'] ?></span>
                </td>
                <td>
                    <label for="">To:</label>
                    <span><?= $p_to_p_employer['to_date'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <label for="">Company:</label>
                    <span><?= $p_to_p_employer['company'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">Department:</label>
                    <span><?= $p_to_p_employer['department'] ?></span>
                </td>
                <td colspan="2">
                    <label for="">Nature of Job:</label>
                    <span><?= $p_to_p_employer['nature_of_job'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <label for="">Address:</label>
                    <span><?= $p_to_p_employer['address'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">City:</label>
                    <span><?= $p_to_p_employer['city'] ?></span>
                </td>
                <td colspan="2">
                    <label for="">Telephone:</label>
                    <span><?= $p_to_p_employer['telephone'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <label for="">Main Job Responsibilities:</label>
                    <span><?= $p_to_p_employer['job_responsibilities'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">Annual CTC(in Lacs):</label>
                    <span><?= $p_to_p_employer['annual_ctc'] ?></span>
                </td>
                <td colspan="2">
                    <label for="">Name of Reporting Manager:</label>
                    <span><?= $p_to_p_employer['reporting_manager'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">Contact No. of Manager:</label>
                    <span><?= $p_to_p_employer['contact_number_manager'] ?></span>
                </td>
                <td colspan="2">
                    <label for="">E-Mail ID of Manager:</label>
                    <span><?= $p_to_p_employer['email_manager'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <label for="">Reason for leaving:</label>
                    <span><?= $p_to_p_employer['reason_of_leaving'] ?></span>
                </td>
            </tr>
        </tbody>
    </table>
    <!--table:previous-to-previous employer end-->

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
                <td><b>Gap Period From</b></td>
                <td><b>Gap Period To</b></td>
            </tr>
            <?php if (!empty($joiningFormDetails['employment_history']['gap_declaration'])) { ?>
                <?php foreach ($joiningFormDetails['employment_history']['gap_declaration'] as $key=>$gap) { ?>
                    <tr>
                        <td><?=$key+1?></td>
                        <td><?= $gap->particular ?></td>
                        <td><?= $gap->from_date ?></td>
                        <td><?= $gap->to_date ?></td>
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

    <!--table:hr references start-->
    <table class="table table-inner table-bordered">
        <tbody>
            <tr>
                <th colspan="2">
                    HR References
                </th>
            </tr>

            <tr>
                <td colspan="2">
                    <p>Please give the details of HR (from previous organizations) including contact details and company details.</p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Reference 1</b> (<i>from previous organization</i>)
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Name:</label>
                    <span><?=$p_employer['hr_name']?></span>
                </td>
                <td>
                    <label for="">Designation:</label>
                    <span><?=$p_employer['hr_designation']?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">Company:</label>
                    <span><?=$p_employer['company']?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">Company's Address:</label>
                    <span><?=$p_employer['address']?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">HR Contact No:</label>
                    <span><?=$p_employer['hr_contact_number']?></span>
                </td>
                <td>
                    <label for="">Email Id:</label>
                    <span><?=$p_employer['hr_email']?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
            </tr>


            <tr>
                <td colspan="2">
                    <b>Reference 2</b> (<i>from previous-to-previous organization</i>)
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Name:</label>
                    <span><?=$p_to_p_employer['hr_name']?></span>
                </td>
                <td>
                    <label for="">Designation:</label>
                    <span><?=$p_to_p_employer['hr_designation']?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">Company:</label>
                    <span><?=$p_to_p_employer['company']?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">Company's Address:</label>
                    <span><?=$p_to_p_employer['address']?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">HR Contact No:</label>
                    <span><?=$p_to_p_employer['hr_contact_number']?></span>
                </td>
                <td>
                    <label for="">Email Id:</label>
                    <span><?=$p_to_p_employer['hr_email']?></span>
                </td>
            </tr>

        </tbody>
    </table>
    <!--table:hr references end-->

    <!--table:background information start-->
    <table class="table table-inner table-bordered">
        <colgroup>
            <col style="width: 90%;">
            <col>
        </colgroup>
        <tbody>
            <tr>
                <th colspan="2">
                    <p><b>Background Information</b></p>
                    <p>If you respond ‘yes’ to any of the questions please provide full details on a separate sheet and attach to this application.</p>

                </th>
            </tr>
            <tr>
                <th colspan="2">
                    Criminal and civil record
                </th>
            </tr>
            <tr>
                <td style="width: 90%;">
                    <?= getBackgroundInformationQuestion('C01') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['criminal_and_civil_record']->C01 ? "Yes" : "No" ?>
                </td>
            </tr>

            <tr>
                <td>
                    <?= getBackgroundInformationQuestion('C02') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['criminal_and_civil_record']->C02 ? "Yes" : "No" ?>
                </td>
            </tr>

            <tr>
                <td>
                    <?= getBackgroundInformationQuestion('C03') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['criminal_and_civil_record']->C03 ? "Yes" : "No" ?>
                </td>
            </tr>

            <tr>
                <td>
                    <?= getBackgroundInformationQuestion('C04') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['criminal_and_civil_record']->C04 ? "Yes" : "No" ?>
                </td>
            </tr>

            <tr>
                <td>
                    <?= getBackgroundInformationQuestion('C05') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['criminal_and_civil_record']->C05 ? "Yes" : "No" ?>
                </td>
            </tr>

            <tr>
                <td>
                    <?= getBackgroundInformationQuestion('C06') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['criminal_and_civil_record']->C06 ? "Yes" : "No" ?>
                </td>
            </tr>

            <tr>
                <td>
                    <?= getBackgroundInformationQuestion('C07') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['criminal_and_civil_record']->C07 ? "Yes" : "No" ?>
                </td>
            </tr>

            <tr>
                <td>
                    <?= getBackgroundInformationQuestion('C08') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['criminal_and_civil_record']->C08 ? "Yes" : "No" ?>
                </td>
            </tr>

            <tr>
                <th colspan="2">
                    Business Interests
                </th>
            </tr>
            <tr>
                <td>
                    <?= getBackgroundInformationQuestion('B01') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['business_interest']->B01 ? "Yes" : "No" ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?= getBackgroundInformationQuestion('B02') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['business_interest']->B02 ? "Yes" : "No" ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?= getBackgroundInformationQuestion('B03') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['business_interest']->B03 ? "Yes" : "No" ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?= getBackgroundInformationQuestion('B04') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['business_interest']->B04 ? "Yes" : "No" ?>
                </td>
            </tr>


            <tr>
                <th colspan="2">
                    Other actions and disqualifications
                </th>
            </tr>
            <tr>
                <td>
                    <?= getBackgroundInformationQuestion('O01') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['other_disqualification']->O01 ? "Yes" : "No" ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?= getBackgroundInformationQuestion('O02') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['other_disqualification']->O02 ? "Yes" : "No" ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?= getBackgroundInformationQuestion('O03') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['other_disqualification']->O03 ? "Yes" : "No" ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?= getBackgroundInformationQuestion('O04') ?>
                </td>
                <td>
                    <?= $joiningFormDetails['background_info']['other_disqualification']->O04 ? "Yes" : "No" ?>
                </td>
            </tr>

        </tbody>
    </table>
    <!--table:background information end-->

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
                <?php foreach ($joiningFormDetails['background_info']['previous_address'] as $key=>$address) { ?>
                    <tr>
                       
                        <td><?= $address->address ?></td>
                        <td><?= $address->postcode ?></td>
                        <td><?= $address->dates ?></td>
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
            <?php if (!empty($joiningFormDetails['background_info']['mediclaim'])) { ?>
                <?php foreach ($joiningFormDetails['background_info']['mediclaim'] as $key=>$mediclaim) { ?>
                    <tr>
                        <td><?= $mediclaim->name ?></td>
                        <td><?= $mediclaim->relationship ?></td>
                        <td><?= $mediclaim->dob ?></td>
                        <td><?= $mediclaim->age ?></td>
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
                <th colspan="6">Employees Close Relatives working with BitString, if any</th>
            </tr>

            <tr>
                <td colspan="4">
                    <b>Name </b>
                </td>
                <td>
                    <b>Relationship</b>
                </td>
                <td>
                    <b>Position</b>
                </td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <!--table:declaration start-->
    <table class="table table-inner table-bordered">
        <tbody>
            <tr>
                <th colspan="6">Data Protection</th>
            </tr>
            <tr>
                <td colspan="6">
                    <p>I hereby give my consent to the employer or any agent thereof to process the data supplied in this application form for the purposes of recruitment and selection. I accept that this data may be sent and processed in or outside India.</p>
                    <p>You have the right to apply for a copy of our information and to have any inaccuracies corrected.</p>
                </td>
            </tr>

            <tr>
                <td colspan="6">
                    <b>Applicant’s signature: </b>
                </td>
            </tr>

            <tr>
                <td colspan="5"><label for="">Full Name:</label></td>
                <td><label for="">Date:</label></td>
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
                    <p>I certify that to the best of my knowledge all the information given in this form is true and complete. I understand that any appointment offered will be subject to the information given on this form being correct. I understand that any offer of employment is conditional upon the verification of any or all of the information I have supplied. I understand and accept that the provision of misleading, false or inaccurate information or the omission of a material fact may be legitimate cause for the immediate withdrawal of any offer of employment or, if I am already employed, for disciplinary action up to and including dismissal.</p>
                    <p>I authorize BitString IT Services Pvt Ltdor any agent thereof to verify information presented on this form and to make inquiries of the school, college or university where a qualification was gained as well as approach previous employers and personal references for verification of my employment records. I acknowledge that all referees are disclosing the above information at my express request and that I will make no claim whatsoever against such referee, its agents and/or employees arising out of disclosure of such information. This shall be the case whether the content of any such document obtained is accurate or inaccurate and/or any information is true or untrue.</p>
                </td>
            </tr>

            <tr>
                <td colspan="6">
                    <b>Employee's signature: </b>
                </td>
            </tr>

            <tr>
                <td colspan="5"><label for="">Full Name:</label></td>
                <td><label for="">Date:</label></td>
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
                    <li>Resignation email/letter copy of the last company.</li>
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