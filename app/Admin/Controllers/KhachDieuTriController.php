<?php

namespace App\Admin\Controllers;

use App\Models\KhachDieuTri;
use App\Models\KhachHang;
use App\Models\GoiDieuTri;
use App\Models\KhachHangGoi;
use App\Models\GoiDieuTriKhach;
use Encore\Admin\Controllers\AdminController;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Admin;

use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class KhachDieuTriController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'KhachDieuTri';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new KhachDieuTri());
        $grid->id('ID')->sortable();
        $grid->column('khach_hang_id','Tên Khách Hàng')->display(function ($khach_hang_id) {
            $khach=KhachHang::find($khach_hang_id);
            if($khach) {
                return $khach->ho_ten->filter('like');
            }
        });
        $grid->column('goi_dt_id','Gói điều trị')->display(function ($goi_dt_id) {
            $goi=GoiDieuTri::find($goi_dt_id);
            if($goi) {
                return $goi->ten->filter('like');
            }
        });
        $grid->column('goi_dieu_tri_id','Điều trị')->display(function ($khachdt) {
            $dt=KhachHangGoi::find($khachdt);
            if($dt) {
                return $dt->ten;
            }
        });
        $grid->so_buoi_con("Số Buổi còn lại");
        $grid->created_at("Ngày Điều Trị");
        $grid->disableExport();
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(KhachDieuTri::findOrFail($id));
        $show->id('ID');
        $show->khach_hang_id("Tên Khách Hàng");
        $show->goi_dt_id('Gói điều trị');
        $show->goi_dieu_tri_id('Điều trị');
        $show->so_buoi_con("Số Buổi còn lại");
        $show->created_at();
        $show->updated_at();
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new KhachDieuTri());
        $form->select('khach_hang_id','Tên Khách Hàng')->options(KhachHang::all()->pluck('ho_ten', 'id'));
        $form->select('goi_dt_id','Gói điều trị')->options(GoiDieuTri::all()->pluck('ten', 'id'));
        $form->select('goi_dieu_tri_id','Điều trị')->options(KhachHangGoi::all()->pluck('ten', 'id'));
        $form->text('so_buoi_con',"Số Buổi còn lại");
        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');
        return $form;
    }

    public function dieutri($id, Content $content)
    {
        // return \Encore\Admin\Facades\Admin::content(function (Content $content) {
        //     $content->header('Báo cáo nhân viên');
        //     $content->description('Chi tiết báo cáo nhân viên');
        //     $content->body(self::dieutriComponent($id));
        // });

        return $content
        ->title($this->title())
        ->description($this->description['Phiếu Điều Trị'] ?? trans('admin.show'))
        ->body(self::dieutriComponent($id));
    }
    public static function dieutriComponent($id)
    {
        $khach = KhachHang::where('id', $id)->first();;
        $ls_dt = KhachHangGoi::all();
        $goi_dt_cua_khach = GoiDieuTriKhach::orderBy('khach_hang_id', 'DESC')->where('khach_hang_id', $id)->first();
        $ls_goi_dt = GoiDieuTri::all();
        // $ten_goi_dt = GoiDieuTri::where('id', $goi_dt_cua_khach->goi_dt_id)->first();
        return Admin::component('admin::khachdieutri.dieutri', compact('khach','ls_dt','goi_dt_cua_khach','ls_goi_dt'));
        //return Admin::component('admin::report.report', compact('employee','report','monthSelected','months','years','yearsSelected','days','daySelected','departments','details','code'));
    }

    public function themdieutri(Request $request){
        $data=request()->all();
        try {
            DB::beginTransaction();

            $sl_buoi_con = $data['sl_buoi'] - $data['buoi_dt'];

            $goidieutri = GoiDieuTriKhach::orderBy('khach_hang_id', 'DESC')->where('khach_hang_id', $data['khach_id'])->first();
            $goidieutri->fill([
                'sl_buoi'=>$sl_buoi_con,
            ]);
            // $goidieutri->save();
            $khachdieutri = new KhachDieuTri([
                'khach_hang_id'=>$data['khach_id'],
                'goi_d_t_id'=>$goidieutri->goi_dt_id,
                'goi_dieu_tri_id'=>$data['dieutri'],
                'so_buoi_con'=>$sl_buoi_con,
            ]);
            return response()->json([
                'success'=>1,
                'message'=>$khachdieutri
            ]);
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
//         public function dieutri($id)
// {
//     $khach = KhachHang::where('id', $id)->first();

//     $ls_dt = KhachHangGoi::all();
//     $goi_dt_cua_khach = GoiDieuTriKhach::where('khach_hang_id', $id)->first();
//     if($goi_dt_cua_khach->sl_buoi > 0){
//         return view('vendor.admin.dieutri.dieutri', ['khach' => $khach ,'ls_dt' => $ls_dt,'goi_dt_cua_khach'=>$goi_dt_cua_khach]);
//     }
//     else{
//         return view('vendor.admin.dieutri.taodieutri', ['khach' => 'hết buổi điều trị']);
//     }

//     // return Admin::component('admin::dieutri.taodieutri', compact('khach','ls_dt','goi_dt_cua_khach'));


// }
// public function khachdieutri($id)
// {
//     $data=request()->all();
//     // $post = Post::find($id);//trả về một instance model
// }
}
