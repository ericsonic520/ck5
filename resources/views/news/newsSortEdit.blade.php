<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為 title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為 content -->
@section('content')
<div class="container">
	<!-- <h1>{{ $title }}</h1> -->

	{{-- 錯誤訊息模板元件 --}}
	@include('components.validationErrorMessage')
	<div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
              <a href="/news/managesort"><button type="button" class="btn btn-primary" title="返回上一頁"><i class="fas fa-solid fa-arrow-left"></i></button></a>
              <button type="button" class="btn btn-info" title="{{ $title }}">{{ $title }}</button>
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
            <form action="/news/{{$sort_id}}/sortEditDeal" method="post" enctype="multipart/form-data">

              {{-- 隱藏方法欄位 --}}
              {{ method_field('PUT') }}

              <div class="container">
                <div class="form-group col-md-3">
                    <label for="sort_name">類別名稱:</label>
                    <input class="form-control" type="text" name="sort_name" value="{{ old('sort_name', $SortPaginate[0]->sort_name) }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="sort_enname">類別名稱(英文):</label>
                    <input class="form-control" type="text" name="sort_name_en" value="{{ old('sort_name_en', $SortPaginate[0]->sort_name_en) }}">
                </div>
              </div>
          
            <button type="submit" class="btn btn-success">更新</button>
            {{-- CSRF 欄位 --}}
            {{ csrf_field() }}
          </form>
        </div>
        
          <!-- /.card-body -->
          <!-- <div class="card-footer">
            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
            the plugin.
          </div> -->
    </div>

</div>
@endsection