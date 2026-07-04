<div class="col-md-3">

    <?php if($slide_no=="1" or $slide_no=="2" or $slide_no=="5"): ?>
    <div id="sidebar">
        	<div class="navAbout">
            	<h3>公司簡介選單</h3>
                <ul>
	 		<?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        	<li><a href="<?php echo e($menus->menu_api); ?>" title="<?php echo e($menus->menu_name); ?>"><?php echo e($menus->menu_name); ?></a></li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        	<!-- <li><a href="/profile-0968033244.html" title="公益活動-零瑕疵紋繡">公益活動-零瑕疵紋繡</a></li>
        
        	<li><a href="/profile-about.html" title="關於零瑕疵紋繡">關於零瑕疵紋繡</a></li>
        
        	<li><a href="/profile-9.html" title="9月舉辦公益活動">9月舉辦公益活動</a></li>
        
        	<li><a href="/profile-aa.html" title="乳暈瑕疵紋繡">乳暈瑕疵紋繡</a></li>
        
        	<li><a href="/profile-0968033244.html" title="瑕疵遮瑕紋繡">瑕疵遮瑕紋繡</a></li>
        
        	<li><a href="/profile-service.html" title="乳暈疤痕淡色紋繡">乳暈疤痕淡色紋繡</a></li>
        
        	<li><a href="/profile-0968033244.html" title="黑色素保養系列">黑色素保養系列</a></li>
        
        	<li><a href="/profile-shine.html" title="新式無框微笑雕唇">新式無框微笑雕唇</a></li>
        
        	<li><a href="/profile-NN.html" title="手部淨膚紋繡">手部淨膚紋繡</a></li>
        
        	<li><a href="/profile-Pg.html" title="屁股微笑線淨膚紋繡">屁股微笑線淨膚紋繡</a></li>
        
        	<li><a href="/profile-EE.html" title="腋下粉飾紋繡">腋下粉飾紋繡</a></li>
        
        	<li><a href="/profile-pp.html" title="腳部絲襪紋繡">腳部絲襪紋繡</a></li> -->
        
</ul>
<!--
<div class="serviceCall">
  <p><img src="../images/all/img-call.png" width="240" height="70" /></p>
</div>
-->
<div class="hotProducts">
  	<h3>嚴選網</h3>
</div>
<div class="image"><a href="" title="零瑕疵女神"><img src="/userfiles/20170803134755231.jpg" width="170" style="border:0px;" alt="零瑕疵女神"></a></div><div class="image"><a href="" title="ig"><img src="/userfiles/20230813115115700.jpg" width="170" style="border:0px;" alt="ig"></a></div><div class="image"><a href="https://line.me/ti/p/dddd0968" title="線上預約"><img src="/userfiles/20230813115009670.jpg" width="170" style="border:0px;" alt="線上預約"></a></div><div class="image"><a href="https://www.youtube.com/channel/UCstcK8pU7W9uqKBWQ3_YScA" title="YouTube"><img src="/userfiles/20230813114029577.jpg" width="170" style="border:0px;" alt="YouTube"></a></div>
            </div>
        </div>
    <?php endif; ?>

    <?php if($slide_no=="3"): ?>
    <div id="sidebar">
        	<div class="navNews">
            	<h3>最新消息選單</h3>
                <ul>
	
        	<li><a href="/news/share" title="【小編體驗文】">【小編體驗文】</a></li>
        
</ul>
<!--<div class="serviceCall"><img src="../images/all/img-call.png" width="240" height="70" /></div>-->
<div class="hotProducts">
  	<h3>嚴選網</h3>
</div>
<div class="image"><a href="" title="零瑕疵女神"><img src="/userfiles/20170803134755231.jpg" width="170" style="border:0px;" alt="零瑕疵女神"></a></div><div class="image"><a href="" title="ig"><img src="/userfiles/20230813115115700.jpg" width="170" style="border:0px;" alt="ig"></a></div><div class="image"><a href="https://line.me/ti/p/dddd0968" title="線上預約"><img src="/userfiles/20230813115009670.jpg" width="170" style="border:0px;" alt="線上預約"></a></div><div class="image"><a href="https://www.youtube.com/channel/UCstcK8pU7W9uqKBWQ3_YScA" title="YouTube"><img src="/userfiles/20230813114029577.jpg" width="170" style="border:0px;" alt="YouTube"></a></div>
            </div>
        </div>
    <?php endif; ?>

	<?php if($slide_no=="4"): ?>
    <div id="sidebar">
        	<div class="navFaq">
            	<h3>問與答選單</h3>
                <ul>
	
        	<li><a href="/news/faq" title="【舉手發問】">【舉手發問】</a></li>
        
</ul>
<!--<div class="serviceCall"><img src="../images/all/img-call.png" width="240" height="70" /></div>-->
<div class="hotProducts">
  	<h3>嚴選網</h3>
</div>
<div class="image"><a href="" title="零瑕疵女神"><img src="/userfiles/20170803134755231.jpg" width="170" style="border:0px;" alt="零瑕疵女神"></a></div><div class="image"><a href="" title="ig"><img src="/userfiles/20230813115115700.jpg" width="170" style="border:0px;" alt="ig"></a></div><div class="image"><a href="https://line.me/ti/p/dddd0968" title="線上預約"><img src="/userfiles/20230813115009670.jpg" width="170" style="border:0px;" alt="線上預約"></a></div><div class="image"><a href="https://www.youtube.com/channel/UCstcK8pU7W9uqKBWQ3_YScA" title="YouTube"><img src="/userfiles/20230813114029577.jpg" width="170" style="border:0px;" alt="YouTube"></a></div>
            </div>
        </div>
    <?php endif; ?>

</div><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/front/inside/side.blade.php ENDPATH**/ ?>