<!--Tables-->
@extends('admin.layout.index')
@section('content')
<div class="app-title">
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item active"><a href="#"><b>Danh sách tin tức</b></a></li>
            </ul>
            <div id="clock"></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="row element-button">
                            <div class="col-sm-2">

                                <a class="btn btn-add btn-sm" href="form-add-san-pham.html" title="Thêm"><i class="fas fa-plus"></i>
                                Tạo mới sản phẩm</a>
                            </div>
                            <div class="col-sm-2">
                                <a class="btn btn-delete btn-sm nhap-tu-file" type="button" title="Nhập" onclick="myFunction(this)"><i
                                  class="fas fa-file-upload"></i> Tải từ file</a>
                            </div>

                            <div class="col-sm-2">
                                <a class="btn btn-delete btn-sm print-file" type="button" title="In" onclick="myApp.printTable()"><i
                                  class="fas fa-print"></i> In dữ liệu</a>
                            </div>
                            <div class="col-sm-2">
                                <a class="btn btn-delete btn-sm print-file js-textareacopybtn" type="button" title="Sao chép"><i
                                  class="fas fa-copy"></i> Sao chép</a>
                            </div>

                            <div class="col-sm-2">
                                <a class="btn btn-excel btn-sm" href="" title="In"><i class="fas fa-file-excel"></i> Xuất Excel</a>
                            </div>
                            <div class="col-sm-2">
                                <a class="btn btn-delete btn-sm pdf-file" type="button" title="In" onclick="myFunction(this)"><i
                                  class="fas fa-file-pdf"></i> Xuất PDF</a>
                            </div>
                            <div class="col-sm-2">
                                <a class="btn btn-delete btn-sm" type="button" title="Xóa" onclick="myFunction(this)"><i
                                  class="fas fa-trash-alt"></i> Xóa tất cả </a>
                            </div>
                        </div>
                        @if(count($errors)>0)
                               <div class="alert alert-save" style="color:red">
								@foreach($errors->all() as $err)
                                   {{$err}} <br>
								@endforeach
							   </div>
							@endif


							@if(session('thongbao'))
                              <div class="alert alert-cancel">
								{{session('thongbao')}}
							  </div>
 
							@endif  
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th width="10"><input type="checkbox" id="all"></th>
                                    <th>Tiêu Đề</th>
                                    <th>Nội Dung</th>
                                    <th>Hình Ảnh</th>
                                    <th>Người Dùng</th>
                                    <th>Tóm Tắt</th>
                                    <th>Danh mục</th>
                                    <th>Chức năng</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tintuc as $tt)
                                <tr>
                                    <td width="10"><input type="checkbox" name="check1" value="1"></td>
                                    <td>{{$tt->tieu_de}}</td>
                                    <td>{{$tt->noi_dung}}</td>
                                    <td><img src="images/{{$tt->Hinh}}" width="50px" alt=""></td>
                                    <td>{{$tt->nguoidung->id_nguoi_dung}}</td>
                                    <td>{{$tt->tom_tat}}</td>
                                    <td>{{$tt->DanhMucTinTuc->ten_danh_muc}}</td> 
                                    <td>
                                        
                                    <a href="{{route('xoatt',['id'=>$tt->id_tin])}}"><button class="btn btn-primary btn-sm trash"type="button" title="Xóa"><i class="fas fa-trash-alt"></i></a> 
                                        </button>
                                        <a href="admin-suadanhsachtin/{{$tt->id_tin}}"> <button class="btn btn-primary btn-sm edit" type="button" title="Sửa" id="show-emp" data-toggle="modal" data-target="#ModalUP"><i class="fas fa-edit"></i></button> </a>

                                    </td>
                                </tr>

                               @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
            @endsection