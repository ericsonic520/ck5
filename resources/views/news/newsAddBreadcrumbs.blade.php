<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為 title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為 content -->
@section('content')
<link href="/summernote/summernote.min.css" rel="stylesheet">
    <script src="/summernote/summernote.min.js"></script>
<div class="container">
	<!-- <h1>{{ $title }}</h1> -->

	{{-- 錯誤訊息模板元件 --}}
	@include('components.validationErrorMessage')
	<div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
                <a href="/news/managebreadcrumbs"><button type="button" class="btn btn-primary" title="返回上一頁"><i class="fas fa-solid fa-arrow-left"></i></button></a>
                <button type="button" class="btn btn-warning" title="{{ $title }}">{{ $title }}</button>
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
            <form action="{{'/news/addbreadcrumbsdeal'}}" method="post">
                {{-- CSRF 欄位 --}}
				{{ csrf_field() }}
                {{-- 隱藏方法欄位 --}}
                {{ method_field('PUT') }}
                <div class="container">
                    <div class="form-group col-md-3">
                        <label for="breadcrumb_name">麵包屑名稱:</label>
                        <input class="form-control" type="text" name="breadcrumb_name">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="breadcrumb_name_en">麵包屑名稱(英文):</label>
                        <input class="form-control" type="text" name="breadcrumb_name_en">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="breadcrumb_api">麵包屑API:</label>
                        <input class="form-control" type="text" name="breadcrumb_api">
                    </div>
                    <input type="hidden" name="breadcrumb_disaplay" value="1" class="Btn btn-primary">
                    <button type="submit" class="btn btn-primary">新增</button>
                </div>
            </form>
		</div>
    </div>

</div>
@endsection