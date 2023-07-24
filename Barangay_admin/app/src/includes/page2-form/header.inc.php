<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $title ?> </title>

    <!-- logo in the title  -->
    <link rel="shortcut icon" href="<?= LOGO ?>" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- Bulma CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= CSS_ASSETS_PATH ?>/globals.css">
    <link rel="stylesheet" href="<?= CSS_ASSETS_PATH ?>/icon-styles.css">
    <link rel="stylesheet" href="<?= CSS_ASSETS_PATH ?>/responsive.css">
    <link rel="stylesheet" href="<?= CSS_ASSETS_PATH ?>/grid-style.css">

    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />

    <!-- import font awesome -->
    <script src="https://kit.fontawesome.com/4b54adea79.js" crossorigin="anonymous"></script>

    <style>
        /* add a background color for website to make it more attractive based on the modern style */
        body {
            /* add a cool and attractive gradient background color */
            background: linear-gradient(45deg, #f5f7fa, #c3cfe2);
        }

        .light-color {
            color: rgb(103, 101, 101);
        }

        .bg-very-light-gray {
            background-color: rgb(245, 245, 245);
        }

        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }
    </style>
    </stylinput>
</head>

<body>