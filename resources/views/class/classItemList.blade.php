@extends('layout.master')
@section('title', $title)
@section('content')
<div class="container">
	<!-- <h1>{{ $title }}</h1> -->

	{{-- 錯誤訊息模板元件 --}}
	@include('components.validationErrorMessage')
		<div class="card">
      <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>

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
				<th>編號</th>
				<th>課程名稱</th>
				<th style="width:10%">姓名</th>
				<th>手機</th>
				<th style="width:10%">Email</th>
				<!-- <th>正取</th> -->
				<th>取消</th>
			</tr>
      		@foreach($PlusPaginate as $Plus)
			<tr>
				@if(empty($Plus))
					
				@else
					<td>{{ $Plus->id }}</td>
					<td>
						{{ $Plus->name }}	
					</td>
					<td>{{ $Plus->nickname }}</td>
					<td>{{ $Plus->phone }}</td>
					<td>{{ $Plus->email }}</td>
					<!-- <td></td> -->
					<td><a href="/class/{{ $Plus->id }}/mdel" onclick="javascript:return del();">
						<button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
					</a></td>
				@endif
			</tr>
			@endforeach
			</tbody>
		    </table>
		    {{-- 分頁頁數按鈕 --}}
			{{-- {{ $PlusPaginate->links() }} --}}
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