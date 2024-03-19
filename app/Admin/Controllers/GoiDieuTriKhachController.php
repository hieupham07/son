<?php

namespace App\Admin\Controllers;

use App\Models\GoiDieuTriKhach;
use App\Models\KhachHang;
use App\Models\KhachHangGoi;

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

        $grid->quickSearch();
        $grid->id('ID')->sortable();
        $grid->column('khach_hang_id','Tên Khách Hàng')->display(function ($khach_hang_id) {
            $khach= KhachHang::find($khach_hang_id);
            if($khach) {
                return $khach->ho_ten;
            }
        });
        $grid->column('goi_dt_id','Gói điều trị')->display(function ($goi_dt_id) {
            $goi=GoiDieuTri::find($goi_dt_id);
            if($goi) {
                return $goi->ten;
            }
        });


        $grid->sl_buoi("Số Buổi Còn");
        // $grid->filter(function ($filter) {
        //     // Remove the default id filter
        //     $filter->disableIdFilter();
        //     // Add a column filter
        //     $filter->like('khach_hang_id', 'Tên Khách hàng');
        // });
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

        $show->sl_buoi('Số Buổi Còn');
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

        $form->text('sl_buoi',"Số Buổi còn lại");
        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');
        return $form;
    }
}