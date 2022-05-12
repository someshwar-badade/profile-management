<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="<?= base_url('assets/admin/plugins/fontawesome-free/css/all.min.css') ?>">
    <title>Joining Form</title>
    <?php
     $config['colorPrimary'] = !empty($config['colorPrimary']) ? $config['colorPrimary'] : '#ef8989';
     $config['colorSecondary'] = !empty($config['colorSecondary']) ? $config['colorSecondary'] : '#fff';
     $config['ts1'] = !empty($config['ts1']) ? $config['ts1'] : '20px';
     $config['ts2'] = !empty($config['ts2']) ? $config['ts2'] : '18px';
     $config['ts3'] = !empty($config['ts3']) ? $config['ts3'] : '26px';
     $config['ts4'] = !empty($config['ts4']) ? $config['ts4'] : '14px';
     $config['ts5'] = !empty($config['ts5']) ? $config['ts5'] : '12px';
     $config['ts6'] = !empty($config['ts6']) ? $config['ts6'] : '10px';
     $config['skillsStyle'] = !empty($config['skillsStyle']) ? $config['skillsStyle'] : 'bar';
     $config['font'] = !empty($config['font']) ? $config['font'] : 'Roboto-Regular.ttf';
     $fontFamily = str_replace('+',' ',$config['fontFamily']);
     $fontFamily = explode(":",$fontFamily)[0];
    ?>
    <style>
        /** 
        Set the margins of the page to 0, so the footer and the header
        can be of the full height and width !
     **/




        /* * {
            padding: 0;
            margin: 0;
        } */

        
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
            font-family: <?=$fontFamily?> !important;
        }

        @page {
            margin: 0;
        }

        table.heading {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            background-color: <?= $config['colorPrimary'] ?>;
            margin-bottom: 30px;
        }

        table.heading tr td.image {
            width: 25%;
        }

        table.heading tr td {
            padding: 25px;
        }


        /* section.heading {
            background-color: <?= $config['colorPrimary'] ?>;
            padding: 25px
        }*/

        section.left {
            width: 25%;
            min-width: 25%;
            max-width: 25%;
            display: inline-block;
            float: left;


        }

        section.right {
            width: 75%;
            min-width: 75%;
            max-width: 75%;
            display: inline-block;
            border-left: dashed;
            float: right;

        }

        table.heading h1 span {
            /* font-size: 28px; */
            border-bottom: 2px solid #000;
            /* width: fit-content; */
            /* padding: 15px 10%; */
            /* display: inline-block; */
            /* text-align: center; */
        }

        section.heading h3 {
            /* font-size: 18px; */
            /* padding: 10px 10%; */
            /* display: inline-block; */
        }



        img.user-image {
            width: 100px;
            height: 100px;
            object-fit: contain;
            border-bottom-left-radius: 25px;
            border-top-right-radius: 25px;
        }

        .personal-details,
        .technical-skills,
        .work-experience-container {
            padding-left: 25px;
        }

        .professional-profile,
        .container {
            padding-right: 25px;
            padding-left: 10px;
        }

        .title-1 {
            text-transform: uppercase;
            text-align: center;
            font-size: 22px;
            margin-bottom: 5px;
        }

  


        .personal-details p,
        .professional-profile div {
            font-size: 12px;
        }

        .personal-details i {
            /* color: <?= $config['colorPrimary'] ?>; */
            margin-right: 5px;
            margin-bottom: 5px;
            font-size: 12px;

        }

        .professional-profile div p {
            text-align: justify;
            margin-bottom: 15px;
        }

        .container table,
        .work-experience-container table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
        }

        .container table tr td.icon,
        .work-experience-container table tr td.icon {
            width: 8%;
        }

        .container table tr td p,
        .work-experience-container table tr td p {
            text-align: justify;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .container table tr td h3,
        .work-experience-container table tr td h3 {
            font-weight: normal;
        }

        .container table tr td.icon i,
        .work-experience-container table tr td.icon {
            background-color: white;
            color: <?= $config['colorPrimary'] ?>;
            padding: 5px;
            border-radius: 50%;
        }

        .container table {
            margin-bottom: 10px;
        }

        .personal-details,
        .technical-skills {
            margin-bottom: 15px;
        }

        .personal-details label,
        .technical-skills .skill label {
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .technical-skills .skill p {

            border: none;
            background-color: lightgray;
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
            padding-right: 10px;
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
            line-height:  <?= $config['ts6'] ?>;
        }


        .profile-name {
            color: <?= $config['colorSecondary'] ?>;
            font-size: 22px;
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
    <?php
    $languages = [
        ['text' => "English", "rating" => "8"],
        ['text' => "Hindi", "rating" => "10"],
        ['text' => "Marathi", "rating" => "10"],
    ];
    ?>

    <table class="heading">
        <tbody>
            <tr>
                <td class="image">
                <img class="user-image" src="<?= base_url($joiningFormDetails['photo']?$joiningFormDetails['photo']:'/assets/images/placeholder-employee.jpg') ?>">
                </td>
                <td class="profile-name">
                    <center>
                        <label class="h1"><span><?= ucwords(strtolower($joiningFormDetails['first_name'] . ' ' . $joiningFormDetails['last_name'])) ?></span></label>
                        <!-- <label>Profession</label> -->
                    </center>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- <div> -->
    <section class="left">
        <div class="personal-details">
            <label class="title-1 heading">Contacts</label>
            <p><i class="far fa-envelope"></i> <label for=""><?= $joiningFormDetails['email_primary'] ?></label></p>
            <p><i class="fas fa-mobile-alt"></i> <label for=""><?= $joiningFormDetails['mobile_primary'] ?></label></p>
            <p><i class="fas fa-map-marker-alt"></i> <label for=""><?= $joiningFormDetails['present_address'] ?></label></p>
        </div>

        <div class="technical-skills">
            <label class="title-1 heading">Skills</label>
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

    </section>
    <section class="right">
        <div class="professional-profile">

            <label class="title-1 heading">Professional profile</label>
            <div>
                <p><?= $joiningFormDetails['about_me'] ?></p>
            </div>
        </div>

        <?php $employers =  isset($joiningFormDetails['employment_history']['employers']) ? (array)$joiningFormDetails['employment_history']['employers'] : []; ?>


        <?php foreach($config['sections'] as $section){//section forloop start?>

        <?php if (!empty($joiningFormDetails['education_qualification']) && $section=='ED') { ?>
            <div class="container">
                <label class="title-1 heading">education</label>
                <?php foreach ($joiningFormDetails['education_qualification'] as $e_qualification) { ?>
                    <table>
                        <tbody>
                            <tr>
                                <td class="icon sub-heading">
                                    <i class="fas fa-graduation-cap"></i>
                                </td>
                                <td>
                                    <label class="title-2 sub-heading"><?= $e_qualification['from_date'] ?> - <?= $e_qualification['to_date'] ?> <?= $e_qualification['degree'] ?></label>
                                    <label class="title-3 sub-heading"><?= $e_qualification['university'] ?></label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <p><?= $e_qualification['institution'] ?></p>
                                    <p>Percentage / CGPA: <?= $e_qualification['percentage'] ?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php } ?>

            </div>
        <?php } ?>
        

        <?php if (!empty($employers) && $section=='WE') { ?>
            <div class="container">
                <label class="title-1">Work Experience</label>
                <?php foreach ($employers as $key => $p_employer) {
                    $p_employer = (array)$p_employer ?>
                    <table>
                        <tbody>
                            <tr>
                                <td class="icon sub-heading">
                                    <i class="fa fa fa-briefcase"></i>
                                </td>
                                <td>
                                    <label class="title-2 sub-heading"><?= $p_employer['from_date'] . " - " . $p_employer['to_date'] ?> <?= $p_employer['company'] ?></label>
                                    <label class="title-3 sub-heading"><?= $p_employer['position_held'] ?></label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <?= $p_employer['job_responsibilities'] ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                <?php } ?>
            </div>
        <?php } ?>


        <?php if (!empty($joiningFormDetails['projects']) && $section == 'PRJ') { ?>
            <div class="container">
                <label class="title-1 heading">Projects</label>
                <?php foreach ($joiningFormDetails['projects'] as $e_qualification) { ?>
                    <div style="margin-bottom:15px;">
                        <label class="title-2 sub-heading"><?= $e_qualification['title'] ?></label>
                        <div>
                            <?= $e_qualification['description'] ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>


        <?php if (!empty($joiningFormDetails['professional_qualification']) && $section == 'CC') { ?>
            <div class="container">
                <label class="title-1 heading">Achievements</label>
                <?php foreach ($joiningFormDetails['professional_qualification'] as $p_qualification) { ?>
                    <table>
                        <tbody>
                            <tr>
                                <td class="icon sub-heading">
                                    <i class="fa fa-award"></i>
                                </td>
                                <td>
                                    <label class="title-2 sub-heading"><?= $p_qualification['qualification'] ?></label>
                                    <!-- <label>university/school name</label> -->
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <p><?= $p_qualification['date'] ?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                <?php } ?>
            </div>
        <?php } ?>
 <?php }//section forloop end?>

    </section>
    <!-- </div> -->


</body>

</html>