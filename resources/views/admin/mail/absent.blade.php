<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Message from UOS Attendance Management System</title>
</head>

<body>
    <p><strong>Hello {{$user->guardian_name}},</strong> </p>
    <p>
        This is to inform you that your child, {{ $user->fname .''. $user->lname}}, was absent today.

        Please feel free to contact us if you have any questions or concerns.
    <p>
        Best Regards.
        <br>
        <strong>-From Attendance Management System-</strong>
        <strong>-University of Sargodha</strong>
    </p>
</body>

</html>