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
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP" class="top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <div class="parent_foot">
    <div class="col-md-12 child_foot">
        @foreach($breadcrumbs as $breadcrumb)
        <p class="" style="float:left;"><a href="{{ $breadcrumb->breadcrumb_api }}" style="float:left;width: 100%;">{{ $breadcrumb->breadcrumb_name }}&nbsp;&nbsp;|&nbsp;&nbsp;</a></p>
        @endforeach
    </div>
  </div>
  <div class="container">
      <div class="row justify-content-center g-4">
        <div class="col-md-6 col-lg-3">
          <div>LINE ID:{{ $site_lineid }}</div>
        </div>
      </div>
  </div>
  <!-- <div>Wechat id：{{ $site_wechartid }}</div> -->
  <!-- <div>連繫電話 ：{{ $site_cellphone }}</div> -->
  <!-- <div>地址 ：{{ $site_address }}</div> -->
  <div>Copyright©<?php echo date('20y')?> ericsonic520,ltd.All right reserved.</p> 
</footer>
