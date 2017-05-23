<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CayVaiThanhPham;
use App\CayVaiThanhPhamTraLai;
use App\LoaiVai;
use App\Mau;
use App\HoaDonXuat;
use Session;

class TraHangController extends Controller
{
    public function index()
    {
        $list_cvtptl = CayVaiThanhPhamTraLai::all();
        return view('manageside.banhang.trahang')->withList($list_cvtptl);
    }

    public function create()
    {
        return view('manageside.banhang.trahang_create')
        // ->withHoadonxuats(HoaDonXuat::all())
        ->withLoaivais(LoaiVai::select('id','ten')->get())
        ->withMaus(Mau::select('id','ten')->get())
        ->withCayvais(CayVaiThanhPham::get())
        ;
    }

    public function danhSachCayVaiAjax(Request $request) {
        $cvQuery = CayVaiThanhPham::where('tinh_trang', 'Đã Xuất')
        ->select('id', 'loai_vai_id', 'mau_id', 'so_met', 'don_gia', 'kich_co');

        if ($request->loaivai) {
            $cvQuery = $cvQuery->whereIn('loai_vai_id', $request->loaivai);
        }
        if ($request->mau) {
            $cvQuery = $cvQuery->whereIn('mau_id', $request->mau);
        }

        $data = $cvQuery->get();

        foreach ($data as $cv) {
            $cv->ten_loai_vai = LoaiVai::find($cv->loai_vai_id)->ten;
            $cv->ten_mau = Mau::find($cv->mau_id)->ten;
        }

        return $data;
    }

    public function store(Request $request)
    {
        $dsCayVai = CayVaiThanhPham::find($request->cayvai);
        $dsCayVaiTraLai = [];

        foreach ($dsCayVai as $key->$cv) {
            $cvtl = new CayVaiThanhPhamTraLai;
            $dsCayVaiTraLai[$key] = $cvtl;

            $cvtl->hoa_don_xuat_id = $cv->hoa_don_xuat_id;
            $cvtl->cay_vai_thanh_pham_id = $cv->id;
            $cvtl->kich_co = $cv->kich_co;
            $cvtl->so_met = $cv->kich_co;
            $cvtl->don_gia = $cv->kich_co;
            $cvtl->loai_vai_id = $cv->kich_co;
            $cvtl->mau_id = $cv->kich_co;
            
        }

        \Session::flash('success', 'Trả lại hàng thành công!');
        return redirect('/tra_hang');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
