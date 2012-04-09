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
          <h1><?=( $create ? 'New Article' : 'Edit Article' )?></h1>
          <?=Messages::get_html()?>
          <?=Form::open_for_files('admin/news/'.( $create ? 'create' : 'edit' ), 'POST', array('class'=>'form-horizontal'));?>
          <? if(!$create): ?> <input type="hidden" name="id" value="<?=$article->id?>" /> <? endif; ?>
           
          <fieldset>
            <legend>Basic Information</legend>

            <div class="control-group">
              <?=Form::label('title', 'Article Title',array('class'=>'control-label'))?>
              <div class="controls">
                <?=Form::text('title',  ( Input::old('title') || $create ? Input::old('title') : $article->title ),array('placeholder'=>'Enter Article Title...'))?>
              </div>
            </div>

            <div class="control-group">
              <?=Form::label('content', 'Article Content',array('class'=>'control-label'))?>
              <div class="controls">
                <?=Form::textarea('content',( Input::old('content') || $create ? Input::old('content') : $article->content ),array('placeholder'=>'Enter Article Content...'))?>
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
                  if(!$create && $article->uploads){
                ?>
                <ul class="thumbnails">
                  <? foreach($article->uploads as $upload){ ?>
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
            <a class="btn" href="<?=url('admin/news')?>">Go Back</a>
            <input type="submit" class="btn btn-primary" value="<?=($create ? 'Create Article' : 'Save Article')?>" />
          </div>
        </div>

      </div>

    </div> <!-- /container -->

    <?=View::make('admin.inc.scripts')->render()?>
  </body>
</html>
