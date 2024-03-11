<style>
    .employee-img img{
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 2px solid #f1809e;
    }
    .status-checkin-info {
        text-align: center;
        padding-top: 50px;
        font-size: 30px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box grid-box">
            <div class="box-header with-border">
                <div class="input-group input-group-sm" style="display: inline-block; width: 100%">
                    {!! Form::select('month', $months,$monthSelected,['placeholder' => 'Tháng...','class' => 'form-control pull-left', 'id'=>'month', 'style'=>'width:30%']) !!}
                    {!! Form::select('year', $years,$yearsSelected,['placeholder' => 'Năm...','class' => 'form-control pull-left', 'id'=>'year', 'style'=>'width:30%']) !!}
                    <div class="input-group-btn" style="display: inline-block;">
                        <button type="button" class="btn btn-default" id="btnSubmitReport"><i class="fa fa-search"></i></button>
                    </div>
                    <a href="/admin/report/view" style="margin-left: 30px;">Xem báo cáo KPI</a>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">

                    <div class="box ">
                        <div class="box-header with-border">
                            <h3 class="box-title">{!! $employee->name !!}</h3>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="pull-left employee-img">
                                <img src="{!! $employee->picture_path !!}">
                            </div>
                            <div class="pull-left" style="padding-top: 50px; padding-left: 20px;">
                                Chức vụ:
                                @if($employee->position!=null)
                                    <strong> {!! $employee->position->name !!}</strong>
                                @endif <br>
                                Phòng ban:
                                @if($employee->department!=null)
                                    <span> {!! $employee->department->name !!}</span>
                                @endif <br>
                            </div>
                        </div>
                    </div>
                    @if($report!=null)
                    <div class="row" id="report_employee_table">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Chi tiết bảng lương</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                                <table class="table table-striped">
                                    <tbody><tr>
                                        <th style="width: 10px">STT</th>
                                        <th>Nội dung</th>
                                        <th>Giá trị</th>
                                    </tr>
                                    <tr>
                                        <td>1.</td>
                                        <td>Ngày Công thực tế</td>
                                        <td>
                                            <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $report->ngay_cong_thuc_te !!}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>Trừ ngày phép</td>
                                        <td>
                                            <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">0</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3.</td>
                                        <td>Lương ngày công thực tế</td>
                                        <td>
                                            <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $report->luong_ngay_cong_thuc_te !!}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4.</td>
                                        <td>Lương KPI</td>
                                        <td>
                                            <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $report->luong_kpi !!}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5.</td>
                                        <td>Số giờ công thêm giờ</td>
                                        <td>
                                            <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $report->so_gio_lam_them !!}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6.</td>
                                        <td>Lương thêm giờ</td>
                                        <td>
                                            <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $report->luong_them_gio !!}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7.</td>
                                        <td>Phụ cấp tiền ăn</td>
                                        <td>
                                            <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $report->phu_cap_an_trua !!}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8.</td>
                                        <td>Phụ cấp trách nhiệm</td>
                                        <td>
                                            <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $report->phu_cap_trach_nhiem !!}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>9.</td>
                                        <td>Phụ cấp gửi xe</td>
                                        <td>
                                            <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $report->phu_cap_gui_xe !!}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>10.</td>
                                        <td>Lương doanh số</td>
                                        <td>
                                            <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $report->luong_doanh_so !!}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>11.</td>
                                        <td>Truy thu lương/ Tạm ứng lương</td>
                                        <td>
                                            <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $report->truy_thu_luong !!}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>12.</td>
                                        <td>Thưởng</td>
                                        <td>
                                            <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $report->thuong !!}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>13.</td>
                                        <td>Tiền lãi ký quỹ</td>
                                        <td>
                                            <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $report->lai_tien_ky_quy !!}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>14.</td>
                                        <td>Tổng lương tháng</td>
                                        <td>
                                            <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $report->tong_luong !!}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>15.</td>
                                        <td>Trừ ký quỹ</td>
                                        <td>
                                            <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $report->tru_tien_ky_quy !!}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>16.</td>
                                        <td>Phạt</td>
                                        <td>
                                            <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $report->phat !!}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>17.</td>
                                        <td>Trừ BHXH</td>
                                        <td>
                                            <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $report->tru_bhxh !!}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>18.</td>
                                        <td>Quỹ hoạt động chung</td>
                                        <td>
                                            <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $report->tru_quy_hoat_dong_chung !!}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>19.</td>
                                        <td>Truy thu lại tiền</td>
                                        <td>
                                            <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $report->tam_ung_luong !!}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>20.</td>
                                        <td>Lương còn lại</td>
                                        <td>
                                            <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $report->so_tien_thuc_linh !!}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>21.</td>
                                        <td>STK</td>
                                        <td>
                                            {!! $report->stk !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>22.</td>
                                        <td>Ngân hàng</td>
                                        <td>
                                            {!! $report->ngan_hang !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>23.</td>
                                        <td>Cộng lũy kế</td>
                                        <td>
                                            <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $report->cong_luy_ke_ky_quy !!}</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    @else
                        <div class="row">
                            <div class="col-md-12"><span style="color: red">Chưa có dữ liệu bảng lương tháng này</span></div>
                        </div>
                    @endif
                    <!-- /.box -->
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        //Date range picker
        __currency_convert_recursively($('#report_employee_table'));
        $('#btnSubmitReport').click(function (e) {
            let month=$('#month').val();
            let year=$('#year').val();
            var url = new URL(window.location.href);
            url.searchParams.set('month',month);
            url.searchParams.set('year',year);
            window.location.href = url.href;
        })
    });
</script>