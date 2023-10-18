@extends('admin.layout.index')
@section('content')


        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Sửa sản phẩm</h3>
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
                        <form class="row" action="admin-suasanpham/{{$sanpham->id_san_pham}}" method="post" enctype="multipart/form-data">
                            <div class="form-group col-md-3">
                                <label class="control-label">Tên sản phẩm</label>
                                <input class="form-control" name="ten_san_pham" value="{{$sanpham->ten_san_pham}}" type="text" placeholder="">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Giá</label>
                                <input class="form-control" value="{{$sanpham->gia}}" name="gia" height="100px" type="text">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Giá khuyển mãi</label>
                                <input class="form-control" value="{{$sanpham->gia_khuyen_mai}}" name="gia_khuyen_mai" height="100px" type="text">
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Mô tả sản phẩm</label>
                                <textarea class="form-control" type="text" name="mo_ta" id="mota">{{$sanpham->mo_ta}}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Ảnh</label>
                                <p>
                                    <img width="400px" src="images/{{$sanpham->hinh}}" alt="">
                                </p>
                                <div id="myfileupload">
                                    <input type="file" id="uploadfile" name="hinh" onchange="readURL(this);" />
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
                            <div class="form-group col-md-3">
                            <label class="control-label">Hot</label>
                            <select class="form-control" name="hot">
                                    <option value>-- Hot or Not hot --</option>
                                    <option 
                                    @if($sanpham->hot==0)
                                    {{"selected"}}
                                    
                                    @endif value="1">Not hot</option>
                                    <option  @if($sanpham->hot==1)
                                    {{"selected"}}
                                    
                                    @endif value="2">Hot</option>
                                </select>
                            </div>
        
                            <div class="form-group col-md-3 ">
                                <label for="exampleSelect1" class="control-label">Loại Sản Phẩm</label>
                                <select class="form-control" name="Loai">
                                    <option>-- Chọn loại sản phẩm --</option>
                                    @foreach($theloai as $tl)
                                    <option 
                                    @if($sanpham->loai->id_loai == $tl->id_loai) 
                                    {{"selected"}}
                                   @endif 
                                   value="{{$tl->id_loai}}">{{$tl->ten_loai}}</
                                   option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                            <label class="control-label">Ẩn hiện</label>
                            <select class="form-control" name="an_hien">
                                    <option>-- Ẩn or Hiện --</option>
                                    <option 
                                    @if($sanpham->an_hien==0)
                                    {{"selected"}}
                                    
                                    @endif 
                                    value="0">Ẩn</option>
                                    <option
                                    @if($sanpham->hot==1)
                                    {{"selected"}}
                                    
                                    @endif 
                                    value="1">Hiện</option>
                                </select>
                            </div>
                    </div>
                    <button class="btn btn-save" type="submit">Thêm</button>
					<button type="reset" class="btn btn-cancel">Làm mới</button>
                    @csrf
                </div>
                
@endsection