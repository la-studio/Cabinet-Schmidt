<?php $__env->startSection('content'); ?>
  <div class="row storytelling-list">
    <div class="col-xs">
      <?php foreach($stories as $story): ?>
        <div class="row story">
          <div class="col-xs">
            <div class="row middle-xs story__header">
              <h2><?php echo e($story->title); ?></h2>
              <span><a href="/admin/storytelling/edit/<?php echo e($story->id); ?>"><i class="material-icons">create</i></a></span></a>
            </div>
            <div class="row story__content">
              <a href="/admin/storytelling/edit/<?php echo e($story->id); ?>" class="col-md-6 col-sm-8 col-xs-12 story__cover" style="background-image: url('<?php echo e($story->cover); ?>')"></a>
              <div class="col-xs-6 story__text">
                <span class="row slogan"><?php echo e($story->summary); ?></span>
                <ul class="list">
                  <?php foreach($story->list_item as $item_list): ?>
                    <li class="list__item"><?php echo e($item_list->name); ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard-layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>