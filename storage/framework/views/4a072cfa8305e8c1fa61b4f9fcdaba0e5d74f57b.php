<!-- 指定繼承 layout.master 母模板 -->


<!-- 傳送資料到母模板，並指定變數為 title -->
<?php $__env->startSection('title', $title); ?>

<!-- 傳送資料到母模板，並指定變數為 content -->
<?php $__env->startSection('content'); ?>
<link href="/summernote/summernote.min.css" rel="stylesheet">
    <script src="/summernote/summernote.min.js"></script>
<div class="container">
	<!-- <h1><?php echo e($title); ?></h1> -->

	
	<?php echo $__env->make('components.validationErrorMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
                <a href="/news/carouselManage"><button type="button" class="btn btn-primary" title="返回上一頁"><i class="fas fa-solid fa-arrow-left"></i></button></a>
                <button type="button" class="btn btn-info" title="<?php echo e($title); ?>"><?php echo e($title); ?></button>
            </h3>
                

            <div class="card-tools">
	          <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
	            <i class="fas fa-minus"></i></button>
	          <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
	            <i class="fas fa-times"></i></button>
	        </div> 
        </div>
          <!-- /.card-header -->
        <div class="card-body">
            <form action="<?php echo e('/news/addcarouseldeal'); ?>" method="post" enctype="multipart/form-data">
                
				<?php echo e(csrf_field()); ?>

                
                <?php echo e(method_field('PUT')); ?>

                <div class="container">
                    <div class="form-group col-md-3">
                        <label for="carousel_title">輪播名稱:</label>
                        <input class="form-control" type="text" name="carousel_title">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="carousel_description">輪播介紹:</label>
                        <input class="form-control" type="text" name="carousel_description">
                    </div>
                    <div class="form-group col-md-6">
                        <label>輪播圖片:</label>
                        
                        <!-- 1. 預設加上 display: none;，有圖片才顯示 -->
                        <div id="preview_container" class="mb-2" style="display: none;">
                            <img id="image_preview" alt="輪播圖片" style="width: 100%;">
                        </div>
                        
                        <!-- 2. 隱藏的原生上傳 input -->
                        <input id="carousel_image" type="file" name="carousel_image" accept="image/*" class="d-none" onchange="previewImage(event)">

                        <!-- 3. 按鈕與檔名顯示 -->
                        <div class="d-flex align-items-center">
                            <label for="carousel_image" class="btn btn-primary mb-0 mr-2 me-2">選擇圖片</label>
                            <span id="file_name" class="text-muted text-truncate" style="max-width: 180px;">尚未選擇檔案</span>
                        </div>
                    </div>

                    <input type="hidden" name="carousel_display" value="1" class="Btn btn-primary">
                    <input type="hidden" name="carousel_range" value="1" class="Btn btn-primary">
                    <button type="submit" class="btn btn-primary">新增</button>
                    
                </div>
            </form>
		</div>
    </div>

</div>
<script>
function previewImage(event) {
    const input = event.target;
    const previewContainer = document.getElementById('preview_container');
    const previewImg = document.getElementById('image_preview');
    const fileNameSpan = document.getElementById('file_name');
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        // 釋放記憶體
        if (previewImg.src.startsWith('blob:')) {
            URL.revokeObjectURL(previewImg.src);
        }
        
        // 設定圖片路徑
        previewImg.src = URL.createObjectURL(file);
        
        // 有選擇圖片才顯示外層容器
        previewContainer.style.display = 'block';
        
        // 更新檔名
        fileNameSpan.textContent = file.name;
    } else {
        // 沒有選擇圖片（或取消選擇）時隱藏容器
        previewContainer.style.display = 'none';
        previewImg.src = '';
        fileNameSpan.textContent = '尚未選擇檔案';
    }
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ericsonic520\Desktop\res\ck5\resources\views/news/newsAddCarousel.blade.php ENDPATH**/ ?>