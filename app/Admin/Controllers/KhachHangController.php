<?php

namespace App\Admin\Controllers;

use App\Models\KhachHang;
use App\Models\GoiDieuTri;
use App\Models\KhachHangGoi;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class KhachHangController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'KhachHang';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new KhachHang());
        $sex = [
            1 => ['text' => 'Nam'],
            0 => ['text' => 'Nữ'],
        ];
        $grid->quickSearch();
        $grid->id('ID')->sortable();
        $grid->ma_khach('Mã Khách Hàng')->filter('like');
        $grid->ho_ten('Họ và tên')->filter('like');
        $grid->gioi_tinh("Giới tính")->switch($sex);
        $grid->ngay_sinh('Ngày sinh');
        $grid->dien_thoai('Điện thoại');
        $grid->dia_chi('Địa chỉ');
        // $grid->column('goi_id','Gói điều trị')->display(function ($goi_id) {
        //     $goi=GoiDieuTri::find($goi_id);
        //     if($goi) {
        //         return $goi->ten;
        //     }
        // });
        // $grid->column('kh_goi_id','Điều trị ngay')->display(function ($goi_dt_id) {
        //     $goi_dt=KhachHangGoi::find($goi_dt_id);
        //     if($goi_dt) {
        //         return $goi_dt->ten;
        //     }
        // });
        $grid->filter(function ($filter) {
            // Remove the default id filter
            $filter->disableIdFilter();
            // Add a column filter
            $filter->like('ho_ten', 'Tên Khách hàng');
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
    protected function detail($id)
    {
        $show = new Show(KhachHang::findOrFail($id));
        $show->ma_khach("Mã Khách Hàng");
        $show->ho_ten("Họ và tên");
        $show->ngay_sinh("Ngày sinh");
        $show->gioi_tinh()->using([1 => 'Nam', 0 => 'Nữ']);
        $show->dien_thoai("Điện thoại");
        $show->dien_thoai1("Điện thoại1");
        $show->dia_chi("Địa chỉ");

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new KhachHang());
        $form->text('ho_ten',"Họ và tên")->required();
        $form->hidden('ma_khach');
        $form->date('ngay_sinh','Ngày sinh');
        $form->radio('gioi_tinh','Giới tính')->options([1 => 'Nam', 0=> 'Nữ'])->default(1);
        $form->text('dien_thoai',"Điện thoại")
        ->creationRules(['required', "unique:khach_hangs,dien_thoai"])
        ->updateRules(['required', "unique:khach_hangs,dien_thoai,{{id}}"]);

        $form->text('dien_thoai1',"Điện thoại")
        ->creationRules(['required', "unique:khach_hangs,dien_thoai"])
        ->updateRules(['required', "unique:khach_hangs,dien_thoai1,{{id}}"]);;
        $form->text('dia_chi',"Địa chỉ");
        $form->text('ghi_chu',"Ghi chú");

        // $form->select('goi_id','Gói điều trị')->options(GoiDieuTri::all()->pluck('ten', 'id'));
        // $form->select('kh_goi_id','Điều trị ngay')->options(KhachHangGoi::all()->pluck('ten', 'id'));
        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');
        $form->saving(function (Form $form) {
            $form->ma_khach = $form->ho_ten;
        });
        return $form;
    }
}
