<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="<?= base_url('assets/admin/plugins/fontawesome-free/css/all.min.css') ?>">


    <link rel="stylesheet" href="<?= $config['fontFamilyUrl'] ?>">


    <title>Joining Form</title>
    <?php
    $config['colorPrimary'] = !empty($config['colorPrimary']) ? $config['colorPrimary'] : '#ef8989';
    $config['colorSecondary'] = !empty($config['colorSecondary']) ? $config['colorSecondary'] : '#000000';
    $config['ts1'] = !empty($config['ts1']) ? $config['ts1'] : '24px';
    $config['ts2'] = !empty($config['ts2']) ? $config['ts2'] : '18px';
    $config['ts3'] = !empty($config['ts3']) ? $config['ts3'] : '14px';
    $config['skillsStyle'] = !empty($config['skillsStyle']) ? $config['skillsStyle'] : 'bar';
    $config['font'] = !empty($config['font']) ? $config['font'] : 'Roboto-Regular.ttf';
    $fontFamily = str_replace('+', ' ', $config['fontFamily']);
    $fontFamily = explode(":", $fontFamily)[0];
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





        body,
        div,
        p,
        span,
        td,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: <?= $fontFamily ?> !important;
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
            color: <?= $config['colorSecondary'] ?>;
            font-size: <?= $config['ts3'] ?>;
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

        .h1 {
            font-size: <?= $config['ts1'] ?>;
            display: block;
            margin: 0;
            line-height: <?= $config['ts1'] ?>;
        }

        .h2 {
            font-size: <?= $config['ts2'] ?>;
            display: block;
            margin: 0;
            line-height: <?= $config['ts2'] ?>;
        }

        .h3 {
            font-size: <?= $config['ts3'] ?>;
            display: block;
            padding: 0;
            line-height: <?= $config['ts3'] ?>;
        }

        .h4 {
            font-size: <?= $config['ts4'] ?>;
            display: block;
            padding: 0;
            line-height: <?= $config['ts4'] ?>;
        }

        .h5 {
            font-size: <?= $config['ts5'] ?>;
            display: block;
            padding: 0;
            line-height: <?= $config['ts5'] ?>;
        }

        .h6 {
            font-size: <?= $config['ts6'] ?>;
            display: block;
            padding: 0;
            line-height: <?= $config['ts6'] ?>;
        }


        




        .candidate-name {
            margin-bottom: 5px;
            font-family: <?= $fontFamily ?>,
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


        .heading-6 {
            color: grey;
        }

        .text-right {
            text-align: right;
        }


        .left .heading-4 {
            padding-left: 0;
            font-size: <?= $config['ts4'] ?>;
            font-weight: bold;
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

        }

        .personal-details label,
        .technical-skills .skill label {

            margin: 0;
            padding: 0;
        }

        .technical-skills .skill p {
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .technical-skills .skill.bar p {

            border: 1px solid <?= $config['colorPrimary'] ?>;

        }

        .technical-skills .skill.star i {
            color: <?= $config['colorPrimary'] ?>;
        }


        .technical-skills .skill p span {
            height: 10px;
            display: block;
            background-color: <?= $config['colorPrimary'] ?>;
        }

        .technical-skills .skill {
            margin-bottom: 8px;
        }

        .heading {
            font-size: <?= $config['ts1'] ?>;
        }
        .sub-heading {
            font-size: <?= $config['ts2'] ?>;
        }
        .text {
            font-size: <?= $config['ts3'] ?>;
        }
    </style>
</head>

<body>

    <div>
        <div class="left">
            <center>
                <img class="user-image" src="<?= base_url($joiningFormDetails['photo']?$joiningFormDetails['photo']:'/assets/images/placeholder-employee.jpg') ?>">
            </center>
            <div class="personal-details">
                <p><i class="far fa-envelope"></i> <label for=""><?= $joiningFormDetails['email_primary'] ?></label></p>
                <p><i class="fas fa-mobile-alt"></i> <label for=""><?= $joiningFormDetails['mobile_primary'] ?></label></p>
                <p><i class="fas fa-map-marker-alt"></i> <label for=""><?= $joiningFormDetails['present_address'] ?></label></p>
            </div>

            <div class="technical-skills">
                <label class="sub-heading h4">Technical Skills</label>

                <?php if ($config['skillsStyle'] == 'bar') { ?>
                    <?php foreach ($joiningFormDetails['primary_skills'] as $skill) {
                        $width = ($skill['rating'] / 10) * 100;
                    ?>
                        <div class="skill bar">
                            <label><?= $skill['text'] ?> [<?= $skill['rating'] . "/10" ?>]</label>
                            <p>
                                <span style='<?= "width:$width%" ?>'></span>
                            </p>
                        </div>
                    <?php } ?>
                <?php } ?>
                <?php if ($config['skillsStyle'] == 'star') { ?>
                    <?php foreach ($joiningFormDetails['primary_skills'] as $skill) {
                        $rating = $skill['rating'] / 2;

                    ?>
                        <div class="skill star">
                            <label><?= $skill['text'] ?> [<?= $skill['rating'] . "/10" ?>]</label>
                            <p>
                                <?php for ($i = 1; $i <= 5; $i++) { ?>
                                    <?php if ($rating >= 1) { ?>
                                        <i class="fa fa-star"></i>
                                    <?php } else if ($rating > 0) { ?>
                                        <i class="fas fa-star-half-alt"></i>
                                    <?php } else { ?>
                                        <i class="far fa-star"></i>
                                <?php }
                                    $rating--;
                                } ?>

                            </p>
                        </div>


                    <?php } ?>
                <?php } ?>



            </div>
        </div>
        <div class="right">
            <div style="padding-left: 10px;">
                <div class="bg-color" style="padding: 10px; padding-right:30px; margin-bottom:15px;">
                    <label class="candidate-name heading"><?= ucwords(strtolower($joiningFormDetails['first_name'] . ' ' . $joiningFormDetails['last_name'])) ?></label>
                    <!-- <label class="position h4">Position</label> -->
                    <p class="description text">
                        <?= $joiningFormDetails['about_me'] ?>
                    </p>
                </div>

                <div style="padding-right:30px;">
                    <?php $employers =  isset($joiningFormDetails['employment_history']['employers']) ? (array)$joiningFormDetails['employment_history']['employers'] : []; ?>


                    <?php foreach ($config['sections'] as $section) { //section forloop start
                    ?>


                        <?php if (!empty($employers) && $section == 'WE') { ?>
                            <div class="container-1">

                                <label class="heading heading-1 h3">work experience</label>

                                <?php foreach ($employers as $key => $p_employer) {
                                    $p_employer = (array)$p_employer ?>

                                    <table class="table work-experience">
                                        <tbody>
                                            <tr>
                                                <td colspan="12">
                                                    <label class="sub-heading heading-2 h4"><?= $p_employer['position_held'] ?></label>
                                                    <label class="sub-heading heading-2 h4"><?= $p_employer['company'] ?></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <label class="text heading-6"><?= $p_employer['from_date'] . " - " . $p_employer['to_date'] ?></label>
                                                </td>
                                                <td colspan="6" class="text-right">

                                                    <label class="text heading-6"><?= $p_employer['address'] ?>, <?= $p_employer['city'] ?></label>
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


                        <?php if (!empty($joiningFormDetails['professional_qualification']) && $section == 'CC') { ?>
                            <div class="container-1">
                                <label class="heading h3 heading-1">Courses and training</label>
                                <?php foreach ($joiningFormDetails['professional_qualification'] as $p_qualification) { ?>
                                    <table class="table courses">
                                        <tbody>
                                            <tr>
                                                <td colspan="12">
                                                    <label class="sub-heading heading-2 h4"><?= $p_qualification['qualification'] ?></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="12">
                                                    <label class="text h6 heading-6"><?= $p_qualification['date'] ?></label>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>

                                <?php } ?>
                            </div>
                        <?php } ?>

                        <?php if (!empty($joiningFormDetails['education_qualification']) && $section == 'ED') { ?>
                            <div class="container-1">
                                <label class="heading h3 heading-1">Education</label>
                                <?php foreach ($joiningFormDetails['education_qualification'] as $e_qualification) { ?>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td colspan="12">
                                                    <label class="sub-heading h5 heading-2"><?= $e_qualification['degree'] ?></label>
                                                    <label class="sub-heading h5 heading-2"><?= $e_qualification['university'] ?></label>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <label class="text heading-6"><?= $e_qualification['from_date'] ?> - <?= $e_qualification['to_date'] ?></label>
                                                </td>
                                                <td colspan="6" class="text-right">
                                                    <label class="text heading-6"><?= $e_qualification['percentage'] ?> %</label>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                <?php } ?>
                            </div>
                        <?php } ?>


                        <?php if (!empty($joiningFormDetails['projects']) && $section == 'PRJ') { ?>
                            <div class="container-1">
                                <label class="heading h3 heading-1">Projects</label>
                                <?php foreach ($joiningFormDetails['projects'] as $e_qualification) { ?>
                                    <div style="margin-bottom:15px;padding-left:10px;">
                                        <label class="sub-heading h5 heading-2"><?= $e_qualification['title'] ?></label>
                                        <div>
                                            <?= $e_qualification['description'] ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>


                    <?php } //section forloop end
                    ?>
                </div>


            </div>
        </div>
    </div>
</body>

</html>