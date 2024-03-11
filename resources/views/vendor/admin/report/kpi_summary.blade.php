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
                    {!! Form::select('month', $months,$monthSelected,['placeholder' => 'Tháng...','class' => 'form-control pull-left', 'id'=>'month', 'style'=>'width:20%']) !!}
                    {!! Form::select('year', $years,$yearsSelected,['placeholder' => 'Năm...','class' => 'form-control pull-left', 'id'=>'year', 'style'=>'width:20%']) !!}
                    <div class="input-group-btn" style="display: inline-block;">
                        <button type="button" class="btn btn-default" id="btnSubmitReport"><i class="fa fa-search"></i></button>
{{--                        <a href="#" class="btn btn-sm btn-default" onclick="exportReportBounus(); return false;" id="btn-export-salary-total">Xuất Excel</a>--}}
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    @if($details!=null)
                        <div class="row" id="report_employee_table">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Thống kê KPI</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th style="width: 10px">STT</th>
                                            <th>Ngày/Tháng/Năm</th>
                                            <th>Hài Lòng</th>
                                            <th>Chưa có phản hồi</th>
                                            <th>Không hài lòng</th>
                                            <th>Bác sỹ</th>
                                            <th>Trợ thủ</th>
                                            <th>Kinh doanh</th>
                                            <th>Khác</th>
                                            <th>Phàn nàn</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($details as $key=> $detail)
                                            <tr>
                                                <td>{!! $key+1 !!}</td>
                                                <td>{!! $detail->ngay_kham_benh !!}</td>
                                                <td>{!! round($detail->HL,2) !!}</td>
                                                <td>{!! round($detail->CPH,2) !!}</td>
                                                <td>{!! round($detail->A,2) !!}</td>
                                                <td>{!! round($detail->B,2) !!}</td>
                                                <td>{!! round($detail->C,2) !!}</td>
                                                <td>{!! round($detail->D,2) !!}</td>
                                                <td>{!! round($detail->E,2) !!}</td>
                                                <td>
                                                    {!! round($detail->PN,2) !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr style="font-weight: bold">
                                            <td></td>
                                            <td>{!! $total->ngay_kham_benh !!}</td>
                                            <td>{!! round($total->HL,2) !!}</td>
                                            <td>{!! round($total->CPH,2) !!}</td>
                                            <td>{!! round($total->A,2) !!}</td>
                                            <td>{!! round($total->B,2) !!}</td>
                                            <td>{!! round($total->C,2) !!}</td>
                                            <td>{!! round($total->D,2) !!}</td>
                                            <td>{!! round($total->E,2) !!}</td>
                                            <td>
                                                {!! round($total->PN,2) !!}
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
            let month=$('#month').val();
            let year=$('#year').val();
            var url = new URL(window.location.href);
            url.searchParams.set('month',month);
            url.searchParams.set('year',year);
            window.location.href = url.href;
        })
    });
</script>