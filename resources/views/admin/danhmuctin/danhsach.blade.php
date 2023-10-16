@extends('admin.layout.index')
@section('content')
<div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <h3 class="tile-title">Danh sách danh mục</h3>
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
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Thể Loại</th>
                                    <th>Mô tả</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($theloai as $tl )
                                <tr>
                                    <td>{{$tl->id_danh_muc_tin}}</td>
                                    <td>{{$tl->ten_danh_muc}}</td>
                                    <td>{{$tl->mo_ta}}</td>
                                    <td><a href="{{route('xoatl',['id'=>$tl->id_danh_muc_tin])}}"><button class="btn btn-primary btn-sm trash"type="button" title="Xóa"><i class="fas fa-trash-alt"></i></a> 
                                        </button>
                                        <a href="admin-suadanhmuctin/{{$tl->id_danh_muc_tin}}"> <button class="btn btn-primary btn-sm edit" type="button" title="Sửa" id="show-emp" data-toggle="modal" data-target="#ModalUP"><i class="fas fa-edit"></i></button> </a>

                                    </td>
                                </tr>
                              @endforeach


                            </tbody>
                        </table>
        
                    </div>
                </div>

@endsection