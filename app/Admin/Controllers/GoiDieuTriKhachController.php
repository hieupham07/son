<?php

namespace App\Admin\Controllers;

use App\Models\GoiDieuTriKhach;
use App\Models\KhachHang;
use App\Models\GoiDieuTri;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class GoiDieuTriKhachController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'GoiDieuTriKhach';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new GoiDieuTriKhach());
        $trang_thai = [
            1 => ['text' => 'Còn'],
            0 => ['text' => 'Hết'],
        ];
        $grid->quickSearch();
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
        // $grid->khach_hang_id('Tên Khách Hàng')->filter('like');
        // $grid->goi_dt_id('Gói Điều Trị')->filter('like');
        $grid->trang_thai("Trạng Thái")->switch($trang_thai);
        $grid->filter(function ($filter) {
            // Remove the default id filter
            $filter->disableIdFilter();
            // Add a column filter
            $filter->like('khach_hang_id', 'Tên Khách hàng');
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
        $show = new Show(GoiDieuTriKhach::findOrFail($id));
        $show->khach_hang_id("Tên Khách Hàng");
        $show->goi_dt_id('Gói điều trị');
        $show->trang_thai('Trạng Thái');
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
        $form = new Form(new GoiDieuTriKhach());
        $form->select('khach_hang_id','Tên Khách Hàng')->options(KhachHang::all()->pluck('ho_ten', 'id'));
        $form->select('goi_dt_id','Gói điều trị')->options(GoiDieuTri::all()->pluck('ten', 'id'));
        $form->radio('trang_thai','Trạng Thái')->options([1 => 'Còn', 0=> 'Hết'])->default(1);
        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');
        return $form;
    }
}
