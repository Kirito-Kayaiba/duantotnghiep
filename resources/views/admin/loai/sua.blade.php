@extends('admin.layout.index')
@section('content')

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Sửa Loại Sản Phẩm</h3>
                    <div class="tile-body">
                        <div class="row element-button">
                        </div>
                        @if(count($errors)>0)
                               <div class="alert alert-danger" style="color:red">
								@foreach($errors->all() as $err)
                                   {{$err}} <br>
								@endforeach
							   </div>
							@endif


							@if(session('thongbao'))
                              <div class="alert alert-success">
								{{session('thongbao')}}
							  </div>
 
							@endif
                        <form action="admin-sualoai/{{$theloai->id_loai}}" method="post" class="row">
                          
                            <div class="form-group col-md-3">
                            <label class="control-label">Tên Loại </label>
                                <input class="form-control" type="text" name="ten_loai" value="{{$theloai->ten_loai}}" placeholder="">
                            </div>
                            <div class="form-group col-md-3">
                            <label class="control-label">Thứ tự</label>
                                <input class="form-control" type="text" value="{{$theloai->thu_tu}}" name="thu_tu" placeholder="">
                            </div>
                            <div class="form-group col-md-3">
                            <label class="control-label">Ẩn hiện</label>
                            <select class="form-control" name="an_hien">
                                    <option>-- Chọn người dùng --</option>
                                    <option
                                    @if($theloai->an_hien==0)
									   {{"selected"}}
									 @endif >0</option>
                                    <option @if($theloai->an_hien==1)
									   {{"selected"}}
									 @endif >1</option>
                                </select>
                            </div>>
                             
                          
                    </div>
                    <button class="btn btn-save" type="submit">Sửa</button>
					<button type="reset" class="btn btn-cancel">Làm mới</button>
                    @csrf
                        
                </div>
                
@endsection