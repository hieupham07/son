<?php

namespace App\Admin\Controllers;

use App\Models\Thuoc;
use App\Models\DongGoi;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ThuocController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Thuoc';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Thuoc());
        $grid->quickSearch();
        $grid->id('ID')->sortable();
        $grid->ten('Tên Thuốc')->filter('like');
        $grid->gia("Giá Thành");
        $grid->giam_gia("Giảm Giá");
        $grid->column('dong_goi_id','Đóng gói')->display(function ($goi_id) {
            $goi=DongGoi::find($goi_id);
            if($goi) {
                return $goi->ten;
            }
        });
        $grid->filter(function ($filter) {
            // Remove the default id filter
            $filter->disableIdFilter();
            // Add a column filter
            $filter->like('ten', 'Tên Thuốc');
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
        $show = new Show(Thuoc::findOrFail($id));
        $show->ten("Tên Thuốc");
        $show->gia('Giá Thành');
        $show->giam_gia('Giảm Giá');
        $show->dong_goi_id('Đóng Gói');
        $show->content('Nội Dung');
        $show->ghi_chu('Ghi Chú');
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
        $form = new Form(new Thuoc());
        $form->display('id', 'ID');
        $form->text('ten',"Tên Thuốc")->required();
        $form->text('gia',"Giá Thành")->default(0);
        $form->text('giam_gia',"Giảm Giá")->default(0);
        $form->select('dong_goi_id','Đóng gói')->options(DongGoi::all()->pluck('ten', 'id'));
        $form->textarea('content',"Nội Dung");
        $form->textarea('ghi_chu',"Ghi Chú");
        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');
        return $form;
    }
}