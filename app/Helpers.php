<?php


use Illuminate\Support\Facades\DB;

function getUsernameFromUserId($userId) {
    $user = DB::table('nguoidung')->where('id_nguoi_dung', $userId)->first();

    if ($user) {
        return $user->ten;
    } else {
        return 'Người dùng không tồn tại';
    }
}

function getUsernameFromUserId1($userId) {
    $user = DB::table('nguoidung')->where('id_nguoi_dung', $userId)->first();

    if ($user) {
        return $user->hinh;
    } else {
        return 'Người dùng không tồn tại';
    }
}

?>
