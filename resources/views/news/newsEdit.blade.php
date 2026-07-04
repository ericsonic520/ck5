<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為 title -->
@section('title', $title)

<!-- 傳送資料到母模板，並指定變數為 content -->
@section('content')
<link href="/summernote/summernote.min.css" rel="stylesheet">
    <script src="/summernote/summernote.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<div class="container">
	<!-- <h1>{{ $title }}</h1> -->

	{{-- 錯誤訊息模板元件 --}}
	@include('components.validationErrorMessage')
	<div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">
              <a href="/news"><button type="button" class="btn btn-primary" title="返回上一頁"><i class="fas fa-solid fa-arrow-left"></i></button></a>
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
            <form action="/upd_data/{{$news_id}}" method="post" enctype="multipart/form-data">

              {{-- 隱藏方法欄位 --}}
              {{ method_field('PUT') }}

              <div class="container">
                <div class="form-group col-md-3">
                    <label for="post_title">標題:</label>
                    <input class="form-control" type="text" name="post_title" value="{{ old('post_title', $News[0]->post_title) }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="post_sort">分類:</label>
                    <select class="form-control" name="post_sort" id="post_sort">
                      @foreach($Sorts as $sort)
                        <option value="{{ $sort->sort_id }}" @if(old('$sort->sort_id', $News[0]->sort_id) == $sort->sort_id ) selected @endif >{{ $sort->sort_name }}</option>
                      @endforeach  
                    </select>
                </div>
                
                <textarea id="summernote" name="post_description">{!! $News[0]->post_description !!}</textarea>
                <input id="post_id" class="form-control" type="hidden" name="post_id" placeholder="..." value="{{ old('id', $News[0]->post_id) }}">
              </div>
          
            <button type="submit" class="btn btn-success">更新</button>
            {{-- CSRF 欄位 --}}
            {{ csrf_field() }}
          </form>
        </div>
        <script type="text/javascript">
                $(document).ready(function() {
                    $('#summernote').summernote({
                        styleTags: [
            'p',
                { title: 'Blockquote', tag: 'blockquote', className: 'blockquote', value: 'blockquote' },
                'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
            ],
        
                        // fontNames: ['Arial', 'Arial Black'],
                        // lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0'],
                        height: 400,
                        toolbar: [
                            // [groupName, [list of button]]
                            ['style', ['style','bold', 'italic', 'underline', 'clear']],
                            ['fontname', ['fontname']],
                            // ['font', ['strikethrough', 'superscript', 'subscript']],
                            ['fontsize', ['fontsize']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['table', ['table']],
                            ['insert', ['link', 'picture', 'video']],
                            ['view', ['fullscreen', 'codeview', 'help']],
                            ['height', ['height']]
                        ]
                    })
                });
            </script>
          <!-- /.card-body -->
          <!-- <div class="card-footer">
            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
            the plugin.
          </div> -->
    </div>

</div>
@endsection