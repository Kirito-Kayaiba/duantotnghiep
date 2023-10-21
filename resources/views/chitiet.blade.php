<?php
$id = $tin->id_san_pham;
$com = DB::table('chitietsanpham')->where('id_san_pham',$id)->get();

$iddm = $tin->id_loai;

$listtin = DB::table('sanpham')->where('id_loai', $iddm)
->where('id_san_pham','!=',$id)
->limit(6)
->get();


$iduser = session('iduser');// Gán giá trị mặc định
$tin123 = DB::table('nguoidung')->where('id_nguoi_dung',$iduser)->first();
$diachi = $tin123->dia_chi;
$ten = $tin123->ten;
$sdt = $tin123->so_dien_thoai;
$email = $tin123->email;


$sao5 = 5;
$comments = DB::table('binhluan')->where('sao',$sao5)->get();

$sao4 = 4;
$comments4 = DB::table('binhluan')->where('sao',$sao4)->get();
$sao3 = 3;
$comments3 = DB::table('binhluan')->where('sao',$sao3)->get();
$sao2 = 2;
$comments2 = DB::table('binhluan')->where('sao',$sao2)->get();
$sao1 = 1;
$comments1 = DB::table('binhluan')->where('sao',$sao1)->get();

?>


 @extends('layout')
 @section('noidung')
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
 <style>
    .mainmenu-area {
    background: none repeat scroll 0 0 #333;
    font-family: "Roboto Condensed",sans-serif;
    text-transform: uppercase;
    width: 100%;
    z-index: 999;
}

.mainmenu-area ul.navbar-nav li a {
    color: white;
    font-size: 14px;
    padding: 20px;
}
.product-inner-price h6{
    font-weight:bolder;
    font-size:17px;
}
.product-big-title-area {
    background: url(img/crossword.png) repeat scroll 0 0 #f17024;
}
.logo h1 a img{
    width: 30%;
}
.header-area{
    background-color: #f17024;
}
.header-area a {
    color: white;
}
.product-inner-mausac{
    display: flex;
}
.product-inner-mausac h6{
    margin-top:2px;
    font-weight:bolder;
    font-size:15px;
}
.product-inner-price ins{
    font-size:30px;
    color:red;
}
/* end */
.product-name {
    text-transform: uppercase;
    font-size: 20px;
    line-height: 40px;
    background: #f17024;
    color: #fff;
    border-radius: 5px 5px 0 0;
    padding: 0 20px;
    font-weight: bold;
    position: relative;
    margin-right: 20px;
}
input[type="submit"], button[type=submit] {
    background: none repeat scroll 0 0 #f17024;
    border: medium none;
    color: #fff;
    padding: 11px 20px;
    text-transform: uppercase;
}
.product-main-img img{
    width: 300px;
    margin: 0 auto;
    border-radius:20px;

}
.product-main-img{
    border:4px solid red;
border-radius:20px;
}
</style>
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">


                <div class="col-md-12">
                    <div class="product-content-right">
                        <div class="product-breadcroumb">
                            <a href="">Trang chủ</a>
                            <a href="">Sản phẩm</a>
                            <a href="">{{$tin->ten_san_pham}}</a>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="product-images">
                                    <div class="product-main-img">
                                        <img src="{{ asset('img/' . $tin->hinh) }}" alt="">
                                    </div>
<!--
                                    <div class="product-gallery">
                                        <img src="img/product-thumb-1.jpg" alt="">
                                        <img src="img/product-thumb-2.jpg" alt="">
                                        <img src="img/product-thumb-3.jpg" alt="">
                                    </div> -->
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="product-inner">
                                    <h2 class="product-name">{{$tin->ten_san_pham}}</h2>
                                    <div class="product-inner-price">
                                        <h6>Thương hiệu: Đang cập nhật</h6>
                                    </div>
                                    <div class="product-inner-price">
                                    <ins>{{ number_format($tin->gia, 0, ',', '.') }}đ</ins>
<del>{{ number_format($tin->gia_khuyen_mai, 0, ',', '.') }}</del>                                    </div>
                                    <div class="product-inner-mausac">
                                        <h6>Màu sắc  :    </h6> @foreach($com as $dt)  <p>    {{$dt->mau_sac}}</p>  @endforeach
                                    </div>
                                    <div class="product-inner-mausac">
                                        <h6>Bộ nhớ  :    </h6> @foreach($com as $dt)  <p>    {{$dt->RAM}}</p>  @endforeach
                                    </div>
                                    <form action="{{ url('/muahang', [$tin->id_san_pham]) }}" class="cart">
    @csrf
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="quantity">
        <input type="number" id="soluong" size="4" class="input-text qty text" title="Qty" value="1" name="soluong" min="1" step="1">
    </div>
    <input type="hidden" id="tensp" value="{{$tin->ten_san_pham}}">
    <button id="add-to-cart-button" class="add_to_cart_button" type="submit">Thêm vào giỏ hàng</button>
    <button class="add_to_cart_button" type="submit">Mua ngay</button>
</form>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var addToCartButton = document.getElementById('add-to-cart-button');

        if (addToCartButton) {
            addToCartButton.addEventListener('click', function(event) {
                event.preventDefault(); // Ngăn sự kiện mặc định (tránh gửi yêu cầu POST)

                // Lấy dữ liệu sản phẩm từ form hoặc các trường khác trong trang
                var quantity = document.getElementById('soluong').value; // Số lượng sản phẩm
                var productId = document.getElementById('tensp').value; // Tên sản phẩm (có thể không cần thiết)

                // Thực hiện yêu cầu AJAX để thêm sản phẩm vào giỏ hàng
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST', // Loại yêu cầu (POST để thêm sản phẩm)
                    url: '/gio-hang', // Đường dẫn xử lý yêu cầu (chú ý thay đổi URL này)
                    data: {
                        product_id: productId,
                        quantity: quantity
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        // Xử lý phản hồi từ máy chủ (nếu cần)
                        // Ví dụ: hiển thị thông báo, cập nhật giỏ hàng, vv.
                    },
                    error: function(error) {
                        // Xử lý lỗi (nếu có)
                    }
                });
            });
        }
    });
</script>

                                    <div class="product-inner-category">
                                        <p>Category: <a href="">Summer</a>. Tags: <a href="">awesome</a>, <a href="">best</a>, <a href="">sale</a>, <a href="">shoes</a>. </p>
                                    </div>

                                    <div role="tabpanel">
                                        <ul class="product-tab" role="tablist">
                                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                                <h2>Product Description</h2>
                                                <p>{{$tin->mo_ta}}.</p>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="profile">
                                                <h2>Reviews</h2>
                                                <form action="{{ url('/comments') }}" id="comment-form" method="POST">
    @csrf
    <div class="submit-review">
        @if (session()->has('iduser'))
            <p><label for="name">Name</label> <input value="{{ session('ten') }}" name="name" type="text" readonly></p>
            <p><label for="email">Email</label> <input value="{{ $email }}" name="email" type="text" readonly></p>
        @else
            <p><label for="name">Name</label> <input name="name" type="text"></p>
            <p><label for="email">Email</label> <input name="email" type="email"></p>
        @endif
        <input type="hidden" name="idsp" value="{{$tin->id_san_pham}}">

        <div class="rating-chooser">
            <p>Your rating</p>
            <div class="rating-wrap-post">
                <i class="fa fa-star" id="star1"></i>
                <i class="fa fa-star" id="star2"></i>
                <i class="fa fa-star" id="star3"></i>
                <i class="fa fa-star" id="star4"></i>
                <i class="fa fa-star" id="star5"></i>
            </div>
            <input type="hidden" name="rating" id="rating" value="0">
        </div>
        <p><label for="review">Your review</label> <textarea name="content" id="review" cols="30" rows="10"></textarea></p>
        <button id="submit-comment" class="add_to_cart_button" type="submit">Mua ngay</button>
    </div>
</form>
<div class="review-body mt-3">
                    <label class="review-body-item">
                <div>
                    <input  data-name="review-checkbox" data-star="5" type="checkbox">
                </div>
                <p>5 sao</p>
                <div data-toggle="tooltip" title="29 %" class="w-100">
                    <div class="review-progress-bar">
                        <span style="width: 29.166666666667%; --active-bg-color: var(--star-5-color)" class="review-progress-bar-inner"></span>
                    </div>
                </div>
                <p>7</p>
            </label>
                    <label class="review-body-item">
                <div>
                    <input  data-name="review-checkbox" data-star="4" type="checkbox">
                </div>
                <p>4 sao</p>
                <div data-toggle="tooltip" title="4 %" class="w-100">
                    <div class="review-progress-bar">
                        <span style="width: 4.1666666666667%; --active-bg-color: var(--star-4-color)" class="review-progress-bar-inner"></span>
                    </div>
                </div>
                <p>1</p>
            </label>
                    <label class="review-body-item">
                <div>
                    <input  data-name="review-checkbox" data-star="3" type="checkbox">
                </div>
                <p>3 sao</p>
                <div data-toggle="tooltip" title="13 %" class="w-100">
                    <div class="review-progress-bar">
                        <span style="width: 12.5%; --active-bg-color: var(--star-3-color)" class="review-progress-bar-inner"></span>
                    </div>
                </div>
                <p>3</p>
            </label>
                    <label class="review-body-item">
                <div>
                    <input  data-name="review-checkbox" data-star="2" type="checkbox">
                </div>
                <p>2 sao</p>
                <div data-toggle="tooltip" title="8 %" class="w-100">
                    <div class="review-progress-bar">
                        <span style="width: 8.3333333333333%; --active-bg-color: var(--star-2-color)" class="review-progress-bar-inner"></span>
                    </div>
                </div>
                <p>2</p>
            </label>
                    <label class="review-body-item">
                <div>
                    <input  data-name="review-checkbox" data-star="1" type="checkbox">
                </div>
                <p>1 sao</p>
                <div data-toggle="tooltip" title="46 %" class="w-100">
                    <div class="review-progress-bar">
                        <span style="width: 45.833333333333%; --active-bg-color: var(--star-1-color)" class="review-progress-bar-inner"></span>
                    </div>
                </div>
                <p>11</p>
            </label>
            </div>
</div>
<!-- <style>code
.review-body-item {
    display: flex;
    flex-direction: row;
    align-items: center;
    margin-bottom: 10px;
}

.review-progress-bar {
    width: 100%;
    height: 20px;
    background-color: #ddd;
    border-radius: 10px; /* Để làm cho viền thanh trông tròn hơn */

    /* Thay đổi màu nền dựa trên thuộc tính --active-bg-color */
    --active-bg-color: var(--star-1-color); /* Màu nền khi phần trăm là 100% */
}

.review-progress-bar-inner {
    width: 0; /* Chiều rộng ban đầu là 0, sẽ được cập nhật từ phần trăm */
    height: 100%;
    background-color: var(--active-bg-color);
    border-radius: 10px; /* Để làm cho viền thanh trông tròn hơn */
}
</style> -->
<script>
    document.getElementById('submit-comment').addEventListener('click', function (event) {
        var nameInput = document.querySelector('input[name="name"]');
        var emailInput = document.querySelector('input[name="email"]');
        var contentTextarea = document.querySelector('textarea[name="content"]');
        var ratingInput = document.querySelector('input[name="rating"]');

        if (nameInput.value.trim() === '' || emailInput.value.trim() === '' || contentTextarea.value.trim() === '' || ratingInput.value === '0') {
            alert('Vui lòng điền đầy đủ thông tin và đánh giá trước khi gửi bình luận.');
            event.preventDefault(); // Ngăn chặn hành vi mặc định của nút
        }
    });
</script>

<script>

    const stars = document.querySelectorAll('.rating-chooser i');
    const ratingInput = document.getElementById('rating');

    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            // Lấy giá trị số sao đã chọn và gán vào ratingInput
            ratingInput.value = index + 1;

            // Gán lớp 'checked' cho tất cả sao trước sao được chọn
            stars.forEach((s, i) => {
                if (i <= index) {
                    s.classList.add('checked');
                } else {
                    s.classList.remove('checked');
                }
            });
        });
    });
</script>
<style>
    .fa-star {
        color: gray;
        cursor: pointer;
    }

    .fa-star.checked {
        color: orange;
    }
</style>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
<div class="thongkebinhluan">
    <div class="container">
        <div class="row">
        <h2 class="h2">Đánh giá sản phẩm</h2>
<hr>
            <div class="col-5 dss">
<h3>Đánh giá bình luận</h3>
<h4 class="h4">{{$averageRating}}/5</h4>
<div id="rating-stars"></div>

            </div>
            <div class="col-5"></div>
        </div>
        <div class="row">
            <div class="col-12 col">
            <div class="w3-bar w3-black button">
  <button class="w3-bar-item w3-button" onclick="openCity('London')">5 sao</button>
  <button class="w3-bar-item w3-button" onclick="openCity('Paris')">4 sao</button>
  <button class="w3-bar-item w3-button" onclick="openCity('Tokyo')">3 sao</button>
  <button class="w3-bar-item w3-button" onclick="openCity('Tokyo1')">2 sao</button>

  <button class="w3-bar-item w3-button" onclick="openCity('Tokyo2')">2 sao</button>

</div>
<div id="London" class="city">
@foreach ($comments as $comment)
    <div class="comment">
    <img src="{{ asset('img/' . getUsernameFromUserId1($comment->id_nguoi_dung)) }}" alt="">

        <div class="noidung">
        <h5>Người dùng: {{ getUsernameFromUserId($comment->id_nguoi_dung) }}</h5>
        <p>{{ $comment->noi_dung }}</p>
        <!-- Hiển thị số sao -->
        @for ($i = 1; $i <= $comment->sao; $i++)
            <i class="fa fa-star checked"></i>
        @endfor
        </div>
    </div>
@endforeach
</div>

<div id="Paris" class="city" style="display:none">
@foreach ($comments4 as $comment)
    <div class="comment">
    <img src="{{ asset('img/' . getUsernameFromUserId1($comment->id_nguoi_dung)) }}" alt="">

        <div class="noidung">
        <h5>Người dùng: {{ getUsernameFromUserId($comment->id_nguoi_dung) }}</h5>
        <p>{{ $comment->noi_dung }}</p>
        <!-- Hiển thị số sao -->
        @for ($i = 1; $i <= $comment->sao; $i++)
            <i class="fa fa-star checked"></i>
        @endfor
        </div>
    </div>
@endforeach
</div>

<div id="Tokyo" class="city" style="display:none">
@foreach ($comments3 as $comment)
    <div class="comment">
    <img src="{{ asset('img/' . getUsernameFromUserId1($comment->id_nguoi_dung)) }}" alt="">

        <div class="noidung">
        <h5>Người dùng: {{ getUsernameFromUserId($comment->id_nguoi_dung) }}</h5>
        <p>{{ $comment->noi_dung }}</p>
        <!-- Hiển thị số sao -->
        @for ($i = 1; $i <= $comment->sao; $i++)
            <i class="fa fa-star checked"></i>
        @endfor
        </div>
    </div>
@endforeach
</div>
<div id="Tokyo1" class="city" style="display:none">
@foreach ($comments3 as $comment)
    <div class="comment">
    <img src="{{ asset('img/' . getUsernameFromUserId1($comment->id_nguoi_dung)) }}" alt="">

        <div class="noidung">
        <h5>Người dùng: {{ getUsernameFromUserId($comment->id_nguoi_dung) }}</h5>
        <p>{{ $comment->noi_dung }}</p>
        <!-- Hiển thị số sao -->
        @for ($i = 1; $i <= $comment->sao; $i++)
            <i class="fa fa-star checked"></i>
        @endfor
        </div>
    </div>
@endforeach
</div>
<div id="Tokyo2" class="city" style="display:none">
@foreach ($comments3 as $comment)
    <div class="comment">
    <img src="{{ asset('img/' . getUsernameFromUserId1($comment->id_nguoi_dung)) }}" alt="">

        <div class="noidung">
        <h5>Người dùng: {{ getUsernameFromUserId($comment->id_nguoi_dung) }}</h5>
        <p>{{ $comment->noi_dung }}</p>
        <!-- Hiển thị số sao -->
        @for ($i = 1; $i <= $comment->sao; $i++)
            <i class="fa fa-star checked"></i>
        @endfor
        </div>
    </div>
@endforeach
</div>
            </div>
        </div>
    </div>
</div>
<script>
    // Lấy số sao từ cơ sở dữ liệu (ví dụ: 3 sao)
    var averageRating = 5;

    // Chọn phần tử div để hiển thị số sao
    var ratingStars = document.getElementById("rating-stars");

    // Tạo hình ngôi sao và thêm vào div
    for (var i = 0; i < averageRating; i++) {
        var star = document.createElement("i");
        star.className = "fa fa-star checked";
        ratingStars.appendChild(star);
    }
</script>
<script>
    function openCity(cityName) {
  var i;
  var x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  document.getElementById(cityName).style.display = "block";
}
</script>
                        <div class="col-md-12" id="col-md-8">

                        <h3>SẢN PHẨM TƯƠNG TỰ</h3>
@foreach($listtin as $dt)
<div class="col-md-4 col-sm-6">
    <div class="single-shop-product">
        <div class="product-upper">
            <img src="{{ asset('img/' . $dt->hinh) }}" alt="">
        </div>

        <h2><a href="/chitiet">{{$dt->ten_san_pham}}</a></h2>

        <div class="product-carousel-price">
            <ins>{{$dt->gia_khuyen_mai}}</ins> <del>{{$dt->gia}}</del>
        </div>
        <div class="product-option-shop">
            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70"
                rel="nofollow" href="/canvas/shop/?add-to-cart=70">Add to cart</a>
        </div>
    </div>
</div>
@endforeach
<!-- <div class="col-md-4 col-sm-6">
        <div class="single-shop-product">
            <div class="product-upper">
                <img src="img/product-2.jpg" alt="">
            </div>
            <h2><a href="">Apple new mac book 2015 March :P</a></h2>
            <div class="product-carousel-price">
                <ins>$899.00</ins> <del>$999.00</del>
            </div>

            <div class="product-option-shop">
                <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Add to cart</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="single-shop-product">
            <div class="product-upper">
                <img src="img/product-1.jpg" alt="">
            </div>
            <h2><a href="">Apple new mac book 2015 March :P</a></h2>
            <div class="product-carousel-price">
                <ins>$899.00</ins> <del>$999.00</del>
            </div>

            <div class="product-option-shop">
                <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Add to cart</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="single-shop-product">
            <div class="product-upper">
                <img src="img/product-3.jpg" alt="">
            </div>
            <h2><a href="">Apple new mac book 2015 March :P</a></h2>
            <div class="product-carousel-price">
                <ins>$899.00</ins> <del>$999.00</del>
            </div>

            <div class="product-option-shop">
                <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Add to cart</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="single-shop-product">
            <div class="product-upper">
                <img src="img/product-4.jpg" alt="">
            </div>
            <h2><a href="">Apple new mac book 2015 March :P</a></h2>
            <div class="product-carousel-price">
                <ins>$899.00</ins> <del>$999.00</del>
            </div>

            <div class="product-option-shop">
                <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Add to cart</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="single-shop-product">
            <div class="product-upper">
                <img src="img/product-2.jpg" alt="">
            </div>
            <h2><a href="">Apple new mac book 2015 March :P</a></h2>
            <div class="product-carousel-price">
                <ins>$899.00</ins> <del>$999.00</del>
            </div>

            <div class="product-option-shop">
                <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Add to cart</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="single-shop-product">
            <div class="product-upper">
                <img src="img/product-1.jpg" alt="">
            </div>
            <h2><a href="">Apple new mac book 2015 March :P</a></h2>
            <div class="product-carousel-price">
                <ins>$899.00</ins> <del>$999.00</del>
            </div>

            <div class="product-option-shop">
                <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Add to cart</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="single-shop-product">
            <div class="product-upper">
                <img src="img/product-3.jpg" alt="">
            </div>
            <h2><a href="">Apple new mac book 2015 March :P</a></h2>
            <div class="product-carousel-price">
                <ins>$899.00</ins> <del>$999.00</del>
            </div>

            <div class="product-option-shop">
                <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Add to cart</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="single-shop-product">
            <div class="product-upper">
                <img src="img/product-4.jpg" alt="">
            </div>
            <h2><a href="">Apple new mac book 2015 March :P</a></h2>
            <div class="product-carousel-price">
                <ins>$899.00</ins> <del>$999.00</del>
            </div>

            <div class="product-option-shop">
                <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Add to cart</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="single-shop-product">
            <div class="product-upper">
                <img src="img/product-2.jpg" alt="">
            </div>
            <h2><a href="">Apple new mac book 2015 March :P</a></h2>
            <div class="product-carousel-price">
                <ins>$899.00</ins> <del>$999.00</del>
            </div>

            <div class="product-option-shop">
                <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Add to cart</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="single-shop-product">
            <div class="product-upper">
                <img src="img/product-1.jpg" alt="">
            </div>
            <h2><a href="">Apple new mac book 2015 March :P</a></h2>
            <div class="product-carousel-price">
                <ins>$899.00</ins> <del>$999.00</del>
            </div>

            <div class="product-option-shop">
                <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Add to cart</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="single-shop-product">
            <div class="product-upper">
                <img src="img/product-3.jpg" alt="">
            </div>
            <h2><a href="">Apple new mac book 2015 March :P</a></h2>
            <div class="product-carousel-price">
                <ins>$899.00</ins> <del>$999.00</del>
            </div>

            <div class="product-option-shop">
                <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Add to cart</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="single-shop-product">
            <div class="product-upper">
                <img src="img/product-4.jpg" alt="">
            </div>
            <h2><a href="">Apple new mac book 2015 March :P</a></h2>
            <div class="product-carousel-price">
                <ins>$899.00</ins> <del>$999.00</del>
            </div>

            <div class="product-option-shop">
                <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/canvas/shop/?add-to-cart=70">Add to cart</a>
            </div>
        </div>
    </div> -->
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<style>
    .comment h5{
        font-weight:bold;
    }
    .comment{
        display: flex;
        padding-top:10px:
    }
    .comment img{
        width: 50px;
        border-radius:50%;
        margin-right:20px;
    }
    .city{
        padding: 20px;
    }
    .row .col{
        background-color:white;
    }
    .row .col .button{
        background-color:#cccccc;
height:50px;
padding:15px; }
.h2{
    font-weight:bolder;
}
.h4{
    font-size:30px;
    font-weight:bold;
}

</style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>


@endsection
