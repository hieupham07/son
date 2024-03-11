<?php
namespace App\Admin\Controllers;
use App\Admin\Extensions\EmployeeExport;
use App\Admin\Extensions\EmployeeExporter;
use App\Models\LoaiVatTu;
use App\Models\DongGoi;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LoaiVatTuController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Loại Vật Tư';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        $grid = new Grid(new LoaiVatTu());
        $grid->quickSearch();
        $grid->id('ID')->sortable();
        $grid->ten('Tên')->filter('like');
        $grid->mo_ta("Mô tả");
        $grid->column('goi_id','Đóng gói')->display(function ($goi_id) {
            $goi=DongGoi::find($goi_id);
            if($goi) {
                return $goi->ten;
            }
        });
        $grid->filter(function ($filter) {
            // Remove the default id filter
            $filter->disableIdFilter();
            // Add a column filter
            $filter->like('ten', 'Tên Loại vật tư');
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
        $show = new Show(LoaiVatTu::findOrFail($id));
        $show->panel()
            ->style('danger')
            ->title('Miêu tả')
            ->tools(function ($tools) {
                // $tools->disableEdit();
            });
        $show->ten("Tên");
        $show->mo_ta('Mô tả');
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

        $form = new Form(new LoaiVatTu());
        $form->display('id', 'ID');
        $form->text('ten',"Tên")->required();
        $form->textarea('mo_ta',"Mô tả");
        $form->select('goi_id','Đóng gói')->options(DongGoi::all()->pluck('ten', 'id'));
        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');
        // $form->confirm('Thêm mới', 'create');
        return $form;
    }
    public function employees(Request $request)
    {
        // $q = $request->get('q');

        // return Employee::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }
    public function export()
    {
        // $details = DB::select("SELECT e.*,d.`name` as department,b.`name` as branch, m.name as manage_name FROM hrm_employees as e LEFT JOIN hrm_departments as d ON e.department_id=d.id LEFT JOIN branches as b on e.branch_id=b.id LEFT JOIN hrm_employees as m on e.manage_by=m.id", []);
        // $data = new EmployeeExport($details);
        // return Excel::download($data, 'danh_sach_nhan_vien_'. time() . '.xlsx');

    }
}
