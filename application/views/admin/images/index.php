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
          <h1>Images</h1>
          <p>You can create your images here.</p>
          <?=Messages::get_html()?>
          <?
            if($galleries){
              foreach($galleries as $gallery){
                echo '<h2>'.$gallery->title.'</h2>';
                if($gallery->image){
                  echo '<ul class="gallery_images thumbnails">';
                  foreach($gallery->image as $img){
                    if($img->uploads){
                      foreach($img->uploads as $up){
                        echo '<li class="span2">
                        <div class="thumbnail">
                          <img src="'.asset('uploads/'.$up->thumb_filename).'" />
                          <div class="caption">
                            <a class="btn btn-primary" href="'.action('admin.images@edit', array($img->id)).'">Edit</a> <a class="delete_toggler btn btn-danger" rel="'.$img->id.'">Delete</a>
                          </div>
                        </div></li>';
                      }
                    }
                  }
                  echo '</ul>';
                }else{
                  echo '<div class="well">No images for this gallery. Add one using the "Add Image" button.</div>';
                }
              }
            }else{
          ?>
            <div class="well">No galleries today. Why not create one using the button below.</div>
          <?
            }
          ?>
          <a href="<?=action('admin.images@create')?>" class="btn btn-primary right">New Image</a>
        </div>

      </div>

    </div> <!-- /container -->
    <div class="modal hide fade" id="delete_image">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Are You Sure?</h3>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this image?</p>
      </div>
      <div class="modal-footer">
        <?=Form::open('admin/images/delete', 'POST')?>
          <a data-toggle="modal" href="#delete_image" class="btn">Keep</a>
          <input type="hidden" name="id" id="postvalue" value="" />
          <input type="submit" class="btn btn-danger" value="Delete" />
        <?=Form::close()?>
      </div>
    </div>
    <?=View::make('admin.inc.scripts')->render()?>
    <script>
      $('#delete_image').modal({
        show:false
      }); // Start the modal

      // Populate the field with the right data for the modal when clicked
      $('.delete_toggler').each(function(index,elem) {
          $(elem).click(function(){
            $('#postvalue').attr('value',$(elem).attr('rel'));
            $('#delete_image').modal('show');
          });
      });
    </script>
  </body>
</html>
