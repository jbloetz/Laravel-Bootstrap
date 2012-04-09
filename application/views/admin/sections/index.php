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
          <h1>CMS Sections</h1>
          <p>The CMS allows basic editing of sections throughout the website. Each page can have multiple "sections" which provides a very flexible method of editing virtually any content block on the website. For now, pages are manageable through the database directly so as not to lose content through accidental deletion.</p>
          <?=Messages::get_html()?>
          <?
            if($sections){
              echo '<table class="table table-striped table-bordered table-condensed">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Page</th>
                  <th>Title</th>
                  <th>Content Exerpt</th>
                  <th>Actions</th>
                </tr>
              </thead><tbody>
              ';
              foreach($sections as $section){
                echo '<tr>
                  <td>'.$section->id.'</td>
                  <td>'.($section->page ? $section->page->title : 'No Page Association' ).'</td>
                  <td>'.$section->title.'</td>
                  <td>'.Str::limit(strip_tags($section->content), 40).'</td>
                  <td><a class="btn btn-primary" href="'.action('admin.sections@edit', array($section->id)).'">Edit</a> <a class="delete_toggler btn btn-danger" rel="'.$section->id.'">Delete</a></td>
                </tr>';
              }
              echo '</tbody></table>';
            }else{
          ?>
            <div class="well">No sections today. Why not create one using the button below.</div>
          <?
            }
          ?>
          <a href="<?=action('admin.sections@create')?>" class="btn btn-primary right">New Section</a>
        </div>

      </div>

    </div> <!-- /container -->
    <div class="modal hide fade" id="delete_section">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Are You Sure?</h3>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this section?</p>
      </div>
      <div class="modal-footer">
        <?=Form::open('admin/sections/delete', 'POST')?>
        <a data-toggle="modal" href="#delete_section" class="btn">Keep</a>
        <input type="hidden" name="id" id="postvalue" value="" />
        <input type="submit" class="btn btn-danger" value="Delete" />
        <?=Form::close()?>
      </div>
    </div>
    <?=View::make('admin.inc.scripts')->render()?>
    <script>
      $('#delete_section').modal({
        show:false
      }); // Start the modal

      // Populate the field with the right data for the modal when clicked
      $('.delete_toggler').each(function(index,elem) {
          $(elem).click(function(){
            $('#postvalue').attr('value',$(elem).attr('rel'));
            $('#delete_section').modal('show');
          });
      });
    </script>
  </body>
</html>
