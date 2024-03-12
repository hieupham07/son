<?php

namespace App\Admin\Controllers;

use App\Models\KhachHang;
use App\Models\VatTu;
use App\Models\GoiDieuTri;
use App\Models\GoiDieuTriDetail;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class GoiDieuTriDetailController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'GoiDieuTriDetail';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new GoiDieuTriDetail());
        $grid->column('id', __('Id'));
        $grid->column('goidieutri_id','Gói Điều Trị')->display(function ($khach_hang_id) {
            $goidieutri=GoiDieuTri::find($goidieutri_id);
            if($goidieutri) {
                return $goidieutri->teb->filter('like');
            }
        });
        $grid->column('vattu_id','Tên Vật tư')->display(function ($goi_dt_id) {
            $vattu=VatTu::find($vattu_id);
            if($vattu) {
                return $vattu->ten->filter('like');
            }
        });
        $grid->column('so_luong', __('Số lượng vật tư'));
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
        $show = new Show(GoiDieuTriDetail::findOrFail($id));

        $show->goidieutri_id("Gói Điều Trị");
        $show->vattu_id('Vật Tư');
        $show->so_luong('Số lượng');
        // $show->created_at();
        // $show->updated_at();
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new GoiDieuTriDetail());
        $form->select('goidieutri_id','Gói Điều Trị')->options(GoiDieuTri::all()->pluck('ten', 'id'));
        $form->select('vattu_id','Tên vật tư')->options(VatTu::all()->pluck('ten', 'id'));
        $form->text('so_luong','Số Lượng');
        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');
        return $form;
    }
}
