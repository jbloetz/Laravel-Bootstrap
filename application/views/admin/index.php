<?=View::make('admin.inc.meta')->render()?>
    <title>Koki Studio Dashboard</title>
  </head>
  <body>
    <?=View::make('admin.inc.header')->render()?>
    <div class="container">

      <div class="row-fluid">

        <div class="span3"> <!-- Sidebar -->
          <div class="well">
            <?=View::make('admin.inc.sidebar')->render()?>
          </div>
        </div> <!-- /Sidebar -->

        <div class="span9">
          <h1>Website Backend Dashboard</h1>
          <p>You can use this control panel to administer certain aspects of your website. If you get stuck there will always be a Help &amp; Support Button in the sidebar to the left.</p>
        </div>

      </div>
      <div class="row-fluid">
        <div class="span12">
          <p>You are logged in as: <?=$user->username?></p>
        </div>
      </div>
    </div> <!-- /container -->

    <?=View::make('admin.inc.scripts')->render()?>
  </body>
</html>
