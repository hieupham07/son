<?php

namespace App\Admin\Controllers;

use App\Models\PhieuThu;
use App\Models\KhachHang;
use App\Models\GoiDieuTri;
use App\Models\Thuoc;

use Encore\Admin\Admin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\DB;

class PhieuThuController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'PhieuThu';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PhieuThu());
        $grid->quickSearch();
        // $grid->id('ID')->sortable();
        $grid->ma_phieuthu('Mã Phiếu Thu')->filter('like');

        $grid->column('khach_hang_id','Tên Khách hàng')->display(function ($khach_hang_id) {
            $khach=KhachHang::find($khach_hang_id);
            if($khach) {
                return $khach->ho_ten;
            }
        });
        $grid->column('goi_id','Gói Điều Trị')->display(function ($goi_id) {
            $goi_dt=GoiDieuTri::find($goi_id);
            if($goi_dt) {
                return $goi_dt->ten;
            }
        });
        $grid->tien_thanhtoan("Số tiền thanh Toán");
        $grid->tien_con("Số tiền Còn");
        $grid->filter(function ($filter) {
            // Remove the default id filter
            $filter->disableIdFilter();
            // Add a column filter
            $filter->like('khach_hang_id', 'Tên Khách Hàng');
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
    // protected function detail($id)
    // {
    //     $show = new Show(PhieuThu::findOrFail($id));



    //     return $show;
    // }

    // /**
    //  * Make a form builder.
    //  *
    //  * @return Form
    //  */
    // protected function form()
    // {
    //     $form = new Form(new PhieuThu());



    //     return $form;
    // }
    public function show($id, Content $content)
    {
        return $content
        ->title($this->title('Xem phiếu thu'))
        ->description($this->description['show'] ?? trans('admin.show'))
        ->body(self::editComponent($id));
    }
    public static function createComponent()
    {
        $ls_khach= KhachHang::all();
        $ls_goi_dt = GoiDieuTri::all();
        $ls_thuoc = Thuoc::all();

        return Admin::component('admin::phieuthu.create', compact('ls_khach','ls_goi_dt','ls_thuoc'));
        // return view('vendor.admin.quote.create');/
    }
    public static function editComponent($id)
    {
        // $users=AdminUser::where('enable',true)->get();
        $order= PhieuThu::with(['details','phieuthu'])->find($id);
        $ls_khach= KhachHang::all();
        $ls_goi_dt = GoiDieuTri::all();
        $ls_thuoc = Thuoc::all();
        return Admin::component('admin::phieuthu.edit', compact('order','ls_khach','ls_goi_dt','ls_thuoc'));
    }
    public function create(Content $content)
    {
        return \Encore\Admin\Facades\Admin::content(function (Content $content) {
            $content->header('Thêm Phiếu Thu');
            $content->description('Thêm Phiếu Thu');
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

    // lưu phiếu thu

    public function store()
    {
        $data=request()->all();

        try {
            DB::beginTransaction();
            $ten_khach = '';
            $khach_hang_id = '';

        //kt khách hàng
            $khach_hang = DB::table('khach_hangs') -> where('dien_thoai', '=', $data['dien_thoai']) -> get();
            if($khach_hang){
                $ten_khach = $khach_hang->ho_ten;
                $khach_hang_id = $khach_hang->id;
            }else{
                $khach_hang = DB::table('khach_hangs') ->where('dien_thoai', '=', $data['dien_thoai1']) ->get();
                if($khach_hang){
                    $ten_khach = $khach_hang->ho_ten;
                    $khach_hang_id = $khach_hang->id;
                }else{
                    $khach_hang = new KhachHang([
                        'ho_ten'=>$data['ho_ten'],
                        'ngay_sinh'=>$data['ngay_sinh'],
                        'gioi_tinh'=>$data['gioi_tinh'],
                        'dia_chi'=>$data['dia_chi'],
                        'dien_thoai'=>$data['dien_thoai'],
                    ]);
                    $khach_hang->save();
                }
            }

            //Tạo phiếu Thu
            $phieuthu = new PhieuThu([
                'ma_phieuthu' => $data['ho_ten'],
                'khach_hang_id'=> $khach_hang->id,
                'goi_id' => $data['ho_ten'],
                'tien_thanhtoan'  => $data['tien_thanhtoan'] ,
                'tien_con' => $data['tien_con'] ,
                'ghi_chu' => $data['ghi_chu'] ,
            ]);

            //  dd($data);
            $phieuthu->save();


            $ls_details = json_decode($data['details'], true);
            foreach ($ls_details as $vat_tu) {
                $detail= new PhieuThuDetail([
                    'phieu_thu_id'=>$phieuthu->id,
                    'content'=> $vat_tu,
                ]);
                $detail->save();
            }
        //lưu chi tiết gới
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
    public function update($id)
    {
    }

}
