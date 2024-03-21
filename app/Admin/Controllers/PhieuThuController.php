<?php

namespace App\Admin\Controllers;

use App\Models\PhieuThu;
use App\Models\KhachHang;
use App\Models\GoiDieuTri;
use App\Models\Thuoc;
use App\Models\KhachDieuTri;
use App\Models\GoiDieuTriKhach;
use App\Models\PhieuThuDetail;


use Encore\Admin\Admin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\DB;

class PhieuThuController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'PhieuThu';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PhieuThu());
        $grid->quickSearch();
        // $grid->id('ID')->sortable();
        $grid->ma_phieuthu('Mã Phiếu Thu')->filter('like');

        $grid->column('khach_hang_id','Tên Khách hàng')->display(function ($khach_hang_id) {
            $khach=KhachHang::find($khach_hang_id);
            if($khach) {
                return $khach->ho_ten;
            }
        });
        $grid->column('goi_id','Gói Điều Trị')->display(function ($goi_id) {
            $goi_dt=GoiDieuTri::find($goi_id);
            if($goi_dt) {
                return $goi_dt->ten;
            }
        });
        $grid->tien_thanhtoan("Số tiền thanh Toán");
        $grid->tien_con("Số tiền Còn");
        $grid->filter(function ($filter) {
            // Remove the default id filter
            $filter->disableIdFilter();
            // Add a column filter
            $filter->like('khach_hang_id', 'Tên Khách Hàng');
        });
        $grid->disableExport();
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    // protected function detail($id)
    // {
    //     $show = new Show(PhieuThu::findOrFail($id));



    //     return $show;
    // }

    // /**
    //  * Make a form builder.
    //  *
    //  * @return Form
    //  */
    // protected function form()
    // {
    //     $form = new Form(new PhieuThu());



    //     return $form;
    // }
    public function show($id, Content $content)
    {
        return $content
        ->title($this->title('Xem phiếu thu'))
        ->description($this->description['show'] ?? trans('admin.show'))
        ->body(self::editComponent($id));
    }
    public static function createComponent()
    {
        $ls_khach= KhachHang::all();
        $ls_goi_dt = GoiDieuTri::all();
        $ls_thuoc = Thuoc::all();
        // $ls_khach = KhachHang::all();
        return Admin::component('admin::phieuthu.create', compact('ls_khach','ls_goi_dt','ls_thuoc'));
        // return view('vendor.admin.quote.create');/
    }
    public static function editComponent($id)
    {
        // $users=AdminUser::where('enable',true)->get();
        $order= PhieuThu::with(['details','phieuthu'])->find($id);
        $khach_hang = KhachHang::where('id', $order->khach_hang_id)->first();
        $ls_khach= KhachHang::all();
        $ls_goi_dt = GoiDieuTri::all();
        $ls_thuoc = Thuoc::all();
        return Admin::component('admin::phieuthu.edit', compact('order','ls_khach','ls_goi_dt','ls_thuoc','khach_hang'));
    }
    public function create(Content $content)
    {
        return \Encore\Admin\Facades\Admin::content(function (Content $content) {
            $content->header('Thêm Phiếu Thu');
            $content->description('Thêm Phiếu Thu');
            $content->body(self::createComponent());
        });
    }
    public function edit($id, Content $content)
    {
        return $content
        ->title($this->title())
        ->description($this->description['edit'] ?? trans('admin.edit'))
        ->body(self::editComponent($id));

    }

    // lưu phiếu thu

    public function store()
    {
        $data=request()->all();
        // error_log($data);
        try {
            DB::beginTransaction();
            $ten_khach = '';
            $khach_hang_id = '';

        //kt khách hàng

            $khach_hang1 = KhachHang::where('dien_thoai', $data['dien_thoai'])->first();
            if(!is_null($khach_hang1)){

                $ten_khach = $khach_hang1->ho_ten;
                $khach_hang_id = $khach_hang1->id;
            }else{
                $khach_hang1 = KhachHang::where('dien_thoai1', $data['dien_thoai'])->first();
                if(!is_null($khach_hang1)){
                    $ten_khach = $khach_hang1->ho_ten;
                    $khach_hang_id = $khach_hang1->id;
                }else{
                    $khach_hang = new KhachHang([
                        'ho_ten' => $data['ho_ten1'],
                        'ngay_sinh' => $data['ngay_sinh'],
                        'dia_chi' => $data['dia_chi'],
                        'dien_thoai' => $data['dien_thoai'],
                    ]);
                    $khach_hang->save();
                    $khach_hang_id =$khach_hang->id;
                }
            }
            if($khach_hang_id != ''){


                $phieuthu = new PhieuThu([
                    'ma_phieuthu' => $data['ma_phieuthu'],
                    'khach_hang_id'=> $khach_hang_id,
                    'tien_thanhtoan'  => $data['tien_thanhtoan'] ,
                    'tien_con' => $data['tien_con'] ,
                    'ghi_chu' => '' ,
                ]);
                $phieuthu->save();
                $ls_details = json_decode($data['vat_tu_goi'], true);
                if($ls_details){

                    foreach ($ls_details as $vat_tu) {

                        if($vat_tu['ten_goi'] == 'Gói điều trị'){
                            $goi= GoiDieuTri::where('id', $vat_tu['id'])->first();

                            if($goi){
                                $goi_dt_khach = new GoiDieuTriKhach([
                                    'khach_hang_id' => $khach_hang_id,
                                    'goi_dt_id'=>$vat_tu['id'],
                                    'sl_buoi' =>$goi->so_buoi,
                                ]);
                                $goi_dt_khach->save();
                            }
                        }
                        $detail= new PhieuThuDetail([
                            'phieu_thu_id'=>$phieuthu->id,
                            'tieu_de'=>$vat_tu['ten_goi'],
                            'content'=>$vat_tu['ten'],
                            'gia_tien'=>$vat_tu['thanh_tien'],
                            'soluong_goi'=>$vat_tu['soluong_goi'],
                        ]);
                        $detail->save();
                    }
                }
            }

            DB::commit();
        }
        catch (\Exception $e){
            DB::rollBack();
            return response()->json([
                'success'=>0,
                'message'=>$e->getMessage()

            ]);
        }
        return response()->json([
            'success'=>1,
            'message'=>'Thêm mới thành công'
        ]);
    }
    public function update($id)
    {
    }


}