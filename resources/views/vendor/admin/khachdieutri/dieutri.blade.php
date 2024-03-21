<div class="themgoidieutri clearfix" style="background: #fff;">
    <div class="box-header with-border">
        <h3 class="box-title">Thêm mới Gói Điều Trị</h3>

        <div class="box-tools">
            <div class="btn-group pull-right" style="margin-right: 5px">
                <a href="http://localhost/son/public/admin/phieu-thus" class="btn btn-sm btn-default" title="List"><i class="fa fa-list"></i><span class="hidden-xs">&nbsp;List</span></a>
            </div>
        </div>
    </div>
    <form action="http://localhost/son/public/admin/dieu-tri/{{$khach->id}}" method="POST" id="create-order-form">
        <div class="box-body">

            <div class="fields-group">
                <div class="form-group clearfix">
                    <label for="ten" class="col-sm-2 asterisk control-label  text-right">Mã Phiếu Thu</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                            <input required="1" type="text" id="ten_khach" name="ten_khach" value="{{$khach->ho_ten}}" class="form-control ten" placeholder="Input mã khách hàng" readonly>
                            <input class="khach_id" name="khach_id" type="hidden"  value="{{$khach->id}}">
                        </div>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label for="ten" class="col-sm-2  control-label  text-right">Gói điều trị</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                            @foreach($ls_goi_dt as $gdt)
                            @if($gdt->id == $goi_dt_cua_khach->goi_dt_id)
                            <input required="1" type="text" id="goi_dt" name="goi_dt" value="{{$gdt->ten}}" class="form-control ten" placeholder="Input mã khách hàng" readonly>
                            @endif
                            @endforeach

                        </div>
                    </div>
                    <label for="ten" class="col-sm-2  text-right">Số buổi còn lại</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                            <input required="1" type="text" id="sl_buoi" name="sl_buoi" value="{{$goi_dt_cua_khach->sl_buoi}}" class="form-control ten" placeholder="Input mã khách hàng" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group clearfix">
                    <label for="ten" class="col-sm-2 asterisk control-label  text-right">Điều Trị</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <select name="dieutri" class="form-control" id="dieutri">
                                <option value="">-- trọn điều trị --</option>
                                @foreach($ls_dt as $dt)
                                @if($dt->so_buoi <= $goi_dt_cua_khach->sl_buoi)
                                <option value="{{ $dt->id }}" @if($dt->id == old('created_by')) selected @endif>{{ $dt->ten}}</option>
                                @endif
                                @endforeach
                                <input class="buoi_dt" name="buoi_dt" type="hidden"  value="">
                            </select>
                            <div id="khach_dt_b" style="display:none">
                                @foreach($ls_dt as $dt)
                                <div class="buoi" data-id="{{ $dt->id }}" data-ten="{{ $dt->ten }}" data-so_buoi="{{ $dt->so_buoi }}" ></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group" style="float: right">
                <input class="pth_btn btn btn-primary" type="submit" value="Lưu">
                <a class="btn btn-danger" onclick="history.back()">Quay lại</a>
            </div>
        </div>
    </form>
</div>
<script type="javascript">
    $('.pth_btn').attr('disabled', 'disabled');
    var ls_khach_dt_b = [];
    $('#khach_dt_b').find('.buoi').each(function() {
        if($(this).attr('data-id') != ''){
            let dt = {
                'id' : $(this).attr('data-id'),
                'ten' : $(this).attr('data-ten'),
                'so_buoi' : $(this).attr('data-so_buoi'),
            }
            ls_khach_dt_b.push(dt);
        }
    });
    // console.log(ls_khach_dt_b);
    $('#dieutri').on('change' ,function() {
        let vt = $(this).val();
        if( vt != '' && vt != null){
            $('.pth_btn').removeAttr("disabled");
            ls_khach_dt_b.forEach((element)=>{
            if(vt == element.id){
                $('.buoi_dt').val(element.so_buoi);

            }
        });
        }
        else{
            $('.pth_btn').attr( 'disabled', 'disabled' );
        }
    });
    $("#create-order-form").submit(function (e) {
        e.preventDefault();
        let url = $(this).attr('action');
        var data = $(this).serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: url,
            data: data,
            dataType: 'json',
            success: function(result) {
                console.log(result);
                if (result.success == 1) {
                    toastr.success(result.message);


                } else {
                    toastr.error(result.message);
                }
            },
        });
    });
</script>
