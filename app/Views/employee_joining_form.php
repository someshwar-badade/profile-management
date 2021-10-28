<style>
    table tr td.sr-no::before {
        counter-increment: srno;
        content: counter(srno);


    }

    .fix-width-60 {
        width: 60px;
        min-width: 60px;
        max-width: 60px;
    }
</style>
<?= $this->extend('layouts/main') ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">


<?= $this->section('content') ?>
<section class="abutsSection clearfix">
    <div class="container mt-5" style="margin: auto; ">
        <div class="row justify-content-center">

            <div class="col-md-6 p-0">
                <div class="RegitserForm justify-content-center">
                    <h2>Employee Joining Form</h2>
                </div>

            </div>
        </div>
        <div class="container mt-2" style="margin: auto; ">
            <ul class="nav nav-tabs">
                <li><a class="nav-link active" data-bs-toggle="tab" href="#details">Employee Details</a></li>

                <li><a class="nav-link" data-bs-toggle="tab" href="#education">Educational Qualifications</a></li>

                <li><a class="nav-link" data-bs-toggle="tab" href="#qualification">Professional Qualifications</a></li>

                <li><a class="nav-link" data-bs-toggle="tab" href="#emphistory">Employment History</a></li>

                <li><a class="nav-link" data-bs-toggle="tab" href="#hrreference">HR Reference</a></li>

                <li><a class="nav-link" data-bs-toggle="tab" href="#backinfo">Background Information</a></li>
            </ul>
            <div class="tab-content" style="margin: auto; ">

                <div class="tab-pane active" id="details">
                    <form class="row g-3" action="">
                        <div class="row border g-0 rounded shadow-sm" style="background: white; margin-top:20px">

                            <div class="col-md-6">
                                <label for="" class="form-label">First Name</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>Father's Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>Mother's Name</label>
                                <!-- <div class="editable"> -->
                                <input type="text" class="form-control">
                            </div>
                            <!-- <legend class="col-form-label col-sm-2 pt-0">Marital Status</legend> -->
                            <div class="col-md-6">
                                <label for="">Marital Status</label>
                                <div class="form-check" class="align-items-end">
                                    <input class="form-check-input" type="radio" name="status" id="yes" value="" checked>
                                    <label class="form-check-label" for="yes">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="no" value="">
                                    <label class="form-check-label" for="no">
                                        No
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label>Spouse’s Name (if applicable)</label>
                                <!-- <div class="editable"> -->
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="">Kids Name (if applicable)</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="">Home Tel No.</label>
                                <input type="text" class="form-control">
                            </div>


                            <div class="col-md-6">
                                <label for="">Mobile Tel.No</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="">Emergency Contact Name</label>
                                <input type="text" class="form-control">
                                <label for="">Relation</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="">Emergency Mobile No</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="">PAN No</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="">Adhar No</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="">UAN No</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="">Bank Name & Branch</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="">Bank A/c No</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="">IFSC Code</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="">Total Experience</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Permanent Address</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="">Present Address</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Blood Group</label>
                                <input type="text" class="form-control">
                                <label for="">Medical conditions, if any</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="">Postal Code</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="">For how long are you residing at this address (Years)</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="">Email</label>
                                <input type="email" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="">Date of Birth</label>
                                <input type="date" class="date-picker form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="">Place of Birth (Town/Country)</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="">Nationality (both, if dual national)</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="">Nature of Job hired for (Permanent/Contractual)</label>
                                <input type="text" class="form-control">
                            </div>

                        </div>
                    </form>
                </div>

                <div class="tab-pane " id="education">

                    <div class="container" id="{container_uid}">
                        <form class="row g-3" action="">

                            <div class="row border g-3 rounded shadow-sm education-list " style="background: white; text-align: center; margin-top: 20px;">

                                <table class="table table-bordered education-table">
                                    <!-- <div style="text-align: center;"> -->
                                    <thead>
                                        <th class="fix-width-60"> Sr.No.</th>
                                        <th class="fix-width-60">Degree/Course</th>
                                        <th class="fix-width-60">Course Title with University</th>
                                        <th class="fix-width-60">Name of Institute</th>
                                        <th class="fix-width-60">Duration</th>
                                        <!-- <th class="fix-width-60">To</th> -->
                                        <th class="fix-width-60">Course Type</th>
                                        <th class="fix-width-60">Percentage/ Grades</th>
                                        <th class="fix-width-60"></th>
                                    </thead>
                                    <!-- </div> -->
                                    <tbody>

                                        <tr id="{education_id}">
                                            <td class=" sr-no"></td>
                                            <td class=""><select name="" id="" class="form-control">
                                                    <option value="selected">SSC/High School</option>
                                                    <option value="">12th/ Equivalent</option>
                                                    <option value="">Graduation</option>
                                                    <option value="">Post-Graduation</option>
                                                    <option value="">Certification</option>
                                                    <option value="">Others(any)</option>
                                                </select>
                                            </td>

                                            <td class=""><textarea name="" id="" cols="30" rows="" class="form-control"></textarea></td>
                                            <td class=""><input type="text" name="" id="" class="form-control">
                                            </td>
                                            <td class="fix-width-60">From: <input type="date" class="date-picker form-control" name="" id="">
                                                To: <input type="date" class="date-picker form-control" name="" id="">
                                                <!-- <input type="text" class="date-picker form-control"> -->
                                            </td>
                                            <td class=""><select name="" id="" class="form-control">
                                                    <option value="selected">Full Time</option>
                                                    <option value="">Open University</option>
                                                </select></td>
                                            <td class=""><input type="text" name="" id="" class="form-control"></td>

                                            <td><a class="text-secondary delete-education-row-btn" href="javascript:void(0);" title="Remove Line"><i class="fa fa-trash fa-lg"></i></a>
                                            </td>
                                        </tr>

                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="text-left">
                                                <a class="btn btn-sm text-primary add-new-education"><i class="fa fa-plus"></i> Add new line</a>

                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="tab-pane " id="qualification">
                    <div class="container" id="{container_uid}">
                        <form class="row g-3" action="">
                            <div style="text-align: left; margin-top: 20px;">
                                <ul>
                                    <h5> Professional qualifications, memberships &licences</h5>
                                    <li>Professional qualifications obtained or being studied for</li>
                                    <li>Memberships of professional bodies</li>
                                    <li>Professional licenses, certificates or registrations, including registrations with a regulatory body (e.g. ICAI) and whether you are in an approved regulatory role</li>
                                </ul>
                            </div>
                            <div class="row border g-3 rounded shadow-sm " style="background: white; text-align: center; margin: auto;">

                                <table class="table table-bordered education-table">
                                    <div style="text-align: center;">
                                        <thead>
                                            <th class="fix-width-120"> Sr.No.</th>
                                            <th class="fix-width-120">Qualification/Body/Institute/Licence</th>
                                            <th class="fix-width-120">Category/Membership level</th>
                                            <th class="fix-width-120">Dates</th>
                                            <!-- <th class="fix-width-60" >From</th> -->
                                            <!-- <th class="fix-width-60">To</th> -->
                                            <th class="fix-width-60"></th>
                                        </thead>
                                    </div>
                                    <tbody>

                                        <tr id="{education_id}">
                                            <td class=" sr-no"></td>
                                            <td class=""><input type="text" name="" id="" class="form-control"></td>
                                            <td class=""><input type="text" name="" id="" class="form-control"></td>
                                            <td class="fix-width-60">From: <input type="date" class="date-picker form-control" name="" id=""> To: <input type="date" class="date-picker form-control" name="" id=""></td>

                                            <td><a class="text-secondary delete-education-row-btn" href="javascript:void(0);" title="Remove Line"><i class="fa fa-trash fa-lg"></i></a></td>
                                        </tr>

                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="text-left">
                                                <a class="btn btn-sm text-primary add-new-education"><i class="fa fa-plus"></i> Add new line</a>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="tab-pane " id="emphistory">
                    <div class="container" id="{container_uid}">
                        <form class="row g-3" action="">
                            <p style="margin-top: 20px;"> Starting with your most recent employer please give details of your complete employment history since you
                                left full time education. Include any periods of self-employment, unemployment, maternity leave or military service.
                                Include all part time and temporary employment and provide details of both the agencies and placements. Under ‘position held’
                                state clearly if you were a partner or had an ownership interest in any of the employing companies, or if the position was
                                part time. If you are aware that one of your employers has changed its trading name, please provide the former name first,
                                followed by the new name.</p>
                            <div class="row border g-3 rounded shadow-sm " style="background: white; margin: auto;">
                                <form class="row g-3" id="" action="" method="POST" style="margin-top: 20px;">

                                    <table class="table ">
                                        <colgroup>
                                            <col width="25%">
                                            <col width="25%">
                                            <col width="25%">
                                            <col width="25%">
                                        </colgroup>
                                        <tbody>
                                            <th colspan="4">
                                                <h4>Previous Employee</h4>
                                            </th>
                                            <tr>
                                                <td colspan="2">
                                                    <label for="">Position Held</label>
                                                    <input type="text" class="form-control">
                                                </td>
                                                <td>
                                                    <label for="">From:</label>
                                                    <input type="date" class="form-control date-picker">
                                                </td>
                                                <td>
                                                    <label for="">To:</label>
                                                    <input type="date" class="form-control date-picker">
                                                </td>
                                                <!-- <td colspan="2"><label for="">Dates</label></td> -->
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <label for="">Company</label>
                                                    <input type="text" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <label for="">Department</label>
                                                    <input type="text" class="form-control">
                                                </td>
                                                <td colspan="2">
                                                    <label for="">Nature Of Job</label>
                                                    <input type="text" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"> <label for="">Address</label>
                                                    <textarea name="" id="" cols="10" rows="3" class="form-control"></textarea>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan="2">
                                                    <label for="">City</label>
                                                    <input type="text" class="form-control">
                                                </td>
                                                <td colspan="2">
                                                    <label for="">Phone</label>
                                                    <input type="text" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                            <tr>
                                                <td colspan="4"> <label for="">Main Job Responsibilities</label>
                                                    <textarea name="" id="" cols="10" rows="3" class="form-control"></textarea>
                                                </td>
                                            </tr>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <label for="">Annual CTC(in Lacs)</label>
                                                    <input type="text" class="form-control">
                                                </td>
                                                <td colspan="2">
                                                    <label for="">Name of Reporting Manager</label>
                                                    <input type="text" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <label for="">Contact number of Manager</label>
                                                    <input type="text" class="form-control">
                                                </td>
                                                <td colspan="2">
                                                    <label for="">Email ID of Manager</label>
                                                    <input type="email" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                            <tr>
                                                <td colspan="4">
                                                    <label for="">Reason of Leaving</label>
                                                    <input type="text" class="form-control">
                                                </td>
                                            </tr>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <div style="text-align: right;"> <a class="text-secondary delete-education-row-btn" href="javascript:void(0);" title="Delete"><i class="fa fa-trash fa-lg"> Delete</i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5" class="text-left">
                                                    <a class="btn btn-sm text-primary add-new-employer"><i class="fa fa-plus"></i> Add New</a>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>

                                   
                                    <center>
                                        <input type="submit" value="Save" name="submitBtn" class="btn btn-success">
                                        <input type="submit" value="Cancel" name="submitBtn" class="btn btn-secondary">
                                    </center>

                                </form>
                            </div>


                        </form>
                    </div>
                </div>

                <div class="tab-pane " id="hrreference">
                    <div class="row border g-0 rounded shadow-sm">
                        <div class="col">
                            <h3>Reference</h3>
                            <p>HI there</p>
                        </div>
                    </div>
                </div>

                <div class="tab-pane " id="backinfo">
                    <div class="row border g-0 rounded shadow-sm">
                        <div class="col">
                            <h3>Background</h3>
                            <p>HI there</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<?= $this->endSection() ?>


<?= $this->section('javascript') ?>

<?= $this->endSection() ?>
<script>
    $(document).ready(function() {

        $(document).on('click', 'a.add-new-education', function() {
            // console.log("working")
            var tableId = '#' + $(this).closest('table').attr('id');

            let container_uid = $(this).closest('div.container').attr('id');
            let package_uid = $(this).closest('li.package').attr('id');
            let education_id = uid();
            let educationRow = $('#containerTemplate .package-list .education-list table tbody').html().replace(/{education_id}/g, education_id)
            educationRow = educationRow.replace(/{container_uid}/g, container_uid)
            educationRow = educationRow.replace(/{package_uid}/g, package_uid)

            $(tableId + ' > tbody').append(educationRow);
            init_wysihtml5('#description_' + education_id);
            console.log('container_uid:' + container_uid + ' package_uid:' + package_uid + ' education_id:' + education_id);
        });
    });

    $(document).on('click', 'table.education-table a.delete-education-row-btn', function() {

        if (confirm("Are you sure you want to delete?")) {
            var tableId = '#itemstable'; //'#' + $(this).closest('table').attr('id');
            $(this).closest('tr').remove();


        }
    });
</script>