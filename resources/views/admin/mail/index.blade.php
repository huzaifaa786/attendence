<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Message from UOS Attendance Management System</title>
</head>
<body>
    <p><strong>Hi {{$user->fname. ' '. $user->lname}},</strong> </p>
    <p>
        Your attendance has been diligently recorded for the subject mentioned. If, by any chance, you come across any discrepancies or omissions in the attendance records, we kindly request you to bring it to our immediate attention by contacting us at info@attendance.klickwash.net. Your prompt action will assist us in rectifying any potential errors and ensuring accurate attendance records.
        <br>
        <strong>Subject Name:</strong>
        <br>
        {{$msubject->name}}</p>
    <p>
        Best Regards.
        <br>
        <strong>-From Attendance Management System-</strong> 
        <strong>-University of Sargodha</strong> 
    </p>
</body>
</html>