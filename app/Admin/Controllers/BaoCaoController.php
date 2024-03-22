<?php

namespace App\Admin\Controllers;

use App\Models\PhieuThu;
use App\Models\BaoCao;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Admin;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\DB;


class BaoCaoController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'BaoCao';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new BaoCao());

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
        $show = new Show(BaoCao::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new BaoCao());



        return $form;
    }
    public static function viewBCtuanComponent(){
        $month = date('m');
        $year=date('Y');
        $day=date('d');
        $departmentSelected=1;
        if(request()->has('month')) {
            $month=request()->month;
        }
        if(request()->has('year'))
        {
            $year=request()->year;
        }
        if(request()->has('day'))
        {
            $day=request()->day;
        }
        $date=$year.'-'.$month.'-'.$day;
        if(request()->has('department'))
        {
            $departmentSelected=request()->department;
        }
        $months=array(
            '01'=>'Tháng 1',
            '02'=>'Tháng 2',
            '03'=>'Tháng 3',
            '04'=>'Tháng 4',
            '05'=>'Tháng 5',
            '06'=>'Tháng 6',
            '07'=>'Tháng 7',
            '08'=>'Tháng 8',
            '09'=>'Tháng 9',
            '10'=>'Tháng 10',
            '11'=>'Tháng 11',
            '12'=>'Tháng 12',
        );
        $monthSelected=$month;
        $years=array(
            2019=>"Năm 2019",
            2020=>"Năm 2020",
            2021=>"Năm 2021",
            2022=>"Năm 2022",
            2023=>"Năm 2023",
            2024=>"Năm 2024",
            2025=>"Năm 2025",
        );
        $yearsSelected=$year;
        $days=array(
            '01'=>'Ngày 1',
            '02'=>'Ngày 2',
            '03'=>'Ngày 3',
            '04'=>'Ngày 4',
            '05'=>'Ngày 5',
            '06'=>'Ngày 6',
            '07'=>'Ngày 7',
            '08'=>'Ngày 8',
            '09'=>'Ngày 9',
            '10'=>'Ngày 10',
            '11'=>'Ngày 11',
            '12'=>'Ngày 12',
            '13'=>'Ngày 13',
            '14'=>'Ngày 14',
            '15'=>'Ngày 15',
            '16'=>'Ngày 16',
            '17'=>'Ngày 17',
            '18'=>'Ngày 18',
            '19'=>'Ngày 19',
            '20'=>'Ngày 20',
            '21'=>'Ngày 21',
            '22'=>'Ngày 22',
            '23'=>'Ngày 23',
            '24'=>'Ngày 24',
            '25'=>'Ngày 25',
            '26'=>'Ngày 26',
            '27'=>'Ngày 27',
            '28'=>'Ngày 28',
            '29'=>'Ngày 29',
            '30'=>'Ngày 30',
            '31'=>'Ngày 31',
        );
        $daySelected=$day;
        // $phieuthu = PhieuThu::all();
        $phieuthu = DB::select("SELECT t.created_at,t.tien_thanhtoan,t.tien_con, k.ho_ten, g.ten as tem_goi_dt FROM phieu_thus as t
        LEFT JOIN khach_hangs as k ON t.khach_hang_id = k.id
        JOIN goi_dieu_tris as g ON g.id = ( SELECT goi_dt_id FROM goi_dieu_tri_khaches as dt WHERE dt.khach_hang_id = t.khach_hang_id ORDER BY created_at DESC LIMIT 1)");


        return Admin::component('admin::baocao.tuan', compact('monthSelected','months','years','yearsSelected','days','daySelected','phieuthu'));
    }
    public function viewtuan()
    {
        return \Encore\Admin\Facades\Admin::content(function (Content $content) {
            $content->header('Báo cáo Tuần');
            $content->description('Báo cáo Tuần');
            $content->body(self::viewBCtuanComponent());
        });
    }
}
