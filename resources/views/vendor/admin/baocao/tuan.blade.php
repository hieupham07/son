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
                    {{-- {!! Form::select('department', $departments,1,['placeholder' => 'Phòng ban...','class' => 'form-control pull-left', 'id'=>'department', 'style'=>'width:20%']) !!} --}}
                    {{-- {!! Form::select('day', $days,$daySelected,['placeholder' => 'Ngày...','class' => 'form-control pull-left', 'id'=>'day', 'style'=>'width:20%']) !!}
                    {!! Form::select('month', $months,$monthSelected,['placeholder' => 'Tháng...','class' => 'form-control pull-left', 'id'=>'month', 'style'=>'width:20%']) !!}
                    {!! Form::select('year', $years,$yearsSelected,['placeholder' => 'Năm...','class' => 'form-control pull-left', 'id'=>'year', 'style'=>'width:20%']) !!} --}}
                    <div class="input-group-btn" style="display: inline-block;">
                        <button type="button" class="btn btn-default" id="btnSubmitReport"><i class="fa fa-search"></i></button>
                        <a href="#" class="btn btn-sm btn-default" onclick="exportReportBounus(); return false;" id="btn-export-salary-total">Xuất Excel</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    @if($phieuthu!=null)
                        <div class="row" id="report_employee_table">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Báo cáo theo tuần</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th> Ngày </th>
                                            <th>Giờ</th>
                                            <th>Họ và tên</th>
                                            <th>Gói Điều trị</th>
                                            <th>Chi Phí</th>
                                            <th>Tiền Nơ</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $tongtien = 0; $tt_nu = 0; ?>
                                            @foreach($phieuthu as $detail)
                                            <?php $tongtien += $detail->tien_thanhtoan;  $tt_nu += $detail->tien_con; ?>
                                            {{-- {{dd($detail)}} --}}
                                            <tr>
                                                <td>{!! date('d-m-Y', strtotime($detail->created_at)) !!}</td>
                                                <td>{!! date('H:i', strtotime($detail->created_at)) !!}</td>
                                                <td>{!! $detail->ho_ten !!}</td>
                                                {{-- <td></td> --}}
                                                <td>{!! $detail->tem_goi_dt !!}</td>
                                                <td>{!! number_format($detail->tien_thanhtoan) !!}</td>
                                                <td>{!! $detail->tien_con !!}</td>

                                            </tr>

                                        @endforeach

                                        <tr>
                                            <th colspan="4"> Tổng Tiền : </th>
                                            <td> {{ number_format($tongtien, 0);}} </th>
                                                <td> {{$tt_nu}} </th>
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
