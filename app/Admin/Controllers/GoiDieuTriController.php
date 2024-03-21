<?php

namespace App\Admin\Controllers;

use App\AdminUser;

use App\Models\GoiDieuTri;
use App\Models\GoiDieuTriDetail;
use App\Models\VatTu;
use Encore\Admin\Admin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\DB;

class GoiDieuTriController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'GoiDieuTri';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new GoiDieuTri());

        $grid->quickSearch();
        $grid->id('ID')->sortable();
        $grid->ten('Tên Gói Điều Trị')->filter('like');
        $grid->mo_ta("Mô tả");
        $grid->gia("Giá");
        $grid->giam_gia("Giá ưu đãi");
        $grid->so_buoi("Số buổi");
        $grid->filter(function ($filter) {
            // Remove the default id filter
            $filter->disableIdFilter();
            // Add a column filter
            $filter->like('ten', 'Tên Gói Điều Trị');
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
        $show = new Show(GoiDieuTri::findOrFail($id));
        $show->id('ID');
        $show->ten("Tên");
        $show->mo_ta('Mô tả');
        $show->gia('Giá');
        $show->so_buoi('Số buổi');
        $show->created_at();
        $show->updated_at();
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    // protected function form()
    // {
    //     $form = new Form(new GoiDieuTri());
    //     $form->display('id', 'ID');
    //     $form->text('ten',"Tên")->required();
    //     $form->textarea('mo_ta',"Mô tả");
    //     $form->text('gia',"Giá");
    //     $form->text('so_buoi',"Số buổi");
    //     $form->textarea('ghi_chu',"Ghi chú");
    //     $form->display('created_at', 'Created At');
    //     $form->display('updated_at', 'Updated At');
    //     return $form;
    // }

    public function show($id, Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['show'] ?? trans('admin.show'))
            ->body(self::editComponent($id));
    }
    public static function createComponent()
    {
        $vattu=VatTu::all();
        return Admin::component('admin::goidieutri.create', compact('vattu'));
        // return view('vendor.admin.quote.create');/
    }
    public static function editComponent($id)
    {
        // $users=AdminUser::where('enable',true)->get();
        $order=GoiDieuTri::with(['goidt','dungcugoi'])->find($id);
        $vattu=VatTu::all();
        return Admin::component('admin::goidieutri.edit', compact('vattu','order'));
    }
    public function create(Content $content)
    {
        return \Encore\Admin\Facades\Admin::content(function (Content $content) {
            $content->header('Thêm Gói điều trị');
            $content->description('Thêm Gói điều trị');
            $content->body(self::createComponent());
        });
    }
    public function edit($id, Content $content)
    {
       return $content
       ->title($this->title())
       ->description($this->description['edit'] ?? trans('admin.edit'))
       ->body(self::editComponent($id));

   }
   public function update($id)
   {
    $data=request()->all();

    try {
        DB::beginTransaction();
            //Tạo gới trang bị
            $goidieutri=GoiDieuTri::find($id);
            $goidieutri->fill([
            'ten'=>$data['ten'],
            'mo_ta'=>$data['mo_ta'],
            'gia'=>$data['gia'],
            'giam_gia'=>$data['giam_gia'],
            'so_buoi'=>$data['so_buoi'],
            'ghi_chu'=>$data['ghi_chu'],
        ]);

            //  dd($data);
        $goidieutri->save();

        GoiDieuTriDetail::where('goidieutri_id', $id)->delete();

        $vat_tus = json_decode($data['vat_tu_goi'], true);
        if($vat_tus){
            foreach ($vat_tus as $vat_tu) {
                $detail= new GoiDieuTriDetail([
                    'goidieutri_id'=>(int)$goidieutri->id,
                    'vattu_id'=> (int)$vat_tu['id'],
                    'so_luong'=>$vat_tu['soluong_vt'],
                ]);
                $detail->save();
            }
        }
        // lưu chi tiết gới
        DB::commit();
    }catch (\Exception $e)
    {
        DB::rollBack();
        return response()->json([
            'success'=>0,
            'message'=>$e->getMessage()
        ]);
    }
    return response()->json([
        'success'=>1,
        'message'=>'Cập nhật thành công'
    ]);
   }

   public function store()
   {
    $data=request()->all();

    try {
        DB::beginTransaction();
            //Tạo gới trang bị
        $goidieutri= new GoiDieuTri([
            'ten'=>$data['ten'],
            'mo_ta'=>$data['mo_ta'],
            'gia'=>$data['gia'],
            'giam_gia'=>$data['giam_gia'],
            'so_buoi'=>$data['so_buoi'],
            'ghi_chu'=>$data['ghi_chu'],
        ]);

            //  dd($data);
        $goidieutri->save();


        $vat_tus = json_decode($data['vat_tu_goi'], true);

        if($vat_tus){
            foreach ($vat_tus as $vat_tu) {
                $detail= new GoiDieuTriDetail([
                    'goidieutri_id'=>(int)$goidieutri->id,
                    'vattu_id'=> (int)$vat_tu['id'],
                    'so_luong'=>$vat_tu['soluong_vt'],
                ]);
                $detail->save();
            }
        }

        // lưu chi tiết gới


        DB::commit();
    }catch (\Exception $e)
    {
        DB::rollBack();
        return response()->json([
            'success'=>0,
            'message'=>$e->getMessage()
        ]);
    }
    return response()->json([
        'success'=>1,
        'message'=>'Thêm mới thành công'
    ]);


}
}