<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\DonHang;
use App\Http\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class OrderController extends Controller
{
    function muahang($id, Request $request){
        $soluong = $request->input('soluong');

        $tin = DB::table('sanpham')->where('id_san_pham',$id)->first();
        $data= ['soluong'=>$soluong,'tin'=>$tin];
        return view('dathang', $data);

    }
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function store(Request $request) {
        // Lấy dữ liệu từ form
        $httt_ma = $request->input('httt_ma');
        $ten_nguoi_nhan = $request->input('ten_nguoi_nhan');
        $dia_chi = $request->input('dia_chi');
        $so_dien_thoai = $request->input('so_dien_thoai');
        $email = $request->input('email');
        $idsp = $request->input('idsp');
        $thanhtien = $request->input('tongtien');

        if (!session()->has('iduser')) {
            // Nếu session 'iduser' không tồn tại, chuyển người dùng sang trang đăng nhập
            return redirect()->route('login');
        }else{
            if (Auth::check()) {
                $iduser = session('iduser');
            } else {
                $iduser = 0;
            }
            if($httt_ma == 2){
                $donHang = new DonHang;
                $donHang->pttt = $httt_ma;
                $donHang->thoi_diem_mua_hang = now();
                $donHang->ten_nguoi_nhan = $ten_nguoi_nhan;
                $donHang->dia_chi = $dia_chi;
                $donHang->so_dien_thoai = $so_dien_thoai;
                $donHang->email = $email;
                $donHang->id_san_pham = $idsp;
        $donHang->id_nguoi_dung = $iduser;
        $donHang->tongdonhang = $thanhtien;
                $donHang->save();
                $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


                $partnerCode = 'MOMOBKUN20180529';
                $accessKey = 'klm05TvNBzhg7h7j';
                $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
                $orderInfo = "Thanh toán qua MoMo";
                $amount = $thanhtien;
                $orderId = rand(00,9999);
                $redirectUrl = "http://127.0.0.1:8000/";
                $ipnUrl = "http://127.0.0.1:8000/";
                $extraData = "";


                if (!empty($_POST)) {
                    $partnerCode = $partnerCode;
                    $accessKey = $accessKey;
                    $serectkey = $secretKey;
                    $orderId = $orderId;// Mã đơn hàng

                    $orderInfo = $orderInfo;
                    $amount = $amount;
                    $ipnUrl = $ipnUrl;
                    $redirectUrl = $redirectUrl;
                    $extraData = $extraData;

                    $requestId = time() . "";
                    $requestType = "payWithATM";
                    // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
                    //before sign HMAC SHA256 signature
                    $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                    $signature = hash_hmac("sha256", $rawHash, $serectkey);
                    $data = array('partnerCode' => $partnerCode,
                        'partnerName' => "Test",
                        "storeId" => "MomoTestStore",
                        'requestId' => $requestId,
                        'amount' => $amount,
                        'orderId' => $orderId,
                        'orderInfo' => $orderInfo,
                        'redirectUrl' => $redirectUrl,
                        'ipnUrl' => $ipnUrl,
                        'lang' => 'vi',
                        'extraData' => $extraData,
                        'requestType' => $requestType,
                        'signature' => $signature);
                        $result = $this->execPostRequest($endpoint, json_encode($data));
                        $jsonResult = json_decode($result, true);  // decode json

                    //Just a example, please check more in there

                        // return redirect('/home')->with('thongbao', $thongbao);
                        if (isset($jsonResult['payUrl'])) {
                            return redirect($jsonResult['payUrl']);
                        } else {
                            // Xử lý lỗi khi không có khóa 'payUrl' trong dữ liệu trả về từ API
                            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thanh toán qua MoMo.');
                        }   }

            }else{
                $donHang = new DonHang;
                $donHang->pttt = $httt_ma;
                $donHang->thoi_diem_mua_hang = now();
                $donHang->ten_nguoi_nhan = $ten_nguoi_nhan;
                $donHang->dia_chi = $dia_chi;
                $donHang->so_dien_thoai = $so_dien_thoai;
                $donHang->email = $email;
                $donHang->id_san_pham = $idsp;
        $donHang->id_nguoi_dung = $iduser;
        $donHang->tongdonhang = $thanhtien;

                $donHang->save();
            }
        }

        // Lưu dữ liệu vào cơ sở dữ liệu
        // Ví dụ:


        // Sau khi lưu dữ liệu, bạn có thể thực hiện các xử lý khác
        // ví dụ: thêm sản phẩm vào đơn hàng, tính tổng số tiền, vv.

        // Cuối cùng, chuyển người dùng đến trang cảm ơn hoặc trang tiếp theo
    }


    public function addToCart(Request $request) {
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        $cart = $request->session()->get('giohang', []); // Lấy giỏ hàng từ session hoặc tạo mới nếu chưa tồn tại

        // Thêm sản phẩm vào giỏ hàng
        $cart[] = [
            'product_id' => $product_id,
            'quantity' => $quantity,
        ];

        // Lưu giỏ hàng vào session
        $request->session()->put('giohang', $cart);

        return response()->json(['message' => 'Sản phẩm đã được thêm vào giỏ hàng.']);
    }
}
