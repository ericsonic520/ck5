@extends('front.master')
@section('content')
    <div class="container">
        <div class="col-md-12">

            {{-- 錯誤訊息模板元件 --}}
            @include('components.validationErrorMessage')
            <label>
                <h1>{{ $title }}</h1>
            </label>

            <table class="table">
                
                <tr>
                    <th>課程名稱</th>
                    <td>{{ $Course->name }}</td>
                </tr>
                <tr>
                    <th style="width:10%">課程圖片</th>
                    <td>
                        @if(!is_null($Course->pic))
                            <img src="{{ $Course->pic }}">
                        @endif
                        @if(is_null($Course->pic))
                            <img src="{{ '/images/class/5d109e473d17b.jpg' }}">
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>課程日期</th>
                    <td>
                        {{ $Course->class_date }}
                    </td>
                </tr>
                <tr>
                    <th>上課時間</th>
                    <td>
                        {{ $Course->class_start_time }} ~ {{ $Course->class_end_time }}
                    </td>
                </tr>
                <tr>
                    <th>上課地點</th>
                    <td>
                        {{ $Course->county }}{{ $Course->district }}{{ $Course->zipcode }}{{ $Course->addr }}
                    </td>
                </tr>
                <tr>
                    <th>課程介紹</th>
                    <td>
                        {{ $Course->content }}
                    </td>
                </tr>
                <tr>
                    <th>名額</th>
                    <td>
                        {{ $Course->quota }}
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <form action="/class/join" method="get">
                            <input type="hidden" name="class_id" value="{{ $Course->id }}">
                            <button type="submit" class="btn">
                                選課程
                            </button>
                            <a href="/">
                                <button type="button" class="btn" >
                                    回上頁
                                </button>
                            </a>  
                            {{ csrf_field() }}
                        </form>
                                            
                    </td>
                </tr>
            </table>

        </div>
    </div>

@endsection
 