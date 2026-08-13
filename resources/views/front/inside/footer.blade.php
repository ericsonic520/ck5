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
<footer>
        <div class="text-center">
          <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
            <span class="glyphicon glyphicon-chevron-up"></span>
          </a>
        </div>
        @if($site_blade[0]->site_blade=='front.classItem')
        <div class="container">
          <div class="row justify-content-center g-4">
            <div class="col-md-4 col-lg-3">
              <div class="col-md-4 col-lg-12">
                <H2>分類連結</H2>
                @foreach($breadcrumbs as $breadcrumb)
                <p><a href="{{ $breadcrumb->breadcrumb_api }}" style="float:left;width: 100%;">{{ $breadcrumb->breadcrumb_name }}</a></p>
                @endforeach
              </div> 
            </div>
            <div class="col-md-4 col-lg-3">
              <div class="col-md-4 col-lg-12">
                <H2>{{$PostPaginate[0]->site_name}}</H2>
                <p><i class="fa-solid fa-location-dot" style="color: #ffffff;"></i>{{$PostPaginate[0]->site_address}}</p>
                <p><i class="fa-solid fa-phone" style="color: #ffffff;"></i>{{$site[0]->site_cellphone}}</p>
              </div> 
            </div>
            <div class="col-md-4 col-lg-3">
              <div class="col-md-4 col-lg-12">
                <h2 class="footer-title">公司資訊</h2>
                <ul class="footer-list">
                  <li>營業時間 10:00 - 18:00</li>
                  <li>統一編號 09833644</li>
                  <li>美容養生與諮詢服務</li>
                  <li><a class="footer-policy-link" href="privacy.html">隱私權政策</a></li>
                </ul>
              </div>
            </div>
            <div class="col-md-4 col-lg-3">
              <div class="col-md-4 col-lg-12">
                <h2 class="footer-title">社群連結</h2>
                <a class="social-link" href="https://www.facebook.com/profile.php?id=61593148861970" target="_blank" rel="noopener" aria-label="Facebook"><i class="fa-brands fa-facebook fa-2xl" style="color: #ffffff;"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                <a class="social-link" href="https://www.youtube.com/watch?v=GWLEk0EBz5U&t=29s" target="_blank" rel="noopener" aria-label="YouTube"><i class="fa-brands fa-youtube fa-2xl" style="color: #ffffff;"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                <a class="social-link" href="https://line.me/R/ti/p/@245xjwxu?oat_content=url&ts=08060146" target="_blank" rel="noopener" aria-label="LINE"><i class="fa-brands fa-line fa-2xl" style="color: #ffffff;"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
              </div>
            </div>
          </div>
        </div>
        @endif
        @if($site_blade[0]->site_blade=='present.presentList')
        <div class="col-md-12 text-center">
            <p><i class="fa-brands fa-line" style="color: #ffffff;"></i><a href="https://line.me/ti/p/UCpYE6WinW">{{ $PostPaginate[0]->site_lineid }}</a></p>
            <p><i class="fa-solid fa-phone" style="color: #ffffff;"></i>{{$site_cellphone}}</p>
            <p>營業時間:10:00-18:00</p>
            <!-- <p>Wechat id：{{ $PostPaginate[0]->site_wechartid }}</p> -->
            <!-- <p>連繫電話 ：{{ $PostPaginate[0]->site_cellphone }}</p> -->
            <!-- <p>地址 ：{{ $PostPaginate[0]->site_address }}</p> -->
        </div>
        @endif
        </div>
      </div>
  <div class="text-center">
    <p>Copyright©<?php echo date('20y')?> ericsonic520,ltd.All right reserved.</p> 
  </div>
</footer>