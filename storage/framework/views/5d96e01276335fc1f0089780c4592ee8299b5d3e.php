<?php if((sizeof($file_info) > 0) || (sizeof($directories) > 0)): ?>
<table class="table table-condensed table-striped">
  <thead>
    <th style='width:50%;'><?php echo e(Lang::get('laravel-filemanager::lfm.title-item')); ?></th>
    <th><?php echo e(Lang::get('laravel-filemanager::lfm.title-size')); ?></th>
    <th><?php echo e(Lang::get('laravel-filemanager::lfm.title-type')); ?></th>
    <th><?php echo e(Lang::get('laravel-filemanager::lfm.title-modified')); ?></th>
    <th><?php echo e(Lang::get('laravel-filemanager::lfm.title-action')); ?></th>
  </thead>
  <tbody>
    <?php foreach($directories as $key => $dir_name): ?>
    <tr>
      <td>
        <i class="fa fa-folder-o"></i>
        <a class="folder-item pointer" data-id="<?php echo e($dir_name['long']); ?>">
          <?php echo e($dir_name['short']); ?>

        </a>
      </td>
      <td></td>
      <td><?php echo e(Lang::get('laravel-filemanager::lfm.type-folder')); ?></td>
      <td></td>
      <td></td>
    </tr>
    <?php endforeach; ?>

    <?php foreach($file_info as $file): ?>
    <tr>
      <td>
        <?php if($type == 'Images'): ?>
        <i class="fa fa-image"></i>
        <?php else: ?>
        <i class="fa <?php echo e($file['icon']); ?>"></i>
        <?php endif; ?>
        <?php $file_name = $file['name'];?>
        <a href="javascript:useFile('<?php echo e($file_name); ?>')">
          <?php echo e($file_name); ?>

        </a>
        &nbsp;&nbsp;
        <a href="javascript:rename('<?php echo e($file_name); ?>')">
          <i class="fa fa-edit"></i>
        </a>
      </td>
      <td>
        <?php echo e($file['size']); ?>

      </td>
      <td>
        <?php echo e($file['type']); ?>

      </td>
      <td>
        <?php echo e(date("Y-m-d h:m", $file['created'])); ?>

      </td>
      <td>
        <a href="javascript:trash('<?php echo e($file_name); ?>')">
          <i class="fa fa-trash fa-fw"></i>
        </a>
        <?php if($type == 'Images'): ?>
        <a href="javascript:cropImage('<?php echo e($file_name); ?>')">
          <i class="fa fa-crop fa-fw"></i>
        </a>
        <a href="javascript:resizeImage('<?php echo e($file_name); ?>')">
          <i class="fa fa-arrows fa-fw"></i>
        </a>
        <?php /*<a href="javascript:notImp()">*/ ?>
        <?php /*<i class="fa fa-rotate-left fa-fw"></i>*/ ?>
        <?php /*</a>*/ ?>
        <?php endif; ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php else: ?>
<div class="row">
  <div class="col-md-12">
    <p><?php echo e(Lang::get('laravel-filemanager::lfm.message-empty')); ?></p>
  </div>
</div>
<?php endif; ?>
