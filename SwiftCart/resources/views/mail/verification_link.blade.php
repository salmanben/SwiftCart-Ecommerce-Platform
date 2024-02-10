<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>verification</title>
</head>
<body>
<h4>Click on button to verify your email:</h4>
<h5 style="color:grey; margin: 5px 0">The link is valid for 15 minutes</h5>
<button style="margin-top: 5px;background:#FFCF17; color:white; border:none;border-radius:5px; padding:4px 6px; font-size:16px">
    <a href="{{ route('newsletter.verify_email', $token) }}" style="text-decoration:none; color:white">Verify</a>
</button>
</body>
</html>
