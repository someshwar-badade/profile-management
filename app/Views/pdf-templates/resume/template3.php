<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="<?= base_url('assets/admin/plugins/fontawesome-free/css/all.min.css') ?>">
    <title>Joining Form</title>
    <?php 
    $config['colorPrimary'] = !empty($config['colorPrimary'])?$config['colorPrimary']:'#ffd7dd';
    ?>
    <style>
        /** 
        Set the margins of the page to 0, so the footer and the header
        can be of the full height and width !
     **/
        @page {
            margin: 0;
        }

        * {
            padding: 0;
            margin: 0;
        }

        table.heading {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            background-color: <?=$config['colorPrimary']?>;
            margin-bottom: 30px;
        }

        table.heading tr td.image {
            width: 25%;
        }

        table.heading tr td {
            padding: 25px;
        }


        /* section.heading {
            background-color: <?=$config['colorPrimary']?>;
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
        .education-container {
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
            /* color: <?=$config['colorPrimary']?>; */
            margin-right: 5px;
            margin-bottom: 5px;
            font-size: 12px;

        }

        .professional-profile div p {
            text-align: justify;
            margin-bottom: 15px;
        }

        .education-container table,.work-experience-container table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
        }

        .education-container table tr td.icon,.work-experience-container table tr td.icon{
            width: 8%;
        }

        .education-container table tr td p,.work-experience-container table tr td p{
            text-align: justify;
            font-size: 12px;
            margin-bottom: 15px;
        }

        .education-container table tr td h3,.work-experience-container table tr td h3{
            font-weight: normal;
        }

        .education-container table tr td.icon i,.work-experience-container table tr td.icon {
            background-color: <?=$config['colorPrimary']?>;
            padding: 5px;
            border-radius: 50%;
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
            background-color: <?=$config['colorPrimary']?>;
        }

        .technical-skills .skill {
            margin-bottom: 8px;
            padding-right: 10px;
        }
    </style>
</head>

<body>
    <?php

    $skills = [
        ['text' => "PHP", "rating" => "8"],
        ['text' => "Javascript", "rating" => "7"],
        ['text' => "JAVA", "rating" => "6"],
        ['text' => "CSS", "rating" => "9"],
        ['text' => "HTML", "rating" => "10"],
        ['text' => "MySql", "rating" => "6"],
        ['text' => "Angular", "rating" => "3"],
        ['text' => "Python", "rating" => "2"],
    ];
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
                    <img class="user-image" src="<?= base_url('/assets/images/somesh.jpeg') ?>">
                </td>
                <td class="profile-name">
                    <center>
                        <h1><span><?= ucwords(strtolower($joiningFormDetails['first_name'] . ' ' . $joiningFormDetails['last_name'])) ?></span></h1>
                        <h3>Profession</h3>
                    </center>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- <div> -->
    <section class="left">
        <div class="personal-details">
            <h2 class="title-1">Contacts</h2>
            <p><i class="far fa-envelope"></i> <label for=""><?= $joiningFormDetails['email_primary'] ?></label></p>
            <p><i class="fas fa-mobile-alt"></i> <label for=""><?= $joiningFormDetails['mobile_primary'] ?></label></p>
            <p><i class="fas fa-map-marker-alt"></i> <label for=""><?=$joiningFormDetails['present_address']?></label></p>
        </div>

        <div class="technical-skills">
            <h2 class="title-1">Skills</h2>
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

        <div class="technical-skills">
            <h2 class="title-1">Languages</h2>
            <?php foreach ($languages as $language) {
                $width = ($language['rating'] / 10) * 100;
            ?>
                <div class="skill">
                    <label><?= $language['text'] ?></label>
                    <p>
                        <span style='<?= "width:$width%" ?>'></span>
                    </p>
                </div>
            <?php } ?>
        </div>

    </section>
    <section class="right">
        <div class="professional-profile">

            <h2 class="title-1">Professional profile</h2>
            <div>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere neque tenetur est cumque accusantium consequuntur, veritatis enim error mollitia placeat itaque eos voluptas repellat facilis asperiores. Voluptate nesciunt adipisci error.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere neque tenetur est cumque accusantium consequuntur, veritatis enim error mollitia placeat itaque eos voluptas repellat facilis asperiores. Voluptate nesciunt adipisci error.
                </p>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere neque tenetur est cumque accusantium consequuntur, veritatis enim error mollitia placeat itaque eos voluptas repellat facilis asperiores. Voluptate nesciunt adipisci error.
                </p>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere neque tenetur est cumque accusantium consequuntur, veritatis enim error mollitia placeat itaque eos voluptas repellat facilis asperiores. Voluptate nesciunt adipisci error.
                </p>
            </div>
        </div>

        <div class="education-container">
            <h2 class="title-1">education</h2>
            <table>
                <tbody>
                    <tr>
                        <td class="icon">
                            <i class="fas fa-graduation-cap"></i>
                        </td>
                        <td>
                            <h3><b>2001-2005 Degree/Major</b></h3>
                            <h3>university/school name</h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium libero veritatis, praesentium possimus ullam in excepturi reiciendis itaque porro nobis. Neque qui, tempore dignissimos perspiciatis nobis quas quo ipsa dolorum!</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                    <tr>
                        <td class="icon">
                            <i class="fas fa-graduation-cap"></i>
                        </td>
                        <td>
                            <h3><b>2001-2005 Degree/Major</b></h3>
                            <h3>university/school name</h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium libero veritatis, praesentium possimus ullam in excepturi reiciendis itaque porro nobis. Neque qui, tempore dignissimos perspiciatis nobis quas quo ipsa dolorum!</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                    <tr>
                        <td class="icon">
                            <i class="fas fa-graduation-cap"></i>
                        </td>
                        <td>
                            <h3><b>2001-2005 Degree/Major</b></h3>
                            <h3>university/school name</h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium libero veritatis, praesentium possimus ullam in excepturi reiciendis itaque porro nobis. Neque qui, tempore dignissimos perspiciatis nobis quas quo ipsa dolorum!</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="education-container">
        <h2 class="title-1">Work Experience</h2>
            <table>
                <tbody>
                    <tr>
                        <td class="icon">
                            <i class="fa fa fa-briefcase"></i>
                        </td>
                        <td>
                            <h3><b>2020-Present Company/Position</b></h3>
                            <!-- <h3>university/school name</h3> -->
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium libero veritatis, praesentium possimus ullam in excepturi reiciendis itaque porro nobis. Neque qui, tempore dignissimos perspiciatis nobis quas quo ipsa dolorum!</p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table>
                <tbody>
                    <tr>
                        <td class="icon">
                        <i class="fa fa fa-briefcase"></i>
                        </td>
                        <td>
                            <h3><b>2018-2020 Company/Position</b></h3>
                            <!-- <h3>university/school name</h3> -->
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium libero veritatis, praesentium possimus ullam in excepturi reiciendis itaque porro nobis. Neque qui, tempore dignissimos perspiciatis nobis quas quo ipsa dolorum!</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                    <tr>
                        <td class="icon">
                        <i class="fa fa fa-briefcase"></i>
                        </td>
                        <td>
                            <h3><b>2015-2018 Company/Position</b></h3>
                            <!-- <h3>university/school name</h3> -->
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium libero veritatis, praesentium possimus ullam in excepturi reiciendis itaque porro nobis. Neque qui, tempore dignissimos perspiciatis nobis quas quo ipsa dolorum!</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="education-container">
        <h2 class="title-1">Achievements</h2>
            <table>
                <tbody>
                    <tr>
                        <td class="icon">
                            <i class="fa fa-award"></i>
                        </td>
                        <td>
                            <h3><b>2020 Acheivment 1</b></h3>
                            <!-- <h3>university/school name</h3> -->
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table>
                <tbody>
                    <tr>
                        <td class="icon">
                        <i class="fa fa-award"></i>
                        </td>
                        <td>
                            <h3><b>2018 2020 Acheivment 2</b></h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            
        </div>

    </section>
    <!-- </div> -->


</body>

</html>