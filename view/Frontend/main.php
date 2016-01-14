<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="<?php echo APP_URL ?>template/<?php echo $template ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <script src="<?php echo APP_URL ?>template/<?php echo $template ?>/js/jquery-1.11.3.min.js"></script>
        <script src="<?php echo APP_URL ?>template/<?php echo $template ?>/js/bootstrap.js"></script>
        </head>
    <body>
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo APP_URL?>">App</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          <li> <a href="<?php echo APP_URL ?>">Home</a> </li>
        <li> <a href="<?php echo Router::go("Frontend@register")?>">Register</a> </li>
        <li> <a href="<?php echo Router::go("Frontend@blog") ?>">Blog</a> </li>
         <li> <a href="<?php echo Router::go("Frontend@login") ?>">Login</a> </li>
         <?php if (Controller::getSession("user")!=null) { ?>
         <li> <button class="btn btn-default navbar-btn" onclick="window.location.replace('<?php echo Router::go("Frontend@logout") ?> ')">Logout</button> </li>
         <?php } ?>
      </ul>
</nav>    
                 <?php if (isset($_COOKIE['error'])) { ?>
                    <div class='alert alert-dismissable alert-danger yx-notify' role='alert'>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $_COOKIE['error']; ?>
                    </div>
                 <?php } ?>
                
                
                <!-- notify ajax -->
                <div class='alert alert-dismissable alert-danger yx-notify-ajax' role='alert' style="display:none">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
               <!-- end notify ajax -->
                <div class="page-header text-center">
                    <h1><?php echo $page_title ?></h1>
                </div>
                <div class="container container-center col-xs-8 col-xs-offset-2">
                    <?php include($page_content) ?>
                </div>
            </div>
    <?php if(isset($bottom)) { ?>
            <div class="container">
                <div class="row">
                  
                    <?php 
                    $html = "";
                    foreach ($bottom as $value) {
                        $html .= "<div classes='bottom col-xs-offset-2'>"
                                . "<div classes='container col-xs-4'>"
                                . "<h3>".$value['bottom_title']."</h3>"
                                . "<p>".$value['bottom_text']."</p>"
                                . "</div>"
                                . "</div>";
                    }
                    echo $html;
 } ?>
                </div>
            <div class="container text-center">
                <div class="row">
                    <footer>
                        <p>&copy; YB</p>
                    </footer>
                </div>
            </div>
        </div>
    <script>
    
    
    </script>
    </body>
</html>
