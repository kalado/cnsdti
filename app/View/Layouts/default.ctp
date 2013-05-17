<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <title>TI CNSD - <?php echo $title_for_layout; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <meta name="author" content="Lucas Kalado - kalado@gmail.com" />

        <!-- Le styles -->
	    <?php echo $this->Html->css('bootstrap'); ?>
	    
	    <?php
	    echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	    ?>
        <style type="text/css">
	      body {
	        padding-top: 60px;
	        padding-bottom: 40px;
	      }
	      .sidebar-nav {
	        padding: 9px 0;
	      }
	
	      @media (max-width: 980px) {
	        /* Enable use of floated navbar text */
	        .navbar-text.pull-right {
	          float: none;
	          padding-left: 5px;
	          padding-right: 5px;
	        }
	      }
	    </style>
        <?php echo $this->Html->css('bootstrap-responsive'); ?>
        <?php echo $this->Html->css('cupertino/jUi'); ?>

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
        <?php echo $this->Html->script('jquery'); ?>
        <?php echo $this->Html->script('jUi'); ?>
        <?php echo $this->Html->script('bootstrap'); ?>
        <?php echo $this->Html->script('ajax'); ?>
        
        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="favicon.ico"/>
    </head>

    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="<?php echo $this->Html->url("/"); ?>"><img src="<?php echo $this->Html->url("/img/cnsdti/logo.png"); ?>" alt="" /></a>
                    <div class="nav-collapse collapse">
						<ul class="nav pull-right">
							<li><a href="#contact">Ajuda e Erros</a></li>
			            </ul>
					</div><!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row-fluid">
                <?php echo $this->element("menu", array('cache' => true)); ?>

                <?php echo $this->fetch('content'); ?>
            </div><!--/row-->

            <hr/>

            <footer>
                <p>&copy; Colégio Nossa Senhora das Dores</p>
            </footer>

        </div><!--/.fluid-container-->
    </body>
</html>