<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="<?php echo $config['title']; ?>">
    <meta name="author" content="Josée Cristiano">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $config['title']; ?></title>
    <link rel="canonical" href="http://www.josee-cristiano.fr<?php echo $config['page']; ?>" />

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="site-wrapper">

    <div class="site-wrapper-inner">

        <div class="cover-container">

            <div class="masthead clearfix">
                <div class="inner">
                    <h3 class="masthead-brand"><a href="/">Josée <span class=""lastName">Cristiano</span></a></h3><br />
                    <p class="baseline">étudiante en graphisme</p>
                    <nav>
                        <ul class="nav masthead-nav">
                            <li<?php if(!isset($config['currentPage'])) :?> class="active"<?php endif; ?>><a href="/">Home</a></li>
                            <li<?php if(isset($config['currentPage']) && $config['currentPage'] == 'design') :?> class="active"<?php endif; ?>><a href="/design.php">Design graphique</a></li>
                            <li<?php if(isset($config['currentPage']) && $config['currentPage'] == 'photo') :?> class="active"<?php endif; ?>><a href="/photo.php">Photographie</a></li>
                            <li<?php if(isset($config['currentPage']) && $config['currentPage'] == 'cv') :?> class="active"<?php endif; ?>><a href="/cv.php">Me connaître</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
