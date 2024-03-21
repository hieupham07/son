<?php

namespace App\Admin\Controllers;

use App\Models\DieuTri;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DieuTriController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'DieuTri';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new DieuTri());



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
        $show = new Show(DieuTri::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new DieuTri());



        return $form;
    }

    public function dieutri($id, Content $content)
    {
        return \Encore\Admin\Facades\Admin::content(function (Content $content) {
            $content->header('Điều Trị');
            $content->description('Điều Trị');
            $content->body(self::dieutriComponent());
        });
    }
    public static function dieutriComponent($id)
    {
        $khach = KhachHang::where('id', $id)->first();;
        $ls_dt = KhachHangGoi::all();
        $goi_dt_cua_khach = GoiDieuTriKhach::where('khach_hang_id', $id)->first();
        return Admin::component('admin::dieutri.dieutri', compact('khach','ls_dt','goi_dt_cua_khach'));
    }
}