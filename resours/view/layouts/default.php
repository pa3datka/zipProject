<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
</head>
<body>
<form action="/add" method="post" enctype="multipart/form-data">
    <input type="file" name="file" multiple accept="application/x-zip-compressed'">
    <input type="submit" value="Run">
</form>
</body>
</html>

