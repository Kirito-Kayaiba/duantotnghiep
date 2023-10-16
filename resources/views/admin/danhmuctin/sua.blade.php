@extends('admin.layout.index')
@section('content')

        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Sửa danh mục</h3>
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
                        <form action="admin-suadanhmuctin/{{$theloai->id_danh_muc_tin}}" method="post" class="row">
                          
                            <div class="form-group col-md-3">
                            <label class="control-label">Danh Mục </label>
                                <input class="form-control" type="number" name="ten_danh_muc" value="{{$theloai->ten_danh_muc}}" placeholder="">
                            </div>
                            <div class="form-group col-md-12">
                            <label class="control-label">Mô tả</label>
                                <textarea class="form-control" value="{{$theloai->mo_ta}}" name="mo_ta"  id="mota"></textarea>
                            </div>  
                          
                    </div>
                    <button class="button-primary" type="submit">Sửa</button>
					<button type="reset" class="button-primary">Làm mới</button>
                    @csrf
                        
                </div>
                
@endsection