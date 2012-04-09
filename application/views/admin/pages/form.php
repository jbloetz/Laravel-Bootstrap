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
          <h1><?=( $create ? 'New Page' : 'Edit Page' )?></h1>
          <?=Messages::get_html()?>
          <?=Form::open('admin/pages/'.( $create ? 'create' : 'edit' ), 'POST', array('class'=>'form-horizontal'));?>
          <? if(!$create): ?> <input type="hidden" name="id" value="<?=$page->id?>" /> <? endif; ?>
           
          <fieldset>
            <legend>Basic Information</legend>

            <div class="control-group">
              <?=Form::label('title', 'Page Title',array('class'=>'control-label'))?>
              <div class="controls">
                <?=Form::text('title',  ( Input::old('title') || $create ? Input::old('title') : $page->title ),array('placeholder'=>'Enter Page Title...'))?>
              </div>
            </div>
          </fieldset>

          <fieldset>
            <legend>SEO Information</legend>
            <div class="control-group">
              <?=Form::label('meta_title', 'Meta Title',array('class'=>'control-label'))?>
              <div class="controls">
                <?=Form::text('meta_title',  ( Input::old('meta_title') || $create ? Input::old('meta_title') : $page->meta_title ),array('placeholder'=>'Enter Meta Title...'))?>
              </div>
            </div>

            <div class="control-group">
              <?=Form::label('meta_description', 'Meta Description',array('class'=>'control-label'))?>
              <div class="controls">
                <?=Form::text('meta_description',  ( Input::old('meta_description') || $create ? Input::old('meta_description') : $page->meta_description ),array('placeholder'=>'Enter Meta Description...'))?>
              </div>
            </div>

            <div class="control-group">
              <?=Form::label('meta_keywords', 'Meta Keywords',array('class'=>'control-label'))?>
              <div class="controls">
                <?=Form::text('meta_keywords',  ( Input::old('meta_keywords') || $create ? Input::old('meta_keywords') : $page->meta_keywords ),array('placeholder'=>'Enter Meta Keywords...'))?>
              </div>
            </div>

          </fieldset>

          <div class="form-actions">
            <a class="btn" href="<?=url('admin/pages')?>">Go Back</a>
            <input type="submit" class="btn btn-primary" value="<?=($create ? 'Create Page' : 'Save Page')?>" />
          </div>
        </div>

      </div>

    </div> <!-- /container -->

    <?=View::make('admin.inc.scripts')->render()?>
  </body>
</html>
