<style>
@media (min-width: 769px) and (max-width: 2100px){
.parent_foot {
  width: 27%;
  height: 40px;
  position: relative;
  overflow: hidden;
  margin-left: 20%;
}
.child_foot{
  position: absolute;
  bottom: 0;
  width: 425px;
}
/* .glyphicon {
    position: fixed;
    top: 1px;
    display: inline-block;
    font-family: "Glyphicons Halflings";
    font-style: normal;
    font-weight: 400;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    right: 0;
    bottom: 0;
    padding: 1%;
    font-size: 21px;
    border: 5px solid #ddd;
    border-radius: 50%;
} */
}
@media (min-width: 769px) and (max-width: 2100px){
.parent_foot {
  width: 27%;
  height: 40px;
  position: relative;
  overflow: hidden;
  margin-left: 20%;
}
.child_foot{
  position: absolute;
  bottom: 0;
  width: 425px;
}
/* .glyphicon {
    position: fixed;
    top: 1px;
    display: inline-block;
    font-family: "Glyphicons Halflings";
    font-style: normal;
    font-weight: 400;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    right: 0;
    bottom: 0;
    padding: 1%;
    font-size: 21px;
    border: 5px solid #ddd;
    border-radius: 50%;
} */
}
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
<footer class="text-center" >
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
  <p>LINE ID:<?php echo e($PostPaginate[0]->site_lineid); ?></p>
  <p>Wechat id：<?php echo e($PostPaginate[0]->site_wechartid); ?></p>
  <p>連繫電話 ：<?php echo e($PostPaginate[0]->site_cellphone); ?></p>
  <p>地址 ：<?php echo e($PostPaginate[0]->site_address); ?></p>
  <p>Copyright©<?php echo date('20y')?> ericsonic520,ltd.All right reserved.</p> 
</footer><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/front/blade/footer.blade.php ENDPATH**/ ?>