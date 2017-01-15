<ul class="list-unstyled">
  <?php if(Config::get('lfm.allow_multi_user')): ?>
  <li style="margin-left: -10px;">
    <a class="pointer folder-item" data-id="<?php echo e($user_dir); ?>">
      <i class="fa fa-folder-open"></i> <?php echo e(Lang::get('laravel-filemanager::lfm.title-root')); ?>

    </a>
  </li>
  <?php foreach($dirs as $key => $dir_name): ?>
  <li>
    <a class="pointer folder-item" data-id="<?php echo e($dir_name['long']); ?>">
      <i class="fa fa-folder"></i> <?php echo e($dir_name['short']); ?>

    </a>
  </li>
  <?php endforeach; ?>
  <hr>
  <?php endif; ?>
  <li style="margin-left: -10px;">
    <a class="pointer folder-item" data-id="<?php echo e($share_dir); ?>">
      <i class="fa fa-folder"></i> <?php echo e(Lang::get('laravel-filemanager::lfm.title-shares')); ?>

    </a>
  </li>
  <?php foreach($shares as $key => $dir_name): ?>
  <li>
    <a class="pointer folder-item" data-id="<?php echo e($dir_name['long']); ?>">
      <i class="fa fa-folder"></i> <?php echo e($dir_name['short']); ?>

    </a>
  </li>
  <?php endforeach; ?>
</ul>
