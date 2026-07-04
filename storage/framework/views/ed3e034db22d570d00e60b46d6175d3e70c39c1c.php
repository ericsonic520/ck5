<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo $__env->yieldContent('title'); ?> - 零瑕疵紋繡-妊娠紋、肥胖紋、討厭的疤痕通通消失了！醫生推薦 口碑最高</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="<?php echo e(URL::asset('plugins/fontawesome-free/css/all.min.css')); ?>">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<!-- Tempusdominus Bbootstrap 4 -->
		<link rel="stylesheet" href="<?php echo e(URL::asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
		<!-- iCheck -->
		<link rel="stylesheet" href="<?php echo e(URL::asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
		<!-- JQVMap -->
		<link rel="stylesheet" href="<?php echo e(URL::asset('plugins/jqvmap/jqvmap.min.css')); ?>">
		<!-- Theme style -->
		<link rel="stylesheet" href="<?php echo e(URL::asset('dist/css/adminlte.min.css')); ?>">
		<!-- overlayScrollbars -->
		<link rel="stylesheet" href="<?php echo e(URL::asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
		<!-- Daterange picker -->
		<link rel="stylesheet" href="<?php echo e(URL::asset('plugins/daterangepicker/daterangepicker.css')); ?>">
		<!-- summernote -->
		<link rel="stylesheet" href="<?php echo e(URL::asset('plugins/summernote/summernote-bs4.css')); ?>">
		<!-- Google Font: Source Sans Pro -->
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

		<!-- bootstrap-datepicker -->
		<script type="text/javascript" src="<?php echo e(URL::asset('/plugins/bootstrap-datetimepicker-master/jquery.min.js')); ?>"></script>
		<script type="text/javascript" src="<?php echo e(URL::asset('/plugins/bootstrap-datetimepicker-master/bootstrap.js')); ?>"></script>
		<script type="text/javascript" src="<?php echo e(URL::asset('/plugins/bootstrap-datetimepicker-master/bootstrap-datepicker.js')); ?>"></script>
		<script src="<?php echo e(URL::asset('/plugins/bootstrap-datetimepicker-master/bootstrap-datepicker.zh-TW.js')); ?>"></script> 
		<link rel="stylesheet" href="<?php echo e(URL::asset('/plugins/bootstrap-datetimepicker-master/bootstrap-datepicker3.min.css')); ?>" />
		<!-- bootstrap-datepicker -->
		<!--引用Pace.js-->
		<script src="<?php echo e(URL::asset('~/Content/pace.js')); ?>"></script>
		<link href="<?php echo e(URL::asset('~/Content/themes/blue/pace-theme-flash.css')); ?>" rel="stylesheet" /> 
	  	 
		<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	</head>
	<body class="hold-transition sidebar-mini layout-fixed">
		<div class="wrapper">

			<!-- Navbar -->
			<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
				<!-- Left navbar links -->
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
					</li>
					<li class="nav-item d-none d-sm-inline-block">
						<a href="/" class="nav-link">Home</a>
					</li>
					<ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <?php if(auth()->guard()->guest()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('login')); ?>"><i class="nav-icon fas fa-sign-in-alt"></i><?php echo e(__('登入')); ?></a>
                            </li>
                            <?php if(Route::has('register')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('register')); ?>"><i class="nav-icon fas fa-user-plus"></i><?php echo e(__('註冊')); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-school"></i>
					      			課程管理
		                            <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/class">
                                        <i class="fas fa-list-alt"></i>
		      							課程列表
                                    </a>
                                   	<?php if(Auth::user()->type=='A'): ?>
                                    <a class="dropdown-item" href="/class/add">
                                        <i class="fas fa-book-medical"></i>
		      							新增課程
                                    </a>
                                    <a class="dropdown-item" href="/class/manage">
                                        <i class="fas fa-clipboard-list"></i>
		      							管理課程
                                    </a>
                                    <?php else: ?>
                                    <?php endif; ?>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </div>
                            </li>
							<li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-school"></i>
					      			新聞管理
		                            <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/class">
                                        <i class="fas fa-list-alt"></i>
		      							新聞列表
                                    </a>
                                   	<?php if(Auth::user()->type=='A'): ?>
                                    <a class="dropdown-item" href="/class/add">
                                        <i class="fas fa-book-medical"></i>
		      							新增新聞
                                    </a>
                                    <a class="dropdown-item" href="/class/manage">
                                        <i class="fas fa-clipboard-list"></i>
		      							管理新聞
                                    </a>
                                    <?php else: ?>
                                    <?php endif; ?>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
				</ul>
				
				<!-- Right navbar links -->
				<ul class="navbar-nav ml-auto">
					<!-- Sidebar user panel (optional) -->					
				<div class="info">
					
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <?php if(auth()->guard()->guest()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('login')); ?>"><i class="nav-icon fas fa-sign-in-alt"></i><?php echo e(__('登入')); ?></a>
                            </li>
                            <?php if(Route::has('register')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('register')); ?>"><i class="nav-icon fas fa-user-plus"></i><?php echo e(__('註冊')); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <?php echo e(Auth::user()->name); ?> 
                                    <?php if(Auth::user()->type=='A'): ?>
		                            	(系統管理者)
		                            <?php else: ?>
		                            	(一般使用者)
		                            <?php endif; ?>
		                            <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="nav-icon fas fa-sign-out-alt"></i><?php echo e(__('登出')); ?>

                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
				
				</div>
				</ul>
			</nav>
			<!-- /.navbar -->

			<!-- Main Sidebar Container -->
			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<!-- Brand Logo -->
				<a href="/class" class="brand-link">
					<img src="<?php echo e(URL::asset('dist/img/AdminLTELogo.png')); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
					style="opacity: .8">
					<span class="brand-text font-weight-light">藝術家紋繡</span>
				</a>

				<!-- Sidebar -->
				<div class="sidebar">

					<!-- Sidebar Menu -->
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<!-- Add icons to the links using the .nav-icon class
							with font-awesome or any other icon font library -->
							<li class="nav-item has-treeview menu-open">
								<a href="#" class="nav-link">
									<i class="fas fa-users"></i>
									<p>
										會員在線
										<i class="right fas fa-angle-left"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<?php if(auth()->guard()->guest()): ?>
											<li class="nav-item">
												<a class="nav-link" href="<?php echo e(route('login')); ?>"><i class="fas fa-sign-in-alt"></i><?php echo e(__('登入')); ?></a>
											</li>
											<?php if(Route::has('register')): ?>
												<li class="nav-item">
													<a class="nav-link" href="<?php echo e(route('register')); ?>"><i class="fas fa-user-plus"></i><?php echo e(__('註冊')); ?></a>
												</li>
											<?php endif; ?>
										<?php else: ?>
											<li class="nav-item dropdown">
												<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
													<?php echo e(Auth::user()->name); ?>

													<?php if(Auth::user()->type=='A'): ?>
														(系統管理者)
													<?php else: ?>
														(一般使用者)
													<?php endif; ?>
													<span class="caret"></span>
												</a>

												<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
													<a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
													onclick="event.preventDefault();
																	document.getElementById('logout-form').submit();">
														<i class="fas fa-sign-out-alt"></i><?php echo e(__('登出')); ?>

													</a>

													<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
														<?php echo csrf_field(); ?>
													</form>
												</div>
											</li>
										<?php endif; ?>
									
								</ul>
							</li>
							<li class="nav-item has-treeview menu-open">
								<a href="#" class="nav-link">
									<i class="fas fa-school"></i>
									<p>
										會員管理
										<i class="right fas fa-angle-left"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<?php if(auth()->guard()->guest()): ?>
										<li class="nav-item">
											<a href="/user/" class="nav-link">
												
												<i class="fas fa-list-alt"></i>
												<p>會員列表</p>
											</a>
										</li> 
									<?php else: ?>
										<?php if(Auth::user()->type=='A'): ?>
										<li class="nav-item">
											<a href="/user/" class="nav-link">
												
												<i class="fas fa-list-alt"></i>
												<p>會員列表</p>
											</a>
										</li>
										<?php else: ?>
										<li class="nav-item">
											<a href="/user/" class="nav-link">
												
												<i class="fas fa-list-alt"></i>
												<p>我的資料</p>
											</a>
										</li>
										<?php endif; ?>
									<?php endif; ?>	      			
								</ul>
							</li>
							<li class="nav-item has-treeview menu-open">
								<a href="#" class="nav-link">
									<i class="fas fa-school"></i>
									<p>
										網站管理
										<i class="right fas fa-angle-left"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<?php if(auth()->guard()->guest()): ?>
										<!-- <li class="nav-item">
											<a href="/news/" class="nav-link">
												
												<i class="fas fa-list-alt"></i>
												<p>新聞列表</p>
											</a>
										</li>  -->
									<?php else: ?>
										<!-- <li class="nav-item">
											<a href="/news/" class="nav-link">
												
												<i class="fas fa-list-alt"></i>
												<p>新聞列表</p>
											</a>
										</li> -->
										<?php if(Auth::user()->type=='A'): ?>
											<!-- <li class="nav-item">
												<a href="/news/add" class="nav-link">
													
													<i class="fas fa-book-medical"></i>
													<p>新增新聞</p>
												</a>
											</li> -->
											<li class="nav-item">
												<a href="/site/manage" class="nav-link">
													
													<i class="fas fa-clipboard-list"></i>
													<p>管理網站</p>
												</a>
											</li>
										<?php else: ?>
											<li class="nav-item">
												<a href="/site/manage" class="nav-link">
													
													<i class="fas fa-clipboard-list"></i>
													<p>管理網站</p>
												</a>
											</li>
										<?php endif; ?>
									<?php endif; ?>	      			
								</ul>
							</li>
							<li class="nav-item has-treeview menu-open">
								<a href="#" class="nav-link">
									<i class="fas fa-school"></i>
									<p>
										履歷管理
										<i class="right fas fa-angle-left"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<?php if(auth()->guard()->guest()): ?>
										
									<?php else: ?>
										<?php if(Auth::user()->type=='A'): ?>
											<li class="nav-item">
												<a href="/present/add" class="nav-link">
													
													<i class="fas fa-book-medical"></i>
													<p>新增履歷</p>
												</a>
											</li>
											<li class="nav-item">
												<a href="/present/manage" class="nav-link">
													
													<i class="fas fa-clipboard-list"></i>
													<p>管理履歷</p>
												</a>
											</li>
										<?php else: ?>
											<li class="nav-item">
												<a href="/present/manage" class="nav-link">
													
													<i class="fas fa-clipboard-list"></i>
													<p>管理履歷</p>
												</a>
											</li>
										<?php endif; ?>
									<?php endif; ?>	          			
								</ul>
							</li>
							<li class="nav-item has-treeview menu-open">
								<a href="#" class="nav-link">
									<i class="fas fa-school"></i>
									<p>
										課程管理
										<i class="right fas fa-angle-left"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<?php if(auth()->guard()->guest()): ?>
										<li class="nav-item">
											<a href="/class/" class="nav-link">
												
												<i class="fas fa-list-alt"></i>
												<p>課程列表</p>
											</a>
										</li> 
									<?php else: ?>
										<li class="nav-item">
											<a href="/class/" class="nav-link">
												
												<i class="fas fa-list-alt"></i>
												<p>課程列表</p>
											</a>
										</li>
										<?php if(Auth::user()->type=='A'): ?>
											<li class="nav-item">
												<a href="/class/add" class="nav-link">
													
													<i class="fas fa-book-medical"></i>
													<p>新增課程</p>
												</a>
											</li>
											<li class="nav-item">
												<a href="/class/manage" class="nav-link">
													
													<i class="fas fa-clipboard-list"></i>
													<p>管理課程</p>
												</a>
											</li>
										<?php else: ?>
											<li class="nav-item">
												<a href="/class/manage" class="nav-link">
													
													<i class="fas fa-clipboard-list"></i>
													<p>管理課程</p>
												</a>
											</li>
										<?php endif; ?>
									<?php endif; ?>	      			
								</ul>
							</li>
							<li class="nav-item has-treeview menu-open">
								<a href="#" class="nav-link">
									<i class="fas fa-school"></i>
									<p>
										新聞管理
										<i class="right fas fa-angle-left"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<?php if(auth()->guard()->guest()): ?>
										<li class="nav-item">
											<a href="/news/" class="nav-link">
												
												<i class="fas fa-list-alt"></i>
												<p>新聞列表</p>
											</a>
										</li> 
									<?php else: ?>
										<li class="nav-item">
											<a href="/news/" class="nav-link">
												
												<i class="fas fa-list-alt"></i>
												<p>新聞列表</p>
											</a>
										</li>
										<?php if(Auth::user()->type=='A'): ?>
											<!-- <li class="nav-item">
												<a href="/news/add" class="nav-link">
													
													<i class="fas fa-book-medical"></i>
													<p>新增新聞</p>
												</a>
											</li>
											<li class="nav-item">
												<a href="/news/manage" class="nav-link">
													
													<i class="fas fa-clipboard-list"></i>
													<p>管理新聞</p>
												</a>
											</li> -->
											<!-- <li class="nav-item">
												<a href="/news/addsort" class="nav-link">
													
													<i class="fas fa-book-medical"></i>
													<p>新增類別</p>
												</a>
											</li> -->
											<li class="nav-item">
												<a href="/news/managesort" class="nav-link">
													
													<i class="fas fa-clipboard-list"></i>
													<p>管理類別</p>
												</a>
											</li>
											<!-- <li class="nav-item">
												<a href="/news/addbreadcrumbs" class="nav-link">
													
													<i class="fas fa-book-medical"></i>
													<p>新增麵包屑</p>
												</a>
											</li> -->
											<li class="nav-item">
												<a href="/news/managebreadcrumbs" class="nav-link">
													
													<i class="fas fa-clipboard-list"></i>
													<p>管理麵包屑</p>
												</a>
											</li>
											<!-- <li class="nav-item">
												<a href="/news/addMenu" class="nav-link">
													
													<i class="fas fa-book-medical"></i>
													<p>新增選單</p>
												</a>
											</li> -->
											<li class="nav-item">
												<a href="/news/manageMenu" class="nav-link">
													
													<i class="fas fa-clipboard-list"></i>
													<p>管理選單</p>
												</a>
											</li>
											
										<?php else: ?>
											<li class="nav-item">
												<a href="/news/managebreadcrumbs" class="nav-link">
													
													<i class="fas fa-clipboard-list"></i>
													<p>管理麵包屑</p>
												</a>
											</li>
										<?php endif; ?>
									<?php endif; ?>	      			
								</ul>
							</li>
						</ul>
					</nav>
					<!-- /.sidebar-menu -->
				</div>
				<!-- /.sidebar -->
			</aside>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<div class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1 class="m-0 text-dark"><?php echo e($title); ?></h1>
							</div><!-- /.col -->
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active"><?php echo e($title); ?></li>
								</ol>
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.container-fluid -->
				</div>
				<!-- /.content-header -->

				<!-- Main content -->
				<section class="content">
					<div class="container-fluid">
						<?php echo $__env->yieldContent('content'); ?>
					</div><!-- /.container-fluid -->
				</section>
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->
			<footer class="main-footer">
				<strong>Copyright &copy; <?php echo '20'.date('y')?> <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
				All rights reserved.
				<div class="float-right d-none d-sm-inline-block">
					<b>Version</b> 3.0.0-beta.1
				</div>
			</footer>

			<!-- Control Sidebar -->
			<aside class="control-sidebar control-sidebar-dark">
				<!-- Control sidebar content goes here -->
			</aside>
			<!-- /.control-sidebar -->
		</div>
		<!-- ./wrapper -->

<!-- jQuery -->
<!-- <script src="<?php echo e(URL::asset('plugins/jquery/jquery.min.js')); ?>"></script> -->
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(URL::asset('plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- ChartJS -->
<script src="<?php echo e(URL::asset('plugins/chart.js/Chart.min.js')); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo e(URL::asset('plugins/sparklines/sparkline.js')); ?>"></script>
<!-- JQVMap -->
<script src="<?php echo e(URL::asset('plugins/jqvmap/jquery.vmap.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/jqvmap/maps/jquery.vmap.world.js')); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo e(URL::asset('plugins/jquery-knob/jquery.knob.min.js')); ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo e(URL::asset('plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo e(URL::asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>
<!-- Summernote -->
<script src="<?php echo e(URL::asset('plugins/summernote/summernote-bs4.min.js')); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo e(URL::asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
<!-- FastClick -->
<script src="<?php echo e(URL::asset('plugins/fastclick/fastclick.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(URL::asset('dist/js/adminlte.js')); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo e(URL::asset('dist/js/pages/dashboard.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(URL::asset('dist/js/demo.js')); ?>"></script>
<!-- <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> -->
<script type="text/javascript" src="<?php echo e(URL::asset('plugins/TWzipcode/twzipcode-1.4.1.js')); ?>"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo e(URL::asset('plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/jszip/jszip.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/pdfmake/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/pdfmake/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/datatables-buttons/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/datatables-buttons/js/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/datatables-buttons/js/buttons.colVis.min.js')); ?>"></script>
</body>
</html>
<?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/layout/master_for_add.blade.php ENDPATH**/ ?>