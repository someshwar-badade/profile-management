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
            font-weight: bold;
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
    <table class="table table-inner table-bordered">
        <tbody>
            <tr>
                <th colspan="2">Employee Details</th>
            </tr>
            <tr>
                <td colspan="2">
                    <label>First Name:</label>
                    <span><?=$joiningFormDetails['first_name']?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>Last Name:</label>
                    <span><?=$joiningFormDetails['last_name']?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Father’s Name:</label>
                    <span><?=$joiningFormDetails['father_name']?></span>
                </td>
                <td>
                    <label>Mother’s Name:</label>
                    <span><?=$joiningFormDetails['mother_name']?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Marital Status:</label>
                    <span></span>
                </td>
                <td>
                    <label>Spouse’s Name (if applicable):</label>
                    <span><?=$joiningFormDetails['spouse_name']?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>Kid(s) Name (if applicable):</label>
                    <span><?=$joiningFormDetails['kids_name']?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Home Tel. No.:</label>
                    <span></span>
                </td>
                <td>
                    <label>Mobile Tel. No.:</label>
                    <span><?=$joiningFormDetails['mobile_primary']?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Emergency Contact Name:</label>
                    <span></span><br>
                    <label>Relation:</label>
                    <span></span><br>

                </td>
                <td>
                    <label>Emergency Mobile No.:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>PAN No:</label>
                    <span><?=$joiningFormDetails['pan_number']?></span>

                </td>
                <td>
                    <label>Aadhar No.:</label>
                    <span><?=$joiningFormDetails['aadhar_number']?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>UAN No:</label>
                    <span></span>

                </td>
                <td>
                    <label>Bank Name & Branch.:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Bank A/c No:</label>
                    <span></span>

                </td>
                <td>
                    <label>IFS Code:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Total Experience:</label>
                    <span></span>

                </td>
                <td>
                    <label>Blood Group:</label>
                    <span></span><br>
                    <label>Medical conditions, if any:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>Present Address:</label>
                    <span></span>

                </td>
            </tr>
            <tr>
                <td>
                    <label>Postcode:</label>
                    <span></span>

                </td>
                <td>
                    <label>For how long are you residing at this address (Year/Months):</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>Permanent Address:</label>
                    <span></span>

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>Postcode:</label>
                    <span></span>

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>Email Id:</label>
                    <span><?=$joiningFormDetails['email_primary']?></span>

                </td>
            </tr>
            <tr>
                <td>
                    <label>Date of Birth (DD/MM/YY):</label>
                    <span></span>

                </td>
                <td>
                    <label>Place of Birth (Town/Country):</label>
                    <span></span>

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>Nationality (both, if dual national):</label>
                    <span></span>

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>Nature of Job hired for (Permanent/Contractual):</label>
                    <span></span>

                </td>
            </tr>

        </tbody>
    </table>

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
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <table class="table table-inner table-bordered">
        <tbody>
            <tr>
                <th colspan="7">Educational Qualifications</th>
            </tr>
            <tr>
                <td><b>Degree / Course</b></td>
                <td><b>Course Titlealong with Board / University</b></td>
                <td style="width: 25%;"><b>Name and full address of school/Institution </b></td>
                <td><b>From (MM/YYYY)</b></td>
                <td><b>To (MM/YYYY)</b></td>
                <td><b>Full time / Part Time/ off campus / Open Univ.</b></td>
                <td><b>%age/ CGPA</b></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

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
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

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
                    <span></span>
                </td>
                <td>
                    <label for="">Dates (MM/YYYY)</label>
                </td>
                <td>
                    <label for="">From:</label>
                    <span></span>
                </td>
                <td>
                    <label for="">To:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <label for="">Company:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">Department:</label>
                    <span></span>
                </td>
                <td colspan="2">
                    <label for="">Nature of Job:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <label for="">Address:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">City:</label>
                    <span></span>
                </td>
                <td colspan="2">
                    <label for="">Telephone:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <label for="">Main Job Responsibilities:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">Annual CTC(in Lacs):</label>
                    <span></span>
                </td>
                <td colspan="2">
                    <label for="">Name of Reporting Manager:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">Contact No. of Manager:</label>
                    <span></span>
                </td>
                <td colspan="2">
                    <label for="">E-Mail ID of Manager:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <label for="">Reason for leaving:</label>
                    <span></span>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table table-inner table-bordered">
        <tbody>
            <tr>
                <th colspan="4">
                    Previous-to-previous Employer
                </th>
            </tr>
            <tr>
                <td>
                    <label>Position held:</label>
                    <span></span>
                </td>
                <td>
                    <label for="">Dates (MM/YYYY)</label>
                </td>
                <td>
                    <label for="">From:</label>
                    <span></span>
                </td>
                <td>
                    <label for="">To:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <label for="">Company:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">Department:</label>
                    <span></span>
                </td>
                <td colspan="2">
                    <label for="">Nature of Job:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <label for="">Address:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">City:</label>
                    <span></span>
                </td>
                <td colspan="2">
                    <label for="">Telephone:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <label for="">Main Job Responsibilities:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">Annual CTC(in Lacs):</label>
                    <span></span>
                </td>
                <td colspan="2">
                    <label for="">Name of Reporting Manager:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">Contact No. of Manager:</label>
                    <span></span>
                </td>
                <td colspan="2">
                    <label for="">E-Mail ID of Manager:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <label for="">Reason for leaving:</label>
                    <span></span>
                </td>
            </tr>
        </tbody>
    </table>

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
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="4">
                    <p>* GAP Declaration to be filed when there is a time gap between two Employments OR between Education and Employment OR between Education and Education.</p>
                    <p>* Any gap of more than 3 months to be filled in with complete details and supporting documents.</p>
                </td>
            </tr>
        </tbody>
    </table>

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
                    <span></span>
                </td>
                <td>
                    <label for="">Designation:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">Company:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">Company's Address:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">HR Contact No:</label>
                    <span></span>
                </td>
                <td>
                    <label for="">Email Id:</label>
                    <span></span>
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
                    <span></span>
                </td>
                <td>
                    <label for="">Designation:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">Company:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">Company's Address:</label>
                    <span></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">HR Contact No:</label>
                    <span></span>
                </td>
                <td>
                    <label for="">Email Id:</label>
                    <span></span>
                </td>
            </tr>

        </tbody>
    </table>

    <table class="table table-inner table-bordered">
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
                    <p>Have you ever been convicted of a criminal offence?</p>
                </td>
                <td><span></span></td>
            </tr>
            <tr>
                <td style="width: 90%;">
                    <p>Are there any criminal or disciplinary charges pending against you?</p>
                </td>
                <td><span></span></td>
            </tr>
            <tr>
                <td style="width: 90%;">
                    <p>Are you currently engaged in or have you ever been involved in litigation with your current or former employer, which has resulted or may result in action in a court or tribunal or a settlement by negotiation, arbitration, mediation or alternative dispute resolution procedure?</p>
                </td>
                <td><span></span></td>
            </tr>
            <tr>
                <td style="width: 90%;">
                    <p>Have you ever been the subject of a civil action that resulted in a finding e.g. a fine or judgement against you in India or elsewhere?</p>
                </td>
                <td><span></span></td>
            </tr>
            <tr>
                <td style="width: 90%;">
                    <p>Have you ever had a judgement debt (including a county court judgement) made under a court order in India or elsewhere or an individual voluntary arrangement with creditors?</p>
                </td>
                <td><span></span></td>
            </tr>
            <tr>
                <td style="width: 90%;">
                    <p>Have you ever entered into a deed of arrangement with creditors?</p>
                </td>
                <td><span></span></td>
            </tr>
            <tr>
                <td style="width: 90%;">
                    <p>Have you ever failed to satisfy any such judgement debts within one year of the making of the order?</p>
                </td>
                <td><span></span></td>
            </tr>
            <tr>
                <td style="width: 90%;">
                    <p>Have you ever been declared bankrupt or had your estate sequestrated, been the subject of such proceedings, or is any such action pending?</p>
                </td>
                <td><span></span></td>
            </tr>

            <tr>
                <th colspan="2">
                    Business Interests
                </th>
            </tr>
            <tr>
                <td style="width: 90%;">
                    <p>Are you, or have you ever been, an officer (either as director or company secretary) or a partner of any company other than in a capacity specified in the employment history section?</p>
                </td>
                <td><span></span></td>
            </tr>
            <tr>
                <td style="width: 90%;">
                    <p>Do you own more than 15% of any corporate body?</p>
                </td>
                <td><span></span></td>
            </tr>
            <tr>
                <td style="width: 90%;">
                    <p>Are you currently engaged in any other outside business activity or employment not stated elsewhere in this form?</p>
                </td>
                <td><span></span></td>
            </tr>
            <tr>
                <td style="width: 90%;">
                    <p>Do you, or any member of your family, have a business interest, employment obligations or are there any other situations that would conflict, or appear to conflict, with the employment for which you are applying?</p>
                </td>
                <td><span></span></td>
            </tr>


            <tr>
                <th colspan="2">
                    Other actions and disqualifications
                </th>
            </tr>
            <tr>
                <td style="width: 90%;">
                    <p>Have you ever been or are you currently the subject of any investigation or disciplinary procedure in relation to your business or professional activities?</p>
                </td>
                <td><span></span></td>
            </tr>
            <tr>
                <td style="width: 90%;">
                    <p>Have you ever been criticised, censured or disciplined by any organisation or body in relation to your business or professional activities?</p>
                </td>
                <td><span></span></td>
            </tr>
            <tr>
                <td style="width: 90%;">
                    <p>Have you ever been refused or had revoked membership of any professional body or organisation of which you have been, or applied to be, a member?</p>
                </td>
                <td><span></span></td>
            </tr>
            <tr>
                <td style="width: 90%;">
                    <p>Have you ever been disqualified by a court from acting as a director of a company or from being concerned with the management of any company, partnership or unincorporated body?</p>
                </td>
                <td><span></span></td>
            </tr>

        </tbody>
    </table>

    <table class="table table-inner table-bordered">
        <tbody>
            <tr>
                <th colspan="6">Previous Addresses</th>
            </tr>
            <tr>
                <td colspan="6">
                    <p>Please include full personal address history to cover the last 7 years including dates.</p>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <label for="">Address</label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">Postcode:</label>
                    <span></span>
                </td>
                <td colspan="4">
                    <label for="">Dates resident at this address (from and to):</label>
                </td>
            </tr>

            <tr>
                <td colspan="6">
                    <label for="">Address</label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">Postcode:</label>
                    <span></span>
                </td>
                <td colspan="4">
                    <label for="">Dates resident at this address (from and to):</label>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <label for="">Address</label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="">Postcode:</label>
                    <span></span>
                </td>
                <td colspan="4">
                    <label for="">Dates resident at this address (from and to):</label>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table table-inner table-bordered">
        <tbody>
            <tr>
                <th colspan="6">Mediclaim / Medical Insurance</th>
            </tr>

            <tr>
                <td colspan="4">
                    <b>Full Name </b>
                </td>
                <td>
                    <b>Relationship</b>
                </td>
                <td>
                    <b>Age / Date of Birth</b>
                </td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <p>* Please submit passport size photograph of all the members mentioned above.</p>


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
                    <p>I certify that to the best of my knowledge all the information given in this form is true and complete. I understand that any appointment offered will be subject to the information given on this form being correct. I understand that any offer of employment is conditional upon the verification of any or all of the information I have supplied.  I understand and accept that the provision of misleading, false or inaccurate information or the omission of a material fact may be legitimate cause for the immediate withdrawal of any offer of employment or, if I am already employed, for disciplinary action up to and including dismissal.</p>
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


</body>

</html>