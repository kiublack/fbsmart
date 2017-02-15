
@extends('temple.layout')

@section('title', 'User info')


@section('content')
<a href="/">
<div class="btn btn-primary">
	<span class="glyphicon glyphicon-chevron-left"></span> Quay lại
</div></a><br/>
Chào {{$name}}, hiện tại bạn chưa có quyền sử dụng hệ thống do chưa đăng ký với admin. Bạn vui lòng gửi số ID dưới đây cho admin để yêu cầu kích hoạt tài khoản nhé. Chúc bạn một ngày tốt lành<br/>
<div class="col-md-6 col-md-offset-3" style="padding: 10px; text-align: center; color: red;">
	<p class="bg-success" style="font-size: 40px;">{{$fid}}</p>
	</div>
	

@endsection