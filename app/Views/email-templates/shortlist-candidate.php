

<?= $this->extend('email-templates/main') ?>


<?= $this->section('content') ?>

<table id="u_content_text_1" style="font-family:'Raleway',sans-serif;" role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
    <tbody>
        <tr>
            <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 20px;font-family:'Raleway',sans-serif;" align="left">

                <div class="v-text-align v-line-height" style="color: #132f40; line-height: 140%; text-align: left; word-wrap: break-word;">
                    <p style="font-size: 14px; line-height: 140%;"><span style="font-family: Rubik, sans-serif; font-size: 16px; line-height: 22.4px;">Hello <strong><?= $first_name ?></strong>,</p>
                </div>

            </td>
        </tr>
    </tbody>
</table>


<table style="font-family:'Raleway',sans-serif;" role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
    <tbody>
        <tr>
            <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 20px;font-family:'Raleway',sans-serif;" align="left">

                <div class="v-text-align v-line-height" style="color: #333333; line-height: 180%; text-align: left; word-wrap: break-word;">
                    <p style="font-size: 14px; line-height: 180%;"><span style="font-family: Raleway, sans-serif; font-size: 14px; line-height: 25.2px;"><strong>Congratulations! Your profile is shortlisted.</strong></span></p>
                </div>

            </td>
        </tr>
    </tbody>
</table>

<table style="font-family:'Raleway',sans-serif;" role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
    <tbody>
        <tr>
            <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 20px;font-family:'Raleway',sans-serif;" align="left">

                <div class="v-text-align v-line-height" style="color: #333333; line-height: 180%; text-align: left; word-wrap: break-word;">
                    <p style="font-size: 14px; line-height: 180%;"><span style="font-family: Raleway, sans-serif; font-size: 14px; line-height: 25.2px;"><strong><?=$job_title?></strong></span></p>
                    <p style="font-size: 14px; line-height: 180%;"><span style="font-family: Raleway, sans-serif; font-size: 14px; line-height: 25.2px;">Experience: <?=$experience?></span></p>
                    <p style="font-size: 14px; line-height: 180%;"><span style="font-family: Raleway, sans-serif; font-size: 14px; line-height: 25.2px;">Primary Skills: <?=$primary_skills?></span></p>
                    <p style="font-size: 14px; line-height: 180%;"><span style="font-family: Raleway, sans-serif; font-size: 14px; line-height: 25.2px;">Secondary Skills: <?=$secondary_skills?></span></p>
                </div>

            </td>
        </tr>
    </tbody>
</table>

<table style="font-family:'Raleway',sans-serif;" role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
    <tbody>
        <tr>
            <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 20px;font-family:'Raleway',sans-serif;" align="left">

                <div class="v-text-align v-line-height" style="color: #333333; line-height: 180%; text-align: left; word-wrap: break-word;">
                    <p style="font-size: 14px; line-height: 180%;"><span style="font-family: Raleway, sans-serif; font-size: 14px; line-height: 25.2px;"><a href="<?=$apply_now_link?>" class="btn">Apply Now</a></span></p>
                </div>

            </td>
        </tr>
    </tbody>
</table>


<?= $this->endSection() ?>