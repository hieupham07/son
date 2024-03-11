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
                <div  class="input-group input-group-sm" style="display: inline-block; width: 100%">
                    <div class="clearfix">
                        <select name="employee_id" class="form-control" id="employee_id" style="width: 100%; float: left;">
                            <option value="">-- Chọn nhân viên để xem dữ liệu --</option>
                        </select>
                        <div class="input-group-btn" style="display: none;">
                            <button type="button" class="btn btn-default" id="btnSubmitReport"><i class="fa fa-search"></i>Xem dữ liệu</button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    @if($employee!=null)
                        <div class="box " id="report_employee_table">
                            <div class="box-header with-border">
                                <h3 class="box-title">{!! $employee->name !!}</h3>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="pull-left employee-img">
                                    <img src="{!! $employee->picture_path !!}">
                                </div>
                                <div class="pull-left" style="padding-left: 15px;">
                                    Chức vụ:
                                    @if($employee->position!=null)
                                        <strong> {!! $employee->position->name !!}</strong>
                                    @endif <br>
                                    Phòng ban:
                                    @if($employee->department!=null)
                                        <span> {!! $employee->department->name !!}</span>
                                    @endif <br>
                                    Ngày sinh:
                                    @if($employee->birthday!=null)
                                        <span> {!! date('d/m/Y',strtotime($employee->birthday)) !!}</span>
                                    @endif <br>
                                    Ngày vào làm:
                                    @if($employee->begin_date!=null)
                                        <span> {!! date('d/m/Y',strtotime($employee->begin_date)) !!}</span
                                    @endif <br>
                                    Email:
                                    @if($employee->email!=null)
                                        <span> {!! $employee->email !!}</span>
                                    @endif <br>
                                    Tổng lỗi phạt (6 tháng gần nhất)
                                    <span class="display_currency" data-currency_symbol="false">{!! $employee->total_salary_minus !!}</span>
                                    <br>
                                    Cộng lũy kế ký quỹ
                                    <span class="display_currency" data-currency_symbol="false">{!! $employee->cong_luy_ke_ky_quy !!}</span>
                                </div>

                            </div>

                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12"><span style="color: red">Không có dữ liệu</span></div>
                        </div>
                    @endif

                </div>
                <div class="clearfix"></div>
            </div>

            <div class="box-body">
                <div class="col-md-12">
                    @if($process_salary!=null)
                        <div class="row" id="report_process_salary_table">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Biến động lương cơ bản</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th style="width: 10px">STT</th>
                                            <th>Từ ngày</th>
                                            <th>Đến ngày</th>
                                            <th>Mức lương thay đổi</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($process_salary as $key=> $detail)
                                            <tr>
                                                <td>{!! $key+1 !!}</td>
                                                <td>{!! date('d/m/Y',strtotime($detail->from_date)) !!}</td>
                                                <td>
                                                    @if($detail->to_date!=null)
                                                        {!! date('d/m/Y',strtotime($detail->to_date)) !!}
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="info-box-number display_currency" data-currency_symbol="false">{!! $detail->salary !!}</span>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12"><span style="color: red">Không có dữ liệu</span></div>
                        </div>
                    @endif

                </div>
                <div class="clearfix"></div>
            </div>

            <div class="box-body">
                <div class="col-md-12">
                    @if($total_salary!=null)
                        <div class="row" id="report_total_salary_table">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Tổng thu nhập 6 tháng gần nhất</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>

                                            @foreach($total_salary as $key=> $detail)
                                                <th>{!! $detail['title'] !!}</th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach($total_salary as $key=> $detail)
                                                    <td>
                                                        <span class="info-box-number display_currency" data-currency_symbol="false">{!! $detail['value'] !!}</span>
                                                    </td>
                                                @endforeach
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12"><span style="color: red">Không có dữ liệu</span></div>
                        </div>
                    @endif

                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#employee_id').select2({
            placeholder: 'Chọn nhân viên để xem dữ liệu...',
            delay: 250,
            escapeMarkup: function(markup) {
                return markup;
            },
            templateResult: function(data) {
                return data.html;
            },
            templateSelection: function(data) {
                return data.text;
            },
            ajax: {
                url: "/admin/api/employees",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page || 1
                    };
                },
                processResults: function (res, params) {
                    let data = res.data;
                    let page = params.page || 1;
                    return {
                        results: $.map(data, function(item) {
                            return {
                                title: item.text,
                                text: item.text,
                                id: item.id,
                                html: item.text,
                                data: item
                            };
                        }),
                        pagination: {
                            more: page * 5 <= res.total
                        }
                    };
                },
                cache: true
            }
        }).on('select2:select', function (e) {
            let employee_id=$('#employee_id').val();
            var url = new URL(window.location.href);
            url.searchParams.set('employee_id',employee_id);
            window.location.href = url.href;
        }).trigger('change');
        //Date range picker
        __currency_convert_recursively($('#report_total_salary_table'));
        __currency_convert_recursively($('#report_process_salary_table'));
        __currency_convert_recursively($('#report_employee_table'));
        $('#btnSubmitReport').click(function (e) {
            let employee_id=$('#employee_id').val();
            var url = new URL(window.location.href);
            url.searchParams.set('employee_id',employee_id);
            window.location.href = url.href;
        })
    });
</script>