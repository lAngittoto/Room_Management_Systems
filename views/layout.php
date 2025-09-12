<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ??'room' ?></title>
    <link rel="stylesheet" href="src/output.css">
    <link rel="stylesheet" href="CSS/fontawesome.min.css">
    <link rel="stylesheet" href="CSS/all.min.css">
   <!--npx @tailwindcss/cli -i ./src/input.css -o ./src/output.css --watch-->
  

</head>

<body class=" bg-[#ffffff] font-mono">
    <?= $content ?>
</body>

</html>
