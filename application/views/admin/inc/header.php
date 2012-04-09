<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="<?=url('admin/dashboard')?>">Koki Dashboard</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="<?=( URI::is('admin/dashboard') ? 'active' : false )?>"><a href="<?=url('admin/dashboard')?>">Home</a></li>
              <li class="<?=( URI::segment(2) == 'news' ? 'active' : false )?>"><a href="<?=url('admin/news')?>">News</a></li>
              <li class="<?=( URI::segment(2) == 'gallery' || URI::segment(2) == 'images' ? 'active' : false )?>"><a href="<?=url('admin/gallery')?>">Galleries</a></li>
              <li class="<?=( URI::segment(2) == 'pages' || URI::segment(2) == 'sections' ? 'active' : false )?>"><a href="<?=url('admin/pages')?>">CMS Pages</a></li>
              <li class="<?=( URI::segment(2) == 'users' || URI::segment(2) == 'roles' ? 'active' : false )?>"><a href="<?=url('admin/users')?>">Users &amp; Roles</a></li>
              <li class="<?=( URI::segment(2) == 'help' ? 'active' : false )?>"><a href="<?=url('admin/help')?>">Help &amp; Support</a></li>
            </ul>
            <ul class="nav pull-right">
            <li><a href="<?=url('admin/logout')?>">Logout &amp; Return To Site</a></li>
          </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>