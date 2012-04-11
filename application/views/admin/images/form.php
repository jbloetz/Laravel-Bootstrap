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
          <h1><?=( $create ? 'New Image' : 'Edit Image' )?></h1>
          <?=Messages::get_html()?>
          <?=Form::open_for_files('admin/images/'.( $create ? 'create' : 'edit' ), 'POST', array('class'=>'form-horizontal'));?>
          <? if(!$create): ?> <input type="hidden" name="id" value="<?=$image->id?>" /> <? endif; ?>
           
          <fieldset>
            <legend>Basic Information</legend>

            <div class="control-group">
              <?=Form::label('gallery_id', 'Belongs To Gallery',array('class'=>'control-label'))?>
              <div class="controls">
                <?
                $dataset[''] = 'Please Select A Gallery';
                if($galleries){
                  foreach($galleries as $gallery){
                    $dataset[$gallery->id] = $gallery->title;
                  }
                }
                echo Form::select('gallery_id', $dataset, $create || !$image->gallery ? false : $image->gallery->id )?>
              </div>
            </div>

            <div class="control-group">
              <?=Form::label('title', 'Image Title',array('class'=>'control-label'))?>
              <div class="controls">
                <?=Form::text('title',  ( Input::old('title') || $create ? Input::old('title') : $image->title ),array('placeholder'=>'Enter Image Title...'))?>
              </div>
            </div>


          </fieldset>
          <fieldset>
            <legend>Images</legend>
            <div class="row">
              <div class="span5">
                <div class="control-group">
                  <?=Form::label('image', 'Upload Image',array('class'=>'control-label'))?>
                  <div class="controls">
                    <input type="file" name="image" value="<?=Input::old('file')?>" />
                  </div>
                </div>
              </div>
              <div class="span3">
                <?
                  if(!$create && $image->uploads){
                ?>
                <ul class="thumbnails">
                  <? foreach($image->uploads as $upload){ ?>
                  <li>
                    <div class="thumbnail">
                      <img src="<?=asset('uploads/'.$upload->small_filename)?>" alt="">
                      <div class="caption">
                        <p><strong>User:</strong> '<?=$upload->user->username?>'</p>
                        <p><strong>Uploaded:</strong> '<?=$upload->created_at?>'</p>
                      </div>
                    </div>
                  </li>
                  <? } ?>
                </ul>
                <? } ?>
              </div>
          </fieldset>
          <div class="form-actions">
            <a class="btn" href="<?=url('admin/images')?>">Go Back</a>
            <input type="submit" class="btn btn-primary" value="<?=($create ? 'Create Image' : 'Save Image')?>" />
          </div>
        </div>

      </div>

    </div> <!-- /container -->

    <?=View::make('admin.inc.scripts')->render()?>
  </body>
</html>
