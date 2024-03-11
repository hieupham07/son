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
                    {!! Form::select('department', $departments,1,['placeholder' => 'Phòng ban...','class' => 'form-control pull-left', 'id'=>'department', 'style'=>'width:20%']) !!}
                    {!! Form::select('day', $days,$daySelected,['placeholder' => 'Ngày...','class' => 'form-control pull-left', 'id'=>'day', 'style'=>'width:20%']) !!}
                    {!! Form::select('month', $months,$monthSelected,['placeholder' => 'Tháng...','class' => 'form-control pull-left', 'id'=>'month', 'style'=>'width:20%']) !!}
                    {!! Form::select('year', $years,$yearsSelected,['placeholder' => 'Năm...','class' => 'form-control pull-left', 'id'=>'year', 'style'=>'width:20%']) !!}
                    <div class="input-group-btn" style="display: inline-block;">
                        <button type="button" class="btn btn-default" id="btnSubmitReport"><i class="fa fa-search"></i></button>
                        <a href="#" class="btn btn-sm btn-default" onclick="exportReportBounus(); return false;" id="btn-export-salary-total">Xuất Excel</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    @if($details!=null)
                        <div class="row" id="report_employee_table">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Chi tiết thưởng nóng</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th style="width: 10px">STT</th>
                                            <th>Mã nhân viên</th>
                                            <th>Họ và tên Nhân viên</th>
                                            <th>Phòng ban</th>
                                            <th>Giờ vào</th>
                                            <th>Giờ ra</th>
                                            <th>Ngày công thực tế</th>
                                            <th>Tổng tiền</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($details as $key=> $detail)
                                            <tr>
                                                <td>{!! $key+1 !!}</td>
                                                <td>{!! $detail->enroll_number !!}</td>
                                                <td>{!! $detail->employee_name !!}</td>
                                                <td>{!! $detail->department_name !!}</td>
                                                <td>{!! $detail->time_in !!}</td>
                                                <td>{!! $detail->time_out !!}</td>
                                                <td>{!! $detail->total_day !!}</td>
                                                <td>
                                                    <span class="info-box-number display_currency" data-currency_symbol="false">{!! $detail->tong_tien !!}</span>
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
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        //Date range picker
        __currency_convert_recursively($('#report_employee_table'));
        $('#btnSubmitReport').click(function (e) {
            let department=$('#department').val();
            let month=$('#month').val();
            let year=$('#year').val();
            let day=$('#day').val();
            var url = new URL(window.location.href);
            url.searchParams.set('department',department);
            url.searchParams.set('month',month);
            url.searchParams.set('year',year);
            url.searchParams.set('day',day);
            window.location.href = url.href;
        })
    });
</script>