<?php namespace components\tuxion; if(!defined('TX')) die('No direct access.');

?>
<div id="content" class="container_12">
  <div class="grid_2 col col--main-nav">

    <nav id="main-nav">
      <ul>
        <li><a href="<?php echo url('view=NULL', true); ?>">Dashboard</a></li>
        <?php if(tx('Data')->get->project_id->gt(0)->get('bool')){ ?>
        <li><a href="<?php echo url('view=issues', true); ?>">Issues</a></li>
        <li><a href="<?php echo url('view=issue', true); ?>">New issue</a></li>
        <?php } ?>
      </ul>
    </nav>

  </div><!-- /.grid_4.c1 -->
  <div class="grid_3 col col--sub-nav">
    <div class="inner">

      <h1>Projects</h1>
      <?php echo tx('Component')->modules('project')->get_html('project_list'); ?>

    </div><!-- /.inner -->
  </div><!-- /.grid_4.c2 -->
  <div class="grid_7 col col--main">
    <div class="inner">
      <?php echo $data; ?>
    </div><!-- /.inner -->
  </div><!-- /.grid_4.c3 -->
</div><!-- /#content -->