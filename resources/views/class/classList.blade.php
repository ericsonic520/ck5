@extends('layout.master')
@section('title', $title)
@section('content')
	<div class="container">
		<!-- <h1>{{ $title }}</h1> -->

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
	            <th>ID</th>
				<th>名稱</th>
				<th>相關圖片</th>
				<!-- <th>是否公開</th> -->
				<th>日期</th>
				<th>上課地點</th>
				<!-- <th>課程介紹</th> -->
				<th>名額</th>
          	</tr>
          	@foreach($CoursePaginate as $Course)
				<tr>
					<td>{{ $Course->id }}</td>
					<td>@if($Course->category=='C')
							{{ $Course->name }}
						@endif
						@if($Course->category=='E')
							{{ $Course->name }}
						@endif
						@if($Course->category=='M')
							{{ $Course->name }}
						@endif</td>
					<td>
						@if(!is_null($Course->pic))
		                            <img src="{{ $Course->pic }}">
		                        @endif
		                        @if(is_null($Course->pic))
		                            <img src="{{ '/images/class/5d0de69e07324.png' }}">
		                        @endif
					</td>
					<!-- <td>
						@if($Course->status == 'R')
							<span class="label label-default" style="border-radius: 3px;padding: 3px 10px 5px 10px;">
								計畫中
							</span>
						@else
							<span class="label label-success" style="border-radius: 3px;padding: 3px 10px 5px 10px;">
								公開
							</span>
						@endif
					</td> -->
					<td>{{ $Course->class_date }}<br>{{ $Course->class_start_time }}~{{ $Course->class_end_time }}</td>
					<td>{{ $Course->county }}{{ $Course->district }}{{ $Course->addr }}{{ $Course->zipcode }}</td>
					<!-- <td>{{ $Course->content }}</td> -->
					<td>{{ $Course->quota }}</td>
			@endforeach
          </tbody>
      	</table>
        {{-- 分頁頁數按鈕 --}}
				{{ $CoursePaginate->links() }}
      </div>
    </div>
		
	</div>
@endsection