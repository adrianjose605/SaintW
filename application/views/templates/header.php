<html ng-app="saint">

    <head>
    <meta charset="UTF-8">

        <base href="<?php echo base_url() ?>">
        <title>Saint Web</title>

        <link rel="stylesheet" href="public/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="public/angular-material/angular-material.min.css">
        <link rel="stylesheet" href="public/bootstrap-material-design/css/material.min.css">
        <link rel="stylesheet" href="public/bootstrap-material-design/css/ripples.min.css">
        <link rel="stylesheet" href="public/bootstrap-material-design/css/roboto.min.css">
        <link rel="stylesheet" href="public/font-awesome/css/font-awesome.min.css">
      
        <link rel="stylesheet" href="public/material-icon/css/materialdesignicons.min.css">        
        <link rel="stylesheet" href="public/angular-datepicker-master/dist/index.min.css">
        <link rel="stylesheet" href="public/bootstrap-timepicker/less/timepicker.less">
        <link rel="stylesheet" href="public/css/general.css">
        <link rel="shortcut icon" type="image/png" href="public/img/Imagen1.png"/>


      <!-- <script src="public/js/jquery-2.1.3.min.js"></script>
        <script src="public/js/jquery-migrate-1.2.1.min.js"></script>
        <script src="public/js/bootstrap.js"></script>
        <script src="public/js/jquery.actual.min.js"></script>
        <script src="public/js/jquery.scrollTo.min.js"></script>
        <script src="public/js/script.js"></script>
        <script src="public/js/smoothscroll.js"></script>
        <script src="public/js/funciones.js"></script>-->

        <script src="public/jquery/jquery.min.js"></script>
        <script src="public/angular/angular.min.js"></script>
        <script src="public/moment/moment.js"></script>
        <script src="public/angular-aria/angular-aria.min.js"></script>
        <script src="public/angular-animate/angular-animate.min.js"></script>
        <script src="public/angular-messages/angular-messages.min.js"></script>
        <script src="public/angular-datepicker-master/dist/index.min.js"></script>
        <script src="public/bootstrap-material-design/js/material.min.js"></script>
        <script src="public/bootstrap-material-design/js/ripples.min.js"></script>
        <script src="public/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="public/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
        <script src="public/angular-material/angular-material.min.js"></script>
        
        <script src="public/ng-tasty/ng-tasty-tpls.min.js"></script>
        <script src="public/angular-bootstrap-ui/ui-bootstrap.min.js"></script>

        <script src="public/js/SaintW.js"></script>
        
        <!--<script src="public/pdf/pdf.js"></script>   
        <script src="public/pdf/angular-pdf.min.js"></script>  --> 

       <!--                   //////////////////////////////////////////
         <link href='public/css/font1.css' rel='stylesheet' type='text/css'>
        <link href='public/css/font2.css' rel='stylesheet' >
        <link href='public/css/font3.css' rel='stylesheet' type='text/css'>
        <link  href="public/css/font4.css" rel="stylesheet"/>-->

        <!-- css   
        <link rel="stylesheet" href="public/css/style.css" media="screen"/>-->  
        <meta name="viewport" content="initial-scale=1" />
        
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="public/js/html5shiv.js"></script>
                <script src="public/js/respond.js"></script>
        <![endif]-->

        <!--[if IE 8]>
        <script src="public/js/selectivizr.js"></script>
    <![endif]-->




        


 
        <script>
            $(document).ready(function () {
                $.material.init();
            });

            var base_url = '<?php echo base_url(); ?>';
        </script>
        <style>
            .md-toolbar-tools h1 {
                font-size: inherit;
                font-weight: inherit;
                margin: inherit;
            }
            .listdemoListControls md-divider {
                margin-top: 10px;
                margin-bottom: 10px; }

        </style>



    </head>

    <body layout="column" ng-controller="AppCtrl" >
   