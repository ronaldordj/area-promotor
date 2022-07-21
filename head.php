<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    

    <title>Movel In - Área do Promotor</title>
    <meta name="description" content="Movel In - Área do Promotor">
    <meta name="author" content="DriftWeb">
    <meta name="viewport" content="width=device-width, initial-scale=1">	
	

    <link rel="icon" href="https://movelin.com.br/wp-content/uploads/2019/12/cropped-favicon-movel-in-32x32.png" sizes="32x32">
    <link rel="icon" href="https://movelin.com.br/wp-content/uploads/2019/12/cropped-favicon-movel-in-192x192.png" sizes="192x192">
    <link rel="apple-touch-icon-precomposed" href="https://movelin.com.br/wp-content/uploads/2019/12/cropped-favicon-movel-in-180x180.png">
	
    <link rel="stylesheet" href="public/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="public/css/bootstrapcustom.css">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/simple-sidebar.css">
	

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="public/js/bootstrap.bundle.min.js"></script>
    <?php
    include("mobile_device_detect.php");
    $mobile = mobile_device_detect();

    if (!isset($_SESSION['usuarioId'])) {
        session_unset();
        session_destroy();
        
        if ($mobile == TRUE) {
            header('location:./mobile/login.php');
        }
        else {
            header('location:./view/login');
        }
        
    }
    ?>
	
</head>
