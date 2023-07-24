<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title> Food House -
        <?php if ($_SESSION['user']['user_level'] === '0') : ?>
            Cashier (<?= $title ?>)
        <?php elseif ($_SESSION['user']['user_level'] === '1') : ?>
            Admin (<?= $title ?>)
        <?php elseif ($_SESSION['user']['user_level'] === '2') : ?>
            HR (<?= $title ?>)
        <?php elseif ($_SESSION['user']['user_level'] === '3') : ?>
            Customer (<?= $title ?>)
        <?php endif; ?>
    </title>

    <link rel="shortcut icon" href="<?= LOGO ?>" type="image/x-icon">

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">

    <!-- CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link href="<?= CSS_ASSETS_PATH ?>/paper-dashboard.css?v=2.0.1" rel="stylesheet" />

    <link href="<?= CSS_ASSETS_PATH ?>/table-style.css" rel="stylesheet" />

    <link href="<?= DEMO_PATH ?>/demo.css" rel="stylesheet" />

    <style>
        .error {
            /* styles error message based on the modern day */
            background: #f2dede;
            color: #a94442;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ebccd1;

        }

        /* animate error */
        .error {
            animation: shake 0.5s;
            /* make animation stop */
            animation-iteration-count: 1;
        }

        /* shake keyframes */
        @keyframes shake {
            0% {
                transform: translate(1px, 1px) rotate(0deg);
            }

            10% {
                transform: translate(-1px, -2px) rotate(-1deg);
            }

            20% {
                transform: translate(-3px, 0px) rotate(1deg);
            }

            30% {
                transform: translate(3px, 2px) rotate(0deg);
            }

            40% {
                transform: translate(1px, -1px) rotate(1deg);
            }

            50% {
                transform: translate(-1px, 2px) rotate(-1deg);
            }

            60% {
                transform: translate(-3px, 1px) rotate(0deg);
            }

            70% {
                transform: translate(3px, 1px) rotate(-1deg);
            }

            80% {
                transform: translate(-1px, -1px) rotate(1deg);
            }

            90% {
                transform: translate(1px, 2px) rotate(0deg);
            }

            100% {
                transform: translate(1px, -2px) rotate(-1deg);
            }
        }

        .very-small-text {
            font-size: 0.85rem;
        }

        /* cool admin background color */
        .admin-background {
            /* make admin background color more robust and unique */
            background-image: linear-gradient(315deg, #f5f5f5 0%, #e7e7e7 74%);
        }
    </style>


</head>

<body class="">