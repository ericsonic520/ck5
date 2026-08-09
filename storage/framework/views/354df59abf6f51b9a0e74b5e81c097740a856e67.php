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
		<div class="image">
			<a href="https://www.facebook.com/profile.php?id=100057390320529" title="藝術家紋繡">
				<img src="/images/present/facebook-icon.png" class="fa-brands fa-facebook" width="170" style="border:0px;" alt="藝術家紋繡">
			</a>
		</div>
		<div class="image">
				<a href="https://www.facebook.com/profile.php?id=100038815970086" title="藝術家紋繡-張明惠老師">
					<img src="/images/present/facebook-icon.png" width="170" style="border:0px;" alt="藝術家紋繡-張明惠老師">
				</a>
			</div>
		<div class="image">
			<a href="" title="ig">
				<img src="/images/present/instagram-icon.png" width="170" style="border:0px;" alt="ig">
			</a>
		</div>
		<div class="image">
			<a href="https://lin.ee/9bluf6g" title="線上預約">
				<img src="/images/present/line-icon.png" width="170" style="border:0px;" alt="線上預約">
			</a>
		</div>
		<div class="image">
			<a href="https://www.youtube.com/watch?v=GWLEk0EBz5U&t=29s" title="YouTube">
				<img src="/images/present/youtube-icon.png" width="170" style="border:0px;" alt="YouTube">
			</a>
		</div>
            </div>
        </div>
    <?php endif; ?>

    <?php if($slide_no=="3"): ?>
    <div id="sidebar">
        <div class="navNews">
			<h3>最新消息選單</h3>
			<ul>
				<li>
					<a href="/news/share" title="【小編體驗文】">【小編體驗文】</a>
				</li>      
			</ul>
			<!--<div class="serviceCall"><img src="../images/all/img-call.png" width="240" height="70" /></div>-->
			<div class="hotProducts">
				<h3>嚴選網</h3>
			</div>
			<div class="image">
				<a href="https://www.facebook.com/profile.php?id=100057390320529" title="藝術家紋繡">
					<img src="/images/present/facebook-icon.png" width="170" style="border:0px;" alt="藝術家紋繡">
				</a>
			</div>
			<div class="image">
				<a href="https://www.facebook.com/profile.php?id=100038815970086" title="藝術家紋繡-張明惠老師">
					<img src="/images/present/facebook-icon.png" width="170" style="border:0px;" alt="藝術家紋繡-張明惠老師">
				</a>
			</div>
			<div class="image">
				<a href="" title="ig">
					<img src="
					" width="170" style="border:0px;" alt="ig">
				</a>
			</div>
			<div class="image">
				<a href="https://lin.ee/9bluf6g" title="線上預約">
					<img src="/images/present/line-icon.png" width="170" style="border:0px;" alt="線上預約">
				</a>
			</div>
			<div class="image">
				<a href="https://www.youtube.com/watch?v=GWLEk0EBz5U&t=29s" title="YouTube">
					<img src="/images/present/youtube-icon.png" width="170" style="border:0px;" alt="YouTube">
				</a>
			</div>
					
		</div>
    </div>
    <?php endif; ?>

	<?php if($slide_no=="4"): ?>
    <div id="sidebar">
		<div class="navFaq">
			<h3>問與答選單</h3>
			<ul>
				<li>
					<a href="/news/faq" title="【舉手發問】">【舉手發問】</a>
				</li>
	
			</ul>
			<!--<div class="serviceCall"><img src="../images/all/img-call.png" width="240" height="70" /></div>-->
			<div class="hotProducts">
				<h3>嚴選網</h3>
			</div>
			<div class="image">
				<a href="https://www.facebook.com/profile.php?id=100057390320529" title="藝術家紋繡">
					<img src="/images/present/facebook-icon.png" width="170" style="border:0px;" alt="藝術家紋繡">
				</a>
			</div>
			<div class="image">
				<a href="https://www.facebook.com/profile.php?id=100038815970086" title="藝術家紋繡-張明惠老師">
					<img src="/images/present/facebook-icon.png" width="170" style="border:0px;" alt="藝術家紋繡-張明惠老師">
				</a>
			</div>
			<div class="image">
				<a href="" title="ig">
					<img src="/images/present/instagram-icon.png" width="170" style="border:0px;" alt="ig">
				</a>
			</div>
			<div class="image">
				<a href="https://lin.ee/9bluf6g" title="線上預約">
					<img src="/images/present/line-icon.png" width="170" style="border:0px;" alt="線上預約">
				</a>
			</div>
			<div class="image">
				<a href="https://www.youtube.com/watch?v=GWLEk0EBz5U&t=29s" title="YouTube">
					<img src="/images/present/youtube-icon.png" width="170" style="border:0px;" alt="YouTube">
				</a>
			</div>
            
		</div>
    </div>
    <?php endif; ?>

</div>
<!-- Social 旋浮組件 -->
<div class="social-widget collapsed" id="socialWidget">
  <!-- 主切換按鈕（旋轉縮放鈕） -->
  <button class="toggle-btn" id="toggleBtn" aria-label="切換社群選單">
    <span class="icon-main">⚙️</span>
  </button>

  <!-- 展開的社交圖示 -->
  <div class="social-icons">
    <a href="https://www.facebook.com/profile.php?id=100038815970086" class="social-icon facebook" title="Facebook"><img src="/images/present/sing_in-facebook.png" style="width:100%;" alt=""></a>
    <a href="https://lin.ee/9bluf6g" class="social-icon line" title="LINE"><img src="/images/present/sing_in-line.png" style="width:100%;" alt=""></a>
    <!-- <a href="#" class="social-icon twitter" title="X">X</a> -->
  </div>
</div>

<style>
/* 容器固定右下角 */
.social-widget {
  position: fixed;
  bottom: 30px;
  right: 30px;
  display: flex;
  flex-direction: column-reverse;
  align-items: center;
  gap: 12px;
  z-index: 9999;
}

/* 主旋轉按鈕樣式 */
.toggle-btn {
  width: 56px;
  height: 56px;
  border-radius: 50%;
  border: none;
  background-color: #007bff;
  color: #fff;
  font-size: 24px;
  cursor: pointer;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.25);
  display: flex;
  align-items: center;
  justify-content: center;
  /* 動畫平滑度 */
  transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), background-color 0.3s ease;
}

.toggle-btn:hover {
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.35);
}

/* 展開狀態：按鈕順時針旋轉 180 度並變色 */
.social-widget.expanded .toggle-btn {
  transform: rotate(180deg) scale(1.05);
  background-color: #333333;
}

/* 社交圖示容器與動畫 */
.social-icons {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.social-icon {
  width: 46px;
  height: 46px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  text-decoration: none;
  font-weight: bold;
  font-size: 13px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
  /* 縮放 + 旋轉動畫 */
  transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55), opacity 0.3s ease;
  transform-origin: center center;
}

/* 個別圖示 hover 放大 */
.social-icon:hover {
  transform: scale(1.15) !important;
}

/* 縮放（收合）狀態：圖示變小、透明並旋轉隱藏 */
.social-widget.collapsed .social-icon {
  opacity: 0;
  transform: scale(0) rotate(-90deg);
  pointer-events: none;
}

/* 個別延遲動畫：產生階梯式（Staggered）彈出效果 */
.social-widget.expanded .social-icon:nth-child(1) { transition-delay: 0.05s; }
.social-widget.expanded .social-icon:nth-child(2) { transition-delay: 0.1s; }
.social-widget.expanded .social-icon:nth-child(3) { transition-delay: 0.15s; }

/* 品牌背景色 */
.facebook { background-color: #1877F2; }
.line { background-color: #00B900; }
.twitter { background-color: #000000; }
</style>

<script>
const widget = document.getElementById('socialWidget');
const toggleBtn = document.getElementById('toggleBtn');

toggleBtn.addEventListener('click', (e) => {
  e.stopPropagation();
  widget.classList.toggle('collapsed');
  widget.classList.toggle('expanded');
});

// 點擊頁面其他地方自動縮放收合
document.addEventListener('click', () => {
  if (widget.classList.contains('expanded')) {
    widget.classList.remove('expanded');
    widget.classList.add('collapsed');
  }
});
</script><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/front/inside/side.blade.php ENDPATH**/ ?>