<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為 title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為 content -->
@section('content')
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<div class="container">
	<!-- <h1>{{ $title }}</h1> -->

	{{-- 錯誤訊息模板元件 --}}
	@include('components.validationErrorMessage')
	<div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
              <a href="/news/carouselManage"><button type="button" class="btn btn-primary" title="返回上一頁"><i class="fas fa-solid fa-arrow-left"></i></button></a>
              <button type="button" class="btn btn-primary" title="{{ $title }}">{{ $title }}</button>
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
            <form action="/news/{{$Carousel_id}}/carouselEditDeal" method="post" enctype="multipart/form-data">

              {{-- 隱藏方法欄位 --}} 
              {{ method_field('PUT') }}

              <div class="container">
                <div class="form-group col-md-3">
                    <label for="carousel_title">輪播名稱:</label>
                    <input class="form-control" type="text" name="carousel_title" value="{{ old('carousel_title', $Carousels[0]->carousel_title) }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="carousel_description">輪播說明:</label>
                    <input class="form-control" type="text" name="carousel_description" value="{{ old('carousel_description', $Carousels[0]->carousel_description) }}">
                </div>
                <div class="form-group col-md-6">
                    <label>輪播圖片:</label>
                    
                    <!-- 1. 圖片預覽區域 -->
                    <div class="mb-2">
                        <img id="image_preview" src="/.{{ old('carousel_image', $Carousels[0]->carousel_image) }}" alt="輪播圖片" style="width: 100%;">
                    </div>
                    
                    <!-- 2. 將預設 input 隱藏 (d-none) -->
                    <input id="carousel_image" type="file" name="carousel_image" accept="image/*" class="d-none" onchange="previewImage(event)">

                    <!-- 3. 自訂上傳按鈕與顯示名稱的 UI (以 Bootstrap 4/5 佈局) -->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <!-- 透過 for="carousel_image" 點擊此 label 即可觸發檔案選擇 -->
                            <label for="carousel_image" class="btn btn-primary mb-0">選擇圖片</label>
                        </div>
                        
                        <!-- 獨立顯示檔名的框 -->
                        <input type="text" id="file_name" class="form-control" readonly placeholder="尚未選擇檔案" value="{{ old('carousel_image', basename($Carousels[0]->carousel_image)) }}">
                    </div>
                </div>
                <input id="carousel_id" class="form-control" type="hidden" name="carousel_id" placeholder="..." value="{{ old('carousel_id', $Carousels[0]->carousel_id) }}">
              </div>
          
            <button type="submit" class="btn btn-success">更新</button>
            {{-- CSRF 欄位 --}}
            {{ csrf_field() }}
          </form>
        </div>
        
    </div>

</div>
<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('image_preview');
    const fileNameInput = document.getElementById('file_name');
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        // 釋放舊的記憶體（可避免記憶體洩漏）
        if (preview.src.startsWith('blob:')) {
            URL.revokeObjectURL(preview.src);
        }
        
        // 瞬間產生本地blob預覽網址
        preview.src = URL.createObjectURL(file);
        
        // 更新檔名
        fileNameInput.value = file.name;
    }
}
</script>
@endsection