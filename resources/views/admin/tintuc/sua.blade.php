@extends('admin.layout.index')
@section('content')


        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Sửa tin tức</h3>
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
                        <form class="row" action="admin-suadanhsachtin/{{$tintuc->id_tin}}" method="post" enctype="multipart/form-data">
                            <div class="form-group col-md-3">
                                <label class="control-label">Tiêu Đề</label>
                                <input class="form-control" name="tieu_de" value="{{$tintuc->tieu_de}}" type="text" placeholder="">
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Tóm tắt</label>
                                <input class="form-control" name="tom_tat" value="{{$tintuc->tom_tat}}" height="100px" type="text">
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Nội dung</label>
                                <input class="form-control" value="{{$tintuc->noi_dung}}" name="noi_dung" value="" height="100px" type="text">
                            </div>
        
        
                            <div class="form-group col-md-3 ">
                                <label for="exampleSelect1" class="control-label">Người dùng</label>
                                <select class="form-control" value="" name="NguoiDung">
                                    <option>-- Chọn người dùng --</option>
                                    @foreach($nguoidung as $nd)
                                    <option
                                    @if($tintuc->nguoidung->id_nguoi_dung == $nd->id_nguoi_dung)
										{{"selected"}}
										@endif 
                                        value="{{$nd->id_nguoi_dung}}">{{$nd->email}}</
                                        option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exampleSelect1" class="control-label">Danh mục</label>
                                <select class="form-control" name="DanhMucTinTuc">
                                    <option>-- Chọn danh mục --</option>
                                    @foreach($theloai as $tl)
                                    <option
                                    @if($tintuc->danhmuctintuc->id_danh_muc_tin == $tl->id_danh_muc_tin)
										{{"selected"}}
										@endif
                                        value="{{$tl->id_danh_muc_tin}}">{{$tl->ten_danh_muc}}</
                                        option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Ảnh</label>
                                <p>
                                    <img width="400px" src="images/{{$tintuc->Hinh}}" alt="">
                                </p>
                                <div id="myfileupload">
                                    <input type="file" id="uploadfile" name="Hinh" onchange="readURL(this);" />
                                </div>
                                <div id="thumbbox">
                                    <img height="450" width="400" alt="Thumb image" id="thumbimage" style="display: none" />
                                    <a class="removeimg" href="javascript:"></a>
                                </div>
                                <div id="boxchoice">
                                    <a href="javascript:" class="Choicefile"><i class="fas fa-cloud-upload-alt"></i>
                                        Chọn ảnh</a>
                                    <p style="clear:both"></p>
                                </div>
        
                            </div>
                    </div>
                    <button class="button-primary" type="submit">Sửa</button>
					<button type="reset" class="button-primary">Làm mới</button>
                    @csrf
                </div>
                
@endsection