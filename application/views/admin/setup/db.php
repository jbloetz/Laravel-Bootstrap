<?=View::make('admin.inc.meta')->render()?>
    <title>Setup Admin User</title>
  </head>
  <body>
    <div class="container loginwindow">

          <h1>Setup Admin User</h1>
          <?=Form::open('admin/setup', 'POST',array('class'=>'form-inline'));?>
          <?=Form::token()?>
            <div class="control-group">
              <label class="control-label" for="username">Username</label>
              <div class="controls">
                <input type="text" class="input-xlarge" id="username" name="username" placeholder="Enter Your Username...">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label" for="email">Email</label>
              <div class="controls">
                <input type="text" class="input-xlarge" id="email" name="email" placeholder="Enter Your Email Address...">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label" for="first_name">First Name</label>
              <div class="controls">
                <input type="text" class="input-xlarge" id="first_name" name="first_name" placeholder="Enter Your First Name...">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label" for="last_name">Last Name</label>
              <div class="controls">
                <input type="text" class="input-xlarge" id="last_name" name="last_name" placeholder="Enter Your Last Name...">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label" for="password">Password</label>
              <div class="controls">
                <input type="password" class="input-xlarge" id="password" name="password" placeholder="Enter Your Password...">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label" for="password_confirmation">Password Confirmation</label>
              <div class="controls">
                <input type="password" class="input-xlarge" id="password_confirmation" name="password_confirmation" placeholder="Confirm Your Password...">
              </div>
            </div>


            <input type="submit" class="btn btn-primary" value="Login To Dashboard" />
          <?=Form::close()?>
    </div> <!-- /container -->

    <?=View::make('admin.inc.scripts')->render()?>
  </body>
</html>
