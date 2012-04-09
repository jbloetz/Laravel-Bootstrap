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
          <h1>News Articles</h1>
          <p>You can use this control panel to administer certain aspects of your website. If you get stuck there will always be a Help &amp; Support Button in the sidebar to the left.</p>
          <?=Messages::get_html()?>
          <?
            if($news){
              echo '<table class="table table-striped table-bordered table-condensed">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Content Exerpt</th>
                  <th>Created</th>
                  <th>Actions</th>
                </tr>
              </thead><tbody>
              ';
              foreach($news as $article){
                echo '<tr>
                  <td>'.$article->id.'</td>
                  <td>'.$article->title.'</td>
                  <td>'.Str::limit(strip_tags($article->content), 40).'</td>
                  <td>'.$article->created_at.'</td>
                  <td><a class="btn btn-primary" href="'.action('admin.news@edit', array($article->id)).'">Edit</a> <a class="delete_toggler btn btn-danger" rel="'.$article->id.'">Delete</a></td>
                </tr>';
              }
              echo '</tbody></table>';
            }else{
          ?>
            <div class="well">No news articles today. Why not create one using the button below.</div>
          <?
            }
          ?>
          <a href="<?=action('admin.news@create')?>" class="btn btn-primary right">New Article</a>
        </div>

      </div>

    </div> <!-- /container -->
    <div class="modal hide fade" id="delete_article">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Are You Sure?</h3>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this post?</p>
      </div>
      <div class="modal-footer">
        <?=Form::open('admin/news/delete', 'POST')?>
        <a data-toggle="modal" href="#delete_article" class="btn">Keep</a>
        <input type="hidden" name="id" id="postvalue" value="" />
        <input type="submit" class="btn btn-danger" value="Delete" />
        <?=Form::close()?>
      </div>
    </div>
    <?=View::make('admin.inc.scripts')->render()?>
    <script>
      $('#delete_article').modal({
        show:false
      }); // Start the modal

      // Populate the field with the right data for the modal when clicked
      $('.delete_toggler').each(function(index,elem) {
          $(elem).click(function(){
            $('#postvalue').attr('value',$(elem).attr('rel'));
            $('#delete_article').modal('show');
          });
      });
    </script>
  </body>
</html>
