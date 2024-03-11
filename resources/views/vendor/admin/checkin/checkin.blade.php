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
        <div class="box grid-box" style="display: none">
            <div class="box-header with-border">
                <div class="input-group input-group-sm" style="display: inline-block; width: 100%">
                    {!! Form::select('device_id', $devices,$device_id,['placeholder' => 'Chọn phòng...','class' => 'form-control pull-left', 'id'=>'device_id', 'style'=>'width:20%']) !!}
                    <input type="text" name="txtEmployeeCode" id="txtEmployeeCode" class="form-control grid-quick-search pull-left" autofocus="autofocus" value="" onkeypress="checkinManually(event);" placeholder="Nhận mã thẻ/ Mã vân tay nhân viên và Enter" style="width: 70%; float: left">
                    <div class="input-group-btn" style="display: inline-block;">
                        <button type="button" class="btn btn-default" id="btnSubmit"><i class="fa fa-search"></i></button>
                    </div>
                </div>

            </div>

        </div>
        <div class="box grid-box">
            <div class="box-header with-border">
                <div class="input-group input-group-sm" style="display: inline-block; width: 100%">
                    <input id="text" type="hidden" value="{{$qrcode}}" style="width:100%" /><br />
                    <div id="qrcode" style="width:250px; height:250px;  margin: 0 auto;"></div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="box " style="text-align: center; font-size: 70px;color: #f1809e" id="employee_info">
            Điểm danh {!! $device_name !!}
        </div>
    </div>
</div>
<script type="text/javascript">
    setTimeout(function () {
        location.reload();
    }, 144000 * 1000);
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        width : 250,
        height : 250
    });

    function makeCode () {
        var elText = document.getElementById("text");

        if (!elText.value) {
            alert("Input a text");
            elText.focus();
            return;
        }

        qrcode.makeCode(elText.value);
    }
    makeCode();

</script>