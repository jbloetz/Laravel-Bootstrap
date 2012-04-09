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
          <h1>Galleries</h1>
          <p>You can create your galleries here.</p>
          <?=Messages::get_html()?>
          <?
            if($galleries){
              echo '<table class="table table-striped table-bordered table-condensed">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Images Count</th>
                  <th>Actions</th>
                </tr>
              </thead><tbody>
              ';
              foreach($galleries as $gallery){
                echo '<tr>
                  <td>'.$gallery->id.'</td>
                  <td>'.$gallery->title.'</td>
                  <td>'.$gallery->image()->count().'</td>
                  <td><a class="btn btn-primary" href="'.action('admin.gallery@edit', array($gallery->id)).'">Edit</a> <a class="delete_toggler btn btn-danger" rel="'.$gallery->id.'">Delete</a></td>
                </tr>';
              }
              echo '</tbody></table>';
            }else{
          ?>
            <div class="well">No galleries today. Why not create one using the button below.</div>
          <?
            }
          ?>
          <a href="<?=action('admin.gallery@create')?>" class="btn btn-primary right">New Gallery</a>
        </div>

      </div>

    </div> <!-- /container -->
    <div class="modal hide fade" id="delete_gallery">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Are You Sure?</h3>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this gallery?</p>
      </div>
      <div class="modal-footer">
        <?=Form::open('admin/gallery/delete', 'POST')?>
          <a data-toggle="modal" href="#delete_gallery" class="btn">Keep</a>
          <input type="hidden" name="id" id="postvalue" value="" />
          <input type="submit" class="btn btn-danger" value="Delete" />
        <?=Form::close()?>
      </div>
    </div>
    <?=View::make('admin.inc.scripts')->render()?>
    <script>
      $('#delete_gallery').modal({
        show:false
      }); // Start the modal

      // Populate the field with the right data for the modal when clicked
      $('.delete_toggler').each(function(index,elem) {
          $(elem).click(function(){
            $('#postvalue').attr('value',$(elem).attr('rel'));
            $('#delete_gallery').modal('show');
          });
      });
    </script>
  </body>
</html>
