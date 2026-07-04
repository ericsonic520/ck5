@extends('layout.master')
@section('title', $title)
@section('content')
<div class="container">
	<!-- <h1>{{ $title }}</h1> -->

	{{-- 錯誤訊息模板元件 --}}
	@include('components.validationErrorMessage')
		<div class="card">
      <div class="card-header">
        <h3 class="card-title">
        	{{ $title }}
        	<a href="/class/export">
				<button class="btn btn-primary"><i class="fas fa-file-export"></i></button>
			</a>
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
        <table class="table table-bordered">
        	<tbody class="text-center">
        	<tr>
				<th>ID</th>
				<th style="width:8%">名稱</th>
				<th>相關圖片</th>
				@if(Auth::user()->type=='A')
				<th style="width:10%">顯示</th>
				@endif
				<th>日期</th>
				<th style="width:10%">地點</th>
				<!-- <th style="width:7%">課程介紹</th> -->
				<th style="width:8%">名額</th>
				<th style="width:20%">操作</th>
			</tr>
      		@foreach($CoursePaginate as $Course)
			<tr>
				@if($Course->status == 'R' && Auth::user()->type=='G')
				@else
				<td>{{ $Course->id }}</td>
				<td>@if($Course->category=='C')
						{{ $Course->name }}
					@endif
					@if($Course->category=='E')
						{{ $Course->name }}
					@endif
					@if($Course->category=='M')
						{{ $Course->name }}
					@endif
				</td>
				<td>
					@if(!is_null($Course->pic))
					<img src="{{ $Course->pic }}">
					@endif
					@if(is_null($Course->pic))
					<img src="{{ '/images/class/5d109e473d17b.jpg' }}">
					@endif
				</td>
				@if(Auth::user()->type=='A')
				<td>
					@if($Course->status == 'R')
					<span class="label label-default" style="border-radius: 3px;padding: 5px;">
						隱藏
					</span>
					@else
					<span class="label label-success" style="border-radius: 3px;padding: 5px;">
						顯示
					</span>
					@endif
				</td>
				@endif
				<td>{{ $Course->class_date }}<br>{{ $Course->class_start_time }}~{{ $Course->class_end_time }}</td>
				<td>{{ $Course->county }}{{ $Course->district }}{{ $Course->addr }}{{ $Course->zipcode }}</td>
				<!-- <td>{{ $Course->content }}</td> -->
				<td>{{ $Course->quota }}</td>
				<td>
					@guest
					@else 
						@if(Auth::user()->type=='A')
							<a href="/class/{{ $Course->id }}/export">
								<button class="btn btn-primary"><i class="fas fa-file-export"></i></button>
							</a>
							<a href="/class/{{ $Course->id }}/edit">
								<button class="btn btn-primary"><i class="fas fa-edit"></i></button>
							</a>
							<a href="/class/{{ $Course->id }}/list">
								<button class="btn btn-success"><i class="fas fa-list-ul"></i></button>
							</a>
							<!--<a href="/warning">
								<button class="btn btn-success"><i class="far fa-paper-plane"></i></button>
							</a>-->
							<a href="/class/{{ $Course->id }}/del" onclick="javascript:return del();">
								<button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
							</a>
						@else
							<a href="/class/{{ $Course->id }}/export">
								<button class="btn btn-primary"><i class="fas fa-file-export"></i></button>
							</a>
							<a href="/class/{{ $Course->id }}/list">
								<button class="btn btn-success"><i class="fas fa-list-ul"></i></button>
							</a>
						@endif
					@endguest	
				</td>
				@endif
			</tr>
			@endforeach
			</tbody>
		    </table>
		    {{-- 分頁頁數按鈕 --}}
			{{ $CoursePaginate->links() }}
      </div>
		</div>
	</div>
	<script language="javascript">  
		function del() {
			var msg = "您真的確定要刪除嗎？\n\n請確認！";
			if (confirm(msg)==true){
				return true;
			}else{
				return false;
			}
		}
	</script>  
@endsection