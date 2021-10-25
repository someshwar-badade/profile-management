<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joining form</title>
</head>

<body>
    <p>Hello <?= $first_name ?>,</p>
    <p>Please click bellow link to fill up your joing form and use Verification Code: <strong style="letter-spacing: 5px;"><?= $verification_code ?></strong> </p>

    <p>Link: <a href="<?= $link ?>"><?= $link ?></a></p>
    <p></p>

    <p>Thanks and Regards,</p>
    <p>Bistingit Team</p>
</body>

</html>