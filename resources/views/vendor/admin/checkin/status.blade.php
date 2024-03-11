<style>
    .employee-img img{
        width: 100px;
        height: 100px;
		border-radius: 50%;
		border: 2px solid #f1809e;

    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="box grid-box" style="padding-top: 20px">
            <div class="box-header with-border">
                {!! Form::open([
                    'url'=>'/admin/hrm/employee-status',
                    'method'=>'get',
                    'id'=>'form_checkin_status'
                ])!!}
                    <div class="input-group input-group-sm" style="display: inline-block; width: 100%">
                        {!! Form::select('device_id', $devices,null,['placeholder' => 'Chọn phòng...','class' => 'form-control pull-left', 'id'=>'device_id', 'style'=>'width:20%']) !!}
                        <input type="text" name="search"  class="form-control grid-quick-search pull-left" autofocus="autofocus" value=""  placeholder="Nhận mã thẻ/ Mã vân tay nhân viên và Enter" style="width: 70%; float: left">
                        <div class="input-group-btn" style="display: inline-block;">
                            <button type="submit" class="btn btn-default" id="btnSearch"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="box-body">
                @foreach($employees as $employee)
                    <div class="col-md-3">
                        <div class="box ">
                            <div class="box-header with-border">
                                <h3 class="box-title">{!! $employee->name !!}</h3>
                                <div class="box-tools pull-right">
                                    <!-- Buttons, labels, and many other things can be placed here! -->
                                    <!-- Here is a label for example -->
                                    @if($employee->working_status!=null)
                                        <span class="label label-primary">
                                     {!! $employee->device_name !!}
                                </span>
                                    @endif

                                </div>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="pull-left employee-img">
                                    <img src="{!! $employee->picture_path !!}">
                                </div>
                                <div class="pull-right">
                                    Chức vụ:
                                    @if($employee->position!=null)
                                        <strong> {!! $employee->position->name !!}</strong>
                                    @endif <br>
                                    Phòng ban:
                                    @if($employee->department!=null)
                                        <span> {!! $employee->department->name !!}</span>
                                    @endif <br>
                                    Thời gian vào: <span>{!! date('H:i:s',strtotime($employee->time_in)) !!}</span>
                                </div>

                            </div>

                        </div>
                        <!-- /.box -->
                    </div>
                @endforeach
                    <div class="clearfix"></div>
            </div>


        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function () {
       // setInterval(refreshPage,60000)
    });
    function refreshPage() {
        $.admin.reload();
        $.admin.toastr.success('{{ __('admin.refresh_succeeded') }}', '', {positionClass:"toast-top-center"});
    }
</script>