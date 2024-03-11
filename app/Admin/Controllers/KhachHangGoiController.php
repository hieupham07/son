<?php

namespace App\Admin\Controllers;

use App\Models\KhachHangGoi;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class KhachHangGoiController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'KhachHangGoi';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new KhachHangGoi());
        $grid->id('ID')->sortable();
        $grid->	ten('Tên gói');
        $grid->mo_ta("Mô tả");
        $grid->so_buoi("Số buổi điều trị");
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
        $show = new Show(KhachHangGoi::findOrFail($id));
        $show->id('ID');
        $show->ten("Tên Gói");
        $show->mo_ta('Mô tả');
        $show->so_buoi('Số buổi điều trị');
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
        $form = new Form(new KhachHangGoi());
        $form->display('id', 'ID');
        $form->text('ten',"Tên")->required();
        $form->textarea('mo_ta',"Mô tả");
        $form->text('so_buoi',"Số buổi điều trị");
        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');
        return $form;
    }
}
