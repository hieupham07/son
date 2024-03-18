<?php

namespace App\Admin\Controllers;

use App\Models\PhieuThuDetail;
use App\Models\PhieuThu;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PhieuThuDetailController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'PhieuThuDetail';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PhieuThuDetail());
        $grid->quickSearch();
        $grid->column('phieu_thu_id','Mã Phiếu Thu')->display(function ($goi_id) {
            $goi=PhieuThu::find($goi_id);
            if($goi) {
                return $goi->ma_phieuthu;
            }
        });
        $grid->tieu_de('Loại Hình');
        $grid->content("Tên Loại");
        $grid->gia_tien("Giá Tiền");
        $grid->soluong_goi("Số Lượng");
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
        $show = new Show(PhieuThuDetail::findOrFail($id));
        $show->phieu_thu_id("Mã Phiếu Thu");
        $show->tieu_de('Loại Hình');
        $show->content('Tên Loại');
        $show->gia_tien('Giá Tiền');
        $show->soluong_goi('Số Lượng');
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
        $form = new Form(new PhieuThuDetail());
        $form->text('phieu_thu_id',"Mã Phiếu Thu");
        $form->text('tieu_de','Loại Hình');
        $form->text('content','Tên Loại');
        $form->text('gia_tien','Giá Tiền');
        $form->text('soluong_goi','Số Lượng');
        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');
        return $form;
    }
}
