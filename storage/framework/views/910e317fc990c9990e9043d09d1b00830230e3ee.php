<style>
/* 手機版 */
  @media (min-width: 0px) and (max-width: 768px){
  .parent_foot {
    width: 95%;
    height: 40px;
    position: relative;
    overflow: hidden;
  }
  .child_foot{
    position: absolute;
    bottom: 0;
    width: 425px;
  }
}
</style>
<!-- Footer -->
<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <div class="parent_foot">
    <div class="col-md-12 child_foot">
        <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <p class="" style="float:left;"><a href="<?php echo e($breadcrumb->breadcrumb_api); ?>" style="float:left;width: 100%;"><?php echo e($breadcrumb->breadcrumb_name); ?>&nbsp;&nbsp;|&nbsp;&nbsp;</a></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
  <div>LINE ID:<?php echo e($site_lineid); ?></div>
  <!-- <div>Wechat id：<?php echo e($site_wechartid); ?></div> -->
  <!-- <div>連繫電話 ：<?php echo e($site_cellphone); ?></div> -->
  <!-- <div>地址 ：<?php echo e($site_address); ?></div> -->
  <div>Copyright©<?php echo date('20y')?> ericsonic520,ltd.All right reserved.</p> 
</footer><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/front/inside/footer.blade.php ENDPATH**/ ?>