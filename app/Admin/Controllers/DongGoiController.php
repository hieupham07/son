<?php

namespace App\Admin\Controllers;

use App\Models\DongGoi;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DongGoiController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'DongGoi';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new DongGoi());
        $grid->quickSearch();
        $grid->id('ID')->sortable();
        $grid->ten('Tên')->filter('like');
        $grid->ghi_chu("Ghi chú")->ucfirst()->limit(130);
        $grid->filter(function ($filter) {
            // Remove the default id filter
            $filter->disableIdFilter();
            // Add a column filter
            $filter->like('ten', 'Tên thủ thuật');
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
        $show = new Show(DongGoi::findOrFail($id));
        // $show->panel()
        // ->style('danger')
        // ->title('Thủ thuật- Chi tiết')
        // ->tools(function ($tools) {
        //     // $tools->disableEdit();
        // });
        $show->ten("Tên Gói");
        $show->ghi_chu('Miêu tả');
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
        $form = new Form(new DongGoi());
        $form->display('id', 'ID');
        $form->text('ten',"Tên gói")->required();
        $form->textarea('ghi_chu',"Ghi chú");
        // $form->radio('required_qty','Trạng thái')->options([1 => 'Tính theo sl', 0=> 'Không tính theo sl'])->default(0);
        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');
        return $form;
    }
}
