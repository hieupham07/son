<?php

namespace App\Admin\Controllers;

use App\Models\KhachDieuTri;
use App\Models\KhachHang;
use App\Models\GoiDieuTri;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

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
        $grid->so_buoi_con("Số Buổi còn lại");
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
        $show->so_buoi_con("Số Buổi còn lại");
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
        $form->text('so_buoi_con',"Số Buổi còn lại");
        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');
        return $form;
    }
}