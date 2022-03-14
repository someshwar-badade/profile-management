<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="<?= base_url('assets/admin/plugins/fontawesome-free/css/all.min.css') ?>">
    <title>Joining Form</title>
    <?php
    $config['colorPrimary'] = !empty($config['colorPrimary']) ? $config['colorPrimary'] : '#ef8989';
    ?>
    <style>
        /** 
        Set the margins of the page to 0, so the footer and the header
        can be of the full height and width !
     **/
        @page {
            /* margin: 0; */
            margin-left: .75cm;
            margin-right: 0;
            margin-top: .75cm;
            margin-bottom: .75cm;
            /* margin-bottom: 250px; */
            /* page-break-after: always; */
        }



        * {
            border-collapse: collapse;
        }

        .bg-color {
            background-color: <?= $config['colorPrimary'] ?>;
            color: #fff;
        }

        .primary-color {
            color: <?= $config['colorPrimary'] ?>;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            padding: 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .table tr td,
        .table tr th {
            /* padding: 5px 10px; */
            vertical-align: text-top;
        }

        .table-border tr td,
        .table-border tr th {
            border: 1px solid #000;
        }

        div.left {
            width: 20%;
            display: inline-block;
            float: left;
        }

        div.right {
            width: 80%;
            display: inline-block;
            float: right;

        }

        img.user-image {
            width: 150px;
            height: 150px;
            object-fit: contain;
            border-radius: 5px;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
        }



        h2.candidate-name {
            margin-bottom: 5px;
        }

        .heading-1 {
            color: <?= $config['colorPrimary'] ?>;
            border-bottom: 1px solid <?= $config['colorPrimary'] ?>;
            text-transform: uppercase;
            padding-left: 10px;
            margin-bottom: 5px;
        }

        .heading-2 {
            color: <?= $config['colorPrimary'] ?>;
            /* padding-left: 10px; */
        }

        .heading-4 {
            color: grey;
            font-size: 12px;
        }

        .heading-3 {
            font-size: 14px;
        }

        .text-right {
            text-align: right;
        }

        .description {
            font-size: 12px;
        }

        .left .heading-2 {
            padding-left: 0;
            font-size: 14px;
        }

        .container-1 .table {
            margin-left: 10px;
            margin-bottom: 10px;
        }

        .m-0 {
            margin: 0 !important;
        }

        .p-0 {
            padding: 0 !important;
        }

        .pl-0 {
            padding-left: 0 !important;
        }

        .pr-0 {
            padding-right: 0 !important;
        }

        .px-0 {
            padding-right: 0 !important;
            padding-left: 0 !important;
        }

        .py-0 {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }

        .container-1 {
            margin-bottom: 15px;
        }

        .clearfix {
            clear: both;
        }

        .personal-details i {
            color: <?= $config['colorPrimary'] ?>;
            margin-right: 5px;
            font-size: 12px;
        }

        .personal-details label,
        .technical-skills .skill label {
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .technical-skills .skill p {

            border: 1px solid <?= $config['colorPrimary'] ?>;
            margin: 0;
            width: 100%;
        }

        .technical-skills .skill p span {
            height: 10px;
            display: block;
            background-color: <?= $config['colorPrimary'] ?>;
        }

        .technical-skills .skill {
            margin-bottom: 8px;
        }
    </style>
</head>

<body>

    <div>
        <div class="left">
            <center>
                <img class="user-image" src="<?= base_url('/assets/images/somesh.jpeg') ?>">
            </center>
            <div class="personal-details">
                <p><i class="far fa-envelope"></i> <label for=""><?= $joiningFormDetails['email_primary'] ?></label></p>
                <p><i class="fas fa-mobile-alt"></i> <label for=""><?= $joiningFormDetails['mobile_primary'] ?></label></p>
                <p><i class="fas fa-map-marker-alt"></i> <label for=""><?= $joiningFormDetails['present_address'] ?></label></p>
            </div>

            <div class="technical-skills">
                <h3 class="heading-2">Technical Skills</h3>
                <?php foreach ($joiningFormDetails['primary_skills'] as $skill) {
                    $width = ($skill['rating'] / 10) * 100;
                ?>
                    <div class="skill">
                        <label><?= $skill['text'] ?></label>
                        <p>
                            <span style='<?= "width:$width%" ?>'></span>
                        </p>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="right">
            <div style="padding-left: 10px;">
                <div class="bg-color" style="padding: 10px; padding-right:30px; margin-bottom:15px;">
                    <h2 class="candidate-name"><?= ucwords(strtolower($joiningFormDetails['first_name'] . ' ' . $joiningFormDetails['last_name'])) ?></h2>
                    <h4 class="position">Position</h4>
                    <p class="description">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis culpa totam nihil dolorem voluptatem, nesciunt neque sapiente distinctio sequi tempore harum iure? Unde, quod neque. Voluptatibus temporibus inventore odit recusandae?
                    </p>
                </div>
                <div style="padding-right:30px;">
                    <?php $employers =  isset($joiningFormDetails['employment_history']['employers']) ? (array)$joiningFormDetails['employment_history']['employers'] : []; ?>

                    <?php if (!empty($employers)) { ?>
                        <div class="container-1">

                            <h3 class="heading-1">work experience</h3>

                            <?php foreach ($employers as $key => $p_employer) {
                                $p_employer = (array)$p_employer ?>

                                <table class="table work-experience">
                                    <tbody>
                                        <tr>
                                            <td colspan="12">
                                                <h4 class="heading-2"><?= $p_employer['position_held'] ?></h4>
                                                <h4 class="heading-3"><?= $p_employer['company'] ?></h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">
                                                <i class="heading-4"><?= $p_employer['from_date'] . " - " . $p_employer['to_date'] ?></i>
                                            </td>
                                            <td colspan="6" class="text-right">

                                                <i class="heading-4"><?= $p_employer['address'] ?>, <?= $p_employer['city'] ?></i>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" class="description">
                                                <?= $p_employer['job_responsibilities'] ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            <?php } ?>

                            <?php foreach ($employers as $key => $p_employer) {
                                $p_employer = (array)$p_employer ?>

                                <table class="table work-experience">
                                    <tbody>
                                        <tr>
                                            <td colspan="12">
                                                <h4 class="heading-2"><?= $p_employer['position_held'] ?></h4>
                                                <h4 class="heading-3"><?= $p_employer['company'] ?></h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">
                                                <i class="heading-4"><?= $p_employer['from_date'] . " - " . $p_employer['to_date'] ?></i>
                                            </td>
                                            <td colspan="6" class="text-right">

                                                <i class="heading-4"><?= $p_employer['address'] ?>, <?= $p_employer['city'] ?></i>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" class="description">
                                                <?= $p_employer['job_responsibilities'] ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            <?php } ?>

                        </div>
                    <?php } ?>


                    <?php if (!empty($joiningFormDetails['professional_qualification'])) { ?>
                        <div class="container-1">
                            <h3 class="heading-1">Courses and training</h3>
                            <?php foreach ($joiningFormDetails['professional_qualification'] as $p_qualification) { ?>
                                <table class="table courses">
                                    <tbody>
                                        <tr>
                                            <td colspan="12">
                                                <h4 class="heading-3"><?= $p_qualification['qualification'] ?></h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="12">
                                                <h6 class="heading-4"><?= $p_qualification['date'] ?></h6>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>

                            <?php } ?>
                        </div>
                    <?php } ?>
                   
                    <?php if (!empty($joiningFormDetails['education_qualification'])) { ?>
                        <div class="container-1">
                            <h3 class="heading-1">Education</h3>
                            <?php foreach ($joiningFormDetails['education_qualification'] as $e_qualification) { ?>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td colspan="12">
                                                <h4 class="heading-2"><?= $e_qualification['degree'] ?></h4>
                                                <h4 class="heading-3"><?= $e_qualification['university'] ?></h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">
                                                <i class="heading-4"><?= $e_qualification['from_date'] ?> - <?= $e_qualification['to_date'] ?></i>
                                            </td>
                                            <td colspan="6" class="text-right">
                                                <i class="heading-4"><?= $e_qualification['percentage'] ?> %</i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            <?php } ?>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</body>

</html>