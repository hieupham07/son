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
                    {!! Form::select('month', $months,$monthSelected,['placeholder' => 'Tháng...','class' => 'form-control pull-left', 'id'=>'month', 'style'=>'width:20%']) !!}
                    {!! Form::select('year', $years,$yearsSelected,['placeholder' => 'Năm...','class' => 'form-control pull-left', 'id'=>'year', 'style'=>'width:20%']) !!}
                    <div class="input-group-btn" style="display: inline-block;">
                        <button type="button" class="btn btn-default" id="btnSubmitReport"><i class="fa fa-search"></i></button>
                        <a href="#" class="btn btn-sm btn-default" onclick="exportReportSalaryEmployee(); return false;" id="btn-export-salary-total">Xuất Excel</a>
                    </div>

{{--                    <a href="/admin/report/view-salary" style="margin-left: 30px;">Xem bảng lương tháng</a>--}}
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    @if($details!=null)
                        <div class="row" id="report_employee_table">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Chi tiết bảng doanh số theo phòng ban {!! $code !!}</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body no-padding">

                                    @if($code=='tele' || $code=='tele2')
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th style="width: 10px">STT</th>
                                                <th>Họ và tên Nhân viên</th>
                                                <th>Mức khoán</th>
                                                <th>Mức khoán HN</th>
                                                <th>Mức khoán HCM</th>
                                                <th>Khoán khách đến cửa</th>
                                                <th>Doanh số HN</th>
                                                <th>Doanh số HCM</th>
                                                <th>Khách đến cửa</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $i = 1;
                                                $total_muc_khoan_tel=0;$total_khoan_hn_tel=0;$total_khoan_hcm_tel=0;$total_khoan_vao_cua_tel=0;$total_ds_hn_tel=0;$total_ds_hcm_tel=0;$total_vao_cua_hien_tai_tel=0;$total_tong_tien_tel=0;
                                            @endphp
                                            @foreach($details as $key=> $detail)
                                                @php
                                                $total_muc_khoan_tel+=$detail->muc_khoan;
                                                $total_khoan_hn_tel+=$detail->khoan_tn_hcm+$detail->khoan_qc_hcm;
                                                $total_khoan_hcm_tel+=$detail->khoan_tn_hcm+$detail->khoan_qc_hcm;
                                                $total_khoan_vao_cua_tel+=$detail->khoan_vao_cua;
                                                $total_ds_hn_tel+=$detail->tn_hn +$detail->qc_hn+$detail->tn_tp +$detail->qc_tp+$detail->tn_34ntmk +$detail->qc_34ntmk;
                                                $total_ds_hcm_tel+=$detail->tn_hcm +$detail->qc_hcm;
                                                $total_vao_cua_hien_tai_tel+=$detail->vao_cua_hien_tai;
                                                $total_tong_tien_tel+=$detail->tn_hn +$detail->qc_hn+$detail->tn_hcm +$detail->qc_hcm+$detail->tn_34ntmk +$detail->qc_34ntmk;
                                                @endphp
                                                <tr>
                                                    <td>{!! $key+1 !!}</td>
                                                    <td>{!! $detail->name !!}</td>
                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->muc_khoan !!}</span>
                                                    </td>
                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->khoan_tn_hn+$detail->khoan_qc_hn !!}</span>
                                                    </td>
                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->khoan_tn_hcm+$detail->khoan_qc_hcm !!}</span>
                                                    </td>
                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->khoan_vao_cua !!}</span>
                                                    </td>

                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->tn_hn +$detail->qc_hn+$detail->qc_tp+$detail->tn_tp+$detail->tn_34ntmk +$detail->qc_34ntmk!!}</span>
                                                    </td>

                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->tn_hcm +$detail->qc_hcm!!}</span>
                                                    </td>

                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->vao_cua_hien_tai !!}</span>
                                                    </td>
                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->tn_hn +$detail->qc_hn+$detail->tn_hcm +$detail->qc_hcm +$detail->qc_tp+$detail->tn_tp+$detail->tn_34ntmk +$detail->qc_34ntmk!!}</span>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                            <tfoot align="center">
                                            <tr>
                                                <td></td>
                                                <td style="font-weight: bold; font-size: 20px">Tổng</td>
                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_muc_khoan_tel !!}</span>
                                                </td>
                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_khoan_hn_tel !!}</span>
                                                </td>
                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_khoan_hcm_tel !!}</span>
                                                </td>
                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_khoan_vao_cua_tel !!}</span>
                                                </td>

                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_ds_hn_tel !!}</span>
                                                </td>

                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_ds_hcm_tel !!}</span>
                                                </td>

                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_vao_cua_hien_tai_tel !!}</span>
                                                </td>
                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_tong_tien_tel !!}</span>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    @elseif($code=='tu_van')
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th style="width: 10px">STT</th>
                                                <th>Họ và tên Nhân viên</th>
                                                <th>Mức khoán</th>
                                                <th>Khoán quảng cáo</th>
                                                <th>Khoán trải nghiệm</th>
                                                <th>Doanh số sản phẩm</th>
                                                <th>Doanh số Family</th>
                                                <th>Doanh số DT UID</th>
                                                <th>Doanh thu tư vấn TN</th>
                                                <th>Doanh thu QC Sale</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $i = 1;
                                                $total_muc_khoan_tu_van=0;
                                                $total_tong_tien_tu_van=0;
                                                $total_khoan_qc_tu_van=0;
                                                $total_khoan_tn_tu_van=0;
                                                $total_sp_tu_van=0;
                                                $total_family_tu_van=0;
                                                $total_dt_uid_tu_van=0;
                                                $total_dt_tv_tn_tu_van=0;
                                                $total_dt_qc_sale_tu_van=0;
                                            @endphp
                                            @foreach($details as $key=> $detail)
                                                @php
                                                    $total_muc_khoan_tu_van+=$detail->muc_khoan;
                                                    $total_khoan_qc_tu_van+=$detail->khoan_qc_hn+$detail->khoan_qc_hcm;
                                                    $total_khoan_tn_tu_van+=$detail->khoan_tn_hn+$detail->khoan_tn_hcm;
                                                    $total_sp_tu_van+= $detail->sp_hn+$detail->sp_hcm;
                                                    $total_family_tu_van+=$detail->family_hn +$detail->family_hcm;
                                                    $total_dt_uid_tu_van+=$detail->dt_uid_hn +$detail->dt_uid_hcm;
                                                    $total_dt_tv_tn_tu_van+=$detail->dt_tv_tn;
                                                    $total_dt_qc_sale_tu_van+=$detail->dt_qc_sale;
                                                    $total_tong_tien_tu_van+=$detail->tong_tien;

                                                @endphp
                                                <tr>
                                                    <td>{!! $key+1 !!}</td>
                                                    <td>{!! $detail->name !!}</td>
                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->muc_khoan !!}</span>
                                                    </td>
                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->khoan_qc_hn+$detail->khoan_qc_hcm !!}</span>
                                                    </td>

                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->khoan_tn_hn+$detail->khoan_tn_hcm !!}</span>
                                                    </td>

                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->sp_hn+$detail->sp_hcm !!}</span>
                                                    </td>

                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->family_hn +$detail->family_hcm!!}</span>
                                                    </td>

                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->dt_uid_hn +$detail->dt_uid_hcm!!}</span>
                                                    </td>

                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->dt_tv_tn !!}</span>
                                                    </td>
                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->dt_qc_sale !!}</span>
                                                    </td>
                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->tong_tien !!}</span>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                            <tfoot align="center">
                                            <tr>
                                                <td></td>
                                                <td style="font-weight: bold; font-size: 20px">Tổng</td>
                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_muc_khoan_tu_van !!}</span>
                                                </td>
                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_khoan_qc_tu_van !!}</span>
                                                </td>
                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_khoan_tn_tu_van !!}</span>
                                                </td>
                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_sp_tu_van !!}</span>
                                                </td>

                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_family_tu_van !!}</span>
                                                </td>

                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_dt_uid_tu_van !!}</span>
                                                </td>

                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_dt_tv_tn_tu_van !!}</span>
                                                </td>
                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_dt_qc_sale_tu_van !!}</span>
                                                </td>
                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_tong_tien_tu_van !!}</span>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                        @elseif($code=='tro_thu')
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th style="width: 10px">STTdd</th>
                                                <th>Họ và tên Nhân viên</th>
                                                <th>Mức khoán</th>
                                                <th>Khoán quảng cáo</th>
                                                <th>Khoán trải nghiệm</th>
                                                <th>Doanh số sản phẩm</th>
                                                <th>Doanh số Family</th>
                                                <th>Doanh số DT UID</th>
                                                <th>Doanh thu tư vấn TN</th>
                                                <th>Doanh thu qc Sale</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $i = 1;
                                                $total_muc_khoan_tro_thu=0;
                                                $total_tong_tien_tro_thu=0;
                                                $total_khoan_qc_tro_thu=0;
                                                $total_khoan_tn_tro_thu=0;
                                                $total_sp_tro_thu=0;
                                                $total_family_tro_thu=0;
                                                $total_dt_uid_tro_thu=0;
                                                $total_dt_tv_tn_tro_thu=0;
                                                $total_dt_qc_sale_tro_thu=0;
                                            @endphp
                                            @foreach($details as $key=> $detail)
                                                @php
                                                    $total_muc_khoan_tro_thu+=$detail->muc_khoan;
                                                    $total_khoan_qc_tro_thu+=$detail->khoan_qc_hn+$detail->khoan_qc_hcm;
                                                    $total_khoan_tn_tro_thu+=$detail->khoan_tn_hn+$detail->khoan_tn_hcm;
                                                    $total_sp_tro_thu+= $detail->sp_hn+$detail->sp_hcm+$detail->sp_tp;
                                                    $total_family_tro_thu+=$detail->family_hn +$detail->family_hcm+$detail->family_tp;
                                                    $total_dt_uid_tro_thu+=$detail->dt_uid_hn +$detail->dt_uid_hcm;
                                                    $total_dt_tv_tn_tro_thu+=$detail->dt_tv_tn;
                                                    $total_dt_qc_sale_tro_thu+=$detail->dt_qc_sale;
                                                    $total_tong_tien_tro_thu+=$detail->tong_tien;

                                                @endphp
                                                <tr>
                                                    <td>{!! $key+1 !!}</td>
                                                    <td>{!! $detail->name !!}</td>
                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->muc_khoan !!}</span>
                                                    </td>
                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->khoan_qc_hn+$detail->khoan_qc_hcm !!}</span>
                                                    </td>

                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->khoan_tn_hn+$detail->khoan_tn_hcm !!}</span>
                                                    </td>

                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->sp_hn+$detail->sp_hcm+$detail->sp_tp !!}</span>
                                                    </td>

                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->family_hn +$detail->family_hcm+$detail->family_tp!!}</span>
                                                    </td>

                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->dt_uid_hn +$detail->dt_uid_hcm!!}</span>
                                                    </td>

                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->dt_tv_tn !!}</span>
                                                    </td>
                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->dt_qc_sale !!}</span>
                                                    </td>
                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->tong_tien !!}</span>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                            <tfoot align="center">
                                            <tr>
                                                <td></td>
                                                <td style="font-weight: bold; font-size: 20px">Tổng</td>
                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_muc_khoan_tro_thu !!}</span>
                                                </td>
                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_khoan_qc_tro_thu !!}</span>
                                                </td>
                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_khoan_tn_tro_thu !!}</span>
                                                </td>
                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_sp_tro_thu !!}</span>
                                                </td>

                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_family_tro_thu !!}</span>
                                                </td>

                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_dt_uid_tro_thu !!}</span>
                                                </td>

                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_dt_tv_tn_tro_thu !!}</span>
                                                </td>
                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_dt_qc_sale_tro_thu !!}</span>
                                                </td>
                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_tong_tien_tro_thu !!}</span>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    @else
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th style="width: 10px">STT</th>
                                                <th>Họ và tên Nhân viên</th>
                                                <th>Tổng tiền</th>
                                                <th>Trải nghiệm HN</th>
                                                <th>Trải nghiệm HCM</th>
                                                <th>Quảng cáo HN</th>
                                                <th>Quảng cáo HCM</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $i = 1;
                                                $total_tong_tien=0;$total_tn_hn=0;$total_tn_hcm=0;$total_qc_hn=0;$total_qc_hcm=0;
                                            @endphp
                                            @foreach($details as $key=> $detail)
                                                @php
                                                    $total_tong_tien+=$detail->tong_tien;
                                                    $total_tn_hn+=$detail->tn_hn;
                                                    $total_tn_hcm+=$detail->tn_hcm;
                                                    $total_qc_hn+=$detail->qc_hn;
                                                    $total_qc_hcm+=$detail->qc_hcm;
                                                @endphp
                                                <tr>
                                                    <td>{!! $key+1 !!}</td>
                                                    <td>{!! $detail->name !!}</td>
                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->tong_tien !!}</span>
                                                    </td>
                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->tn_hn !!}</span>
                                                    </td>
                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->tn_hcm !!}</span>
                                                    </td>
                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->qc_hn !!}</span>
                                                    </td>
                                                    <td>
                                                        <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $detail->qc_hcm !!}</span>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <td></td>
                                                <td style="font-weight: bold; font-size: 20px">Tổng</td>
                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_tong_tien !!}</span>
                                                </td>
                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_tn_hn !!}</span>
                                                </td>
                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_tn_hcm !!}</span>
                                                </td>
                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_qc_hn !!}</span>
                                                </td>
                                                <td>
                                                    <span class="info-box-number display_currency badge bg-light-blue" data-currency_symbol="false">{!! $total_qc_hcm !!}</span>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    @endif

                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12"><span style="color: red">Chưa có dữ liệu bảng lương tháng này</span></div>
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
            var url = new URL(window.location.href);
            url.searchParams.set('department',department);
            url.searchParams.set('month',month);
            url.searchParams.set('year',year);
            window.location.href = url.href;
        })
    });
</script>