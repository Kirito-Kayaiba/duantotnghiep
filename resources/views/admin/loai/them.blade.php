@extends('admin.layout.index')
@section('content')

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Thêm loại sản phẩm</h3>
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
                        <form action="" method="post" class="row">
                          
                            <div class="form-group col-md-3">
                            <label class="control-label">Loại Sản Phẩm</label>
                                <input class="form-control" type="text" name="ten_loai" placeholder="">
                            </div>
                            <div class="form-group col-md-3">
                            <label class="control-label">Ẩn hiện</label>
                            <select class="form-control" name="an_hien">
                                    <option>-- Chọn người dùng --</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                            <label class="control-label">Thứ tự</label>
                                <input class="form-control" type="text" name="thu_tu" placeholder="">
                            </div>
                           
                          
                    </div>
                    <button class="button-primary" type="submit">Thêm</button>
					<button type="reset" class="button-primary">Làm mới</button>
                    @csrf   
                        
                </div>
                
@endsection