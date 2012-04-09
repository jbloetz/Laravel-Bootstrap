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
          <h1><?=( $create ? 'New Gallery' : 'Edit Gallery' )?></h1>
          <?=Messages::get_html()?>
          <?=Form::open('admin/gallery/'.( $create ? 'create' : 'edit' ), 'POST', array('class'=>'form-horizontal'));?>
          <? if(!$create): ?> <input type="hidden" name="id" value="<?=$gallery->id?>" /> <? endif; ?>
           
          <fieldset>
            <legend>Basic Information</legend>

            <div class="control-group">
              <?=Form::label('title', 'Gallery Title',array('class'=>'control-label'))?>
              <div class="controls">
                <?=Form::text('title',  ( Input::old('title') || $create ? Input::old('title') : $gallery->title ),array('placeholder'=>'Enter Gallery Title...'))?>
              </div>
            </div>

            <div class="control-group">
              <?=Form::label('description', 'Gallery Description',array('class'=>'control-label'))?>
              <div class="controls">
                <?=Form::textarea('description',( Input::old('description') || $create ? Input::old('description') : $gallery->description ),array('class'=>'editable_text','placeholder'=>'Enter Gallery Description...'))?>
              </div>
            </div>

          </fieldset>

          <div class="form-actions">
            <a class="btn" href="<?=url('admin/gallery')?>">Go Back</a>
            <input type="submit" class="btn btn-primary" value="<?=($create ? 'Create Gallery' : 'Save Gallery')?>" />
          </div>
        </div>

      </div>

    </div> <!-- /container -->

    <?=View::make('admin.inc.scripts')->render()?>
  </body>
</html>
