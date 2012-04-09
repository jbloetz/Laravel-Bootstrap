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
          <h1><?=( $create ? 'New Section' : 'Edit Section' )?></h1>
          <?=Messages::get_html()?>
          <?=Form::open_for_files('admin/sections/'.( $create ? 'create' : 'edit' ), 'POST', array('class'=>'form-horizontal'));?>
          <? if(!$create): ?> <input type="hidden" name="id" value="<?=$section->id?>" /> <? endif; ?>
           
          <fieldset>
            <legend>Basic Information</legend>

            <div class="control-group">
              <?=Form::label('page_id', 'Belongs To Page',array('class'=>'control-label'))?>
              <div class="controls">
                <?
                $dataset[''] = 'Please Select A Page';
                if($pages){
                  foreach($pages as $page){
                    $dataset[$page->id] = $page->title;
                  }
                }
                echo Form::select('page_id', $dataset, $create || !$section->page ? false : $section->page_id )?>
              </div>
            </div>

            <div class="control-group">
              <?=Form::label('title', 'Section Title',array('class'=>'control-label'))?>
              <div class="controls">
                <?=Form::text('title',  ( Input::old('title') || $create ? Input::old('title') : $section->title ),array('placeholder'=>'Enter Section Title...'))?>
              </div>
            </div>

            <div class="control-group">
              <?=Form::label('content', 'Section Content',array('class'=>'control-label'))?>
              <div class="controls">
                <?=Form::textarea('content',( Input::old('content') || $create ? Input::old('content') : $section->content ),array('placeholder'=>'Enter Section Content...'))?>
              </div>
            </div>

            
          </fieldset>
          <fieldset>
            <legend>Images</legend>
            <div class="row">
              <div class="span5">
                <div class="control-group">
                  <?=Form::label('content', 'Upload Image',array('class'=>'control-label'))?>
                  <div class="controls">
                    <input type="file" name="image" value="<?=Input::old('file')?>" />
                  </div>
                </div>
              </div>
              <div class="span3">
                <?
                  if(!$create && $section->uploads){
                ?>
                <ul class="thumbnails">
                  <? foreach($section->uploads as $upload){ ?>
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
            <a class="btn" href="<?=url('admin/sections')?>">Go Back</a>
            <input type="submit" class="btn btn-primary" value="<?=($create ? 'Create Section' : 'Save Section')?>" />
          </div>
        </div>

      </div>

    </div> <!-- /container -->

    <?=View::make('admin.inc.scripts')->render()?>
  </body>
</html>
