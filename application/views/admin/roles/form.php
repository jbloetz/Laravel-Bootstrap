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

        <div class="span9 crud">
          <h1><?=( $create ? 'New Role' : 'Edit Role' )?></h1>
          <?=Messages::get_html()?>
          <?=Form::open('admin/roles/'.( $create ? 'create' : 'edit' ), 'POST', array('class'=>'form-horizontal'));?>
          <? if(!$create): ?> <input type="hidden" name="id" value="<?=$role->id?>" /> <? endif; ?>
           
          <fieldset>
            <legend>Basic Information</legend>

            <div class="control-group">
              <?=Form::label('name', 'Role Name',array('class'=>'control-label'))?>
              <div class="controls">
                <?=Form::text('name',  ( Input::old('name') || $create ? Input::old('name') : $role->name ),array('placeholder'=>'Enter Role Name...'))?>
              </div>
            </div>
          </fieldset>
          <?
            if($users){
              echo '<fieldset><legend>Users Assigned To This Role</legend><div class="control-group">';
              echo Form::label('user_list','Role\'s Users', array('class'=>'control-label'));
              foreach($users as $user){
          ?>
              <div class="controls">
                <label class="checkbox">
                  <?=Form::checkbox('users['.$user->id.']', '1', ( Input::old('users['.$user->id.']') || $create ? Input::old('users['.$user->id.']') : Koki::has_role($user,$role->id) ) );?>
                  <?=$user->fullname?>
                </label>
              </div>
            </div>
          <?
              }
              echo '</fieldset>';
            }
          ?>

          <div class="form-actions">
            <a class="btn" href="<?=url('admin/roles')?>">Go Back</a>
            <input type="submit" class="btn btn-primary" value="<?=($create ? 'Create Role' : 'Save Role')?>" />
          </div>
        </div>

      </div>

    </div> <!-- /container -->

    <?=View::make('admin.inc.scripts')->render()?>
  </body>
</html>
