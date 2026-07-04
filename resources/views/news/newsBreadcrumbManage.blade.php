@extends('layout.master')
@section('title', $title)
@section('content')

<div class="container">
	<!-- <h1>{{ $title }}</h1> -->

	{{-- 錯誤訊息模板元件 --}}
	@include('components.validationErrorMessage')
		<div class="card">
			<div class="card-header">
				<!-- <h3 class="card-title">{{ $title }}</h3> -->
				<a href="/news"><button type="button" class="btn btn-primary" title="返回上一頁"><i class="fas fa-solid fa-arrow-left"></i></button></a>
                <a href="/news/addbreadcrumbs"><button class="btn btn-success" title="新增麵包屑"><i class="fas fa-solid fa-plus"></i></button></a>
				<button type="button" class="btn btn-warning" title="{{ $title }}">{{ $title }}</button>
				
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fas fa-times"></i></button>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table class="table table-bordered">
					<tbody class="text-center">
						<tr>
						<th>ID</th>
						<th>麵包屑名稱</th>
						<th>麵包屑名稱(英文)</th>
						<th>麵包屑API</th>
						<th>是否檢視</th>
						<th>操作</th>
						</tr>
						@foreach($BreadcrumbPaginate as $key => $breadcrumb)
						<tr>
							<td>{{ $breadcrumb->breadcrumb_id  }}</td>
							<td>{{ $breadcrumb->breadcrumb_name }}</td>
							<td>{{ $breadcrumb->breadcrumb_name_en }}</td>
							<td>{{ $breadcrumb->breadcrumb_api }}</td>
							<td>
								<form action="/news/{{ $breadcrumb->breadcrumb_id }}/chgbreadcrumbdis" enctype="multipart/form-data">
									@if($breadcrumb->breadcrumb_display=='1')
									<button method="submit" class="btn btn-success" title="顯示"><i class="far fa-eye"></i></button>
									@endif
									@if($breadcrumb->breadcrumb_display=='0')
									<button method="submit" class="btn btn-warning" title="隱藏"><i class="fas fa-solid fa-eye-slash"></i></button>
									@endif
									<input type="hidden" name="breadcrumb_display" value="{{$breadcrumb->breadcrumb_display}}">
								</form> 
							</td>
							<td>
								@guest
								@else 
									@if(Auth::user()->type=='A')
										<!-- <a href="/news/{{ $breadcrumb->breadcrumb_id }}/itm">
											<button class="btn btn-success"><i class="far fa-eye"></i></button>
										</a> -->
										<a href="/news/{{ $breadcrumb->breadcrumb_id }}/breadcrumbEdit">
											<button class="btn btn-primary" title="更新內容"><i class="fas fa-edit"></i></button>
										</a>
										<!--<a href="/warning">
										<button class="btn btn-success"><i class="far fa-paper-plane"></i></button>
										</a>-->
										<!-- <a href="/news/{{ $breadcrumb->breadcrumb_id }}/del" onclick="javascript:return del();">
											<button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
										</a> -->
									@else
									@endif
								@endguest
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				{{-- 分頁頁數按鈕 --}}
				{{ $BreadcrumbPaginate->links() }}
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