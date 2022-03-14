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
            margin: 1cm;
            /* margin-left: .75cm;
            margin-right: 0;
            margin-top: .75cm;
            margin-bottom: .75cm; */
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

        table tr {
            page-break-inside: recto;

        }

        table tr td {
            page-break-inside: recto;
        }

        .table tr td,
        .table tr th {
            padding: 5px 10px;
            vertical-align: text-top;
        }

        .table-border tr td,
        .table-border tr th {
            border: 1px solid #000;
        }

        section.left {
            width: 20%;
            min-width: 20%;
            max-width: 20%;
            display: inline-block;
            float: left;
        }

        section.right {
            width: 80%;
            min-width: 80%;
            max-width: 80%;
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

        h4.position {
            border-bottom: 1px solid white;
            display: inline-block;
            padding-right: 20px;
        }

        p.description {
            text-align: justify;
            font-size: 12px;
            margin-top: 5px;
        }

        p.work-description {
            text-align: justify;
            font-size: 12px;
            margin-top: 5px;
        }

        h2.candidate-name {
            margin-bottom: 5px;
        }

        .heading-2 {
            color: <?= $config['colorPrimary'] ?>;
            border-bottom: 1px solid <?= $config['colorPrimary'] ?>;
            text-transform: uppercase;
            padding-left: 10px;
            margin-bottom: 5px;
        }

        .left .heading-2 {
            padding-left: 0;
            font-size: 14px;
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

        h4.role,
        .duration,
        .company-address {
            color: <?= $config['colorPrimary'] ?>;
            padding-left: 10px;
        }

        .company-name,
        .work-description,
        .courses {
            padding-left: 10px;
        }

        .company-address {
            float: right;
        }

        .courses,
        .education {
            margin-bottom: 10px;
        }

        .courses h4 {
            text-transform: capitalize;
            font-size: 14px;
        }

        .courses h6 {
            color: grey
        }

        .work-experience,
        .courses-and-traning,
        .education-container,
        .personal-details,
        .technical-skills {
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
        <div style="width: 25%;display:inline-block;float:left;">
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
        <div style="width: 75%;display:inline-block;float:right">
            <div class="bg-color" style="padding: 10px; padding-right:30px; margin-bottom:15px;">
                <h2 class="candidate-name"><?= ucwords(strtolower($joiningFormDetails['first_name'] . ' ' . $joiningFormDetails['last_name'])) ?></h2>
                <h4 class="position">Position</h4>
                <p class="description">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis culpa totam nihil dolorem voluptatem, nesciunt neque sapiente distinctio sequi tempore harum iure? Unde, quod neque. Voluptatibus temporibus inventore odit recusandae?
                </p>
            </div>
            <div style="padding-right:30px;">

                &nbsp;
                <h3 class="heading-2">work experience</h3>



            </div>
        </div>
    </div>

</body>

</html>