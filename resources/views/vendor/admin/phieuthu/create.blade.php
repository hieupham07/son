

<div class="themgoidieutri clearfix" style="background: #fff;">
    <div class="box-header with-border">
        <h3 class="box-title">Thêm mới Gói Điều Trị</h3>

        <div class="box-tools">
            <div class="btn-group pull-right" style="margin-right: 5px">
                <a href="http://localhost/son/public/admin/phieu-thus" class="btn btn-sm btn-default" title="List"><i class="fa fa-list"></i><span class="hidden-xs">&nbsp;List</span></a>
            </div>
        </div>
    </div>
    <form action="{{ route("admin.phieu-thus.store") }}" method="POST" id="create-order-form">

        <div class="box-body">

            <div class="fields-group">

                <div class="col-md-12">
                    <div class="form-group clearfix">
                        <label for="ten" class="col-sm-2 asterisk control-label  text-right">Mã Phiếu Thu</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                <input required="1" type="text" id="ma_phieuthu" name="ma_phieuthu" value="" class="form-control ten" placeholder="Input mã khách hàng">
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label for="mo_ta" class="col-sm-2  control-label  text-right">Họ và tên</label>
                        <div class="col-sm-4">
                            <input required="1" type="text" id="ho_ten" name="ho_ten" value="" class="form-control ho_ten" placeholder="Input Tên">
                        </div>
                        <label for="mo_ta" class="col-sm-2  control-label text-right">Số điện thoại</label>
                        <div class="col-sm-4">
                            <input required="1" type="text" id="dien_thoai" name="dien_thoai" value="" class="form-control dien_thoai" placeholder="SĐT">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label for="mo_ta" class="col-sm-2  control-label  text-right">Ngày Sinh</label>
                        <div class="col-sm-4">
                            <input required="1" type="text" id="ngay_sinh" name="ngay_sinh" value="" class="form-control ngay_sinh" placeholder="Ngày Sinh">
                        </div>
                        <label for="mo_ta" class="col-sm-2  control-label text-right">Địa Chỉ</label>
                        <div class="col-sm-4">
                            <input required="1" type="text" id="dia_chi" name="dia_chi" value="" class="form-control dia_chi" placeholder="Địa Chi">
                        </div>
                    </div>
                    <div class="col-md-12" id="tron_goidt">
                        <div class="form-group clearfix">
                            <label for="gia" class="col-sm-2  control-label  text-right">Gói Điều Trị</label>
                            <div class="col-sm-8">
                                <select name="goidieutri" class="form-control" id="goidieutri">
                                    <option value="">-- trọn gói điều trị --</option>
                                    @foreach($ls_goi_dt as $gdt)
                                    <option value="{{ $gdt->id }}" @if($gdt->id == old('created_by')) selected @endif>{{ $gdt->ten}}</option>
                                    @endforeach
                                </select>
                                <div id="ls_goidt">
                                    @foreach($ls_goi_dt as $gdt)
                                    <div class="goidt" data-id="{{ $gdt->id }}" data-name="{{ $gdt->ten }}" data-gia="{{ $gdt->gia }}" data-gia-giam="{{ $gdt->giam_gia }}" style="display: none;"></div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <span class="themgoi btn btn-primary ">Thêm Gói</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" id="tron_thuoc">
                        <div class="form-group clearfix">
                            <label for="gia" class="col-sm-2  control-label  text-right">Thuốc Điều Trị</label>
                            <div class="col-sm-8">
                                <select name="thuoc" class="form-control" id="thuoc">
                                    <option value="">-- trọn thuốc điều trị --</option>
                                    @foreach($ls_thuoc as $thuoc)
                                    <option value="{{ $thuoc->id }}" @if($gdt->id == old('created_by')) selected @endif>{{ $thuoc->ten}}</option>
                                    @endforeach
                                </select>
                                <div id="ls_thuoc">
                                    @foreach($ls_thuoc as $thuoc)
                                    <div class="ls_thuoc" data-id="{{ $thuoc->id }}" data-name="{{ $thuoc->ten }}"  style="display: none;"></div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <span class="themthuoc btn btn-primary">Thêm thuốc</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered" id="products_table">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">STT</th>
                                <th width="65%" class="text-center">Nội Dung Điều Trị</th>
                                <th width="10%" class="text-center">Số lượng</th>
                                <th width="10%" class="text-center">Thành Tiền</th>
                                <th width="10%" class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody class="bang_vattu">
                            {{-- <tr class="vat_tu_">
                                <th width="80%">Tên Vật Tư</th>
                                <th width="10%"><input type="number" value="" min="0" max="100" class="form-control so_luong_vt"></th>
                                <th width="10%"><a class="btn btn-sm btn-danger remove-row"><i class="fa fa-minus-circle"></i></a></th>
                            </tr> --}}
                        </tbody>
                        <tr>
                            <th colspan="3" class="text-center">&ensp; TỔNG TIỀN</th>
                            <th width="10%" class="text-center tong_tien_thu">0</th>
                            <th width="10%" class="text-center"></th>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
        <input class="vat_tu_goi" name="vat_tu_goi" type="hidden"  value="">
        <div class="col-md-12">
            <div class="form-group" style="float: right">
                <input class="btn btn-primary" type="submit" value="Lưu">
                <a class="btn btn-danger" onclick="history.back()">Quay lại</a>
            </div>
        </div>
    </form>
</div>

</div>


<script type="javascript">
    $('.themgoi').attr('disabled', 'disabled');
    $('.themthuoc').attr('disabled', 'disabled');
    var stt = 1;
    var ls_goi_dt = [];
    var tong_tien_thu = 0;
    $('#ls_goidt').find('.goidt').each(function() {
        if($(this).attr('data-id') != ''){
            let dt = {
                'id' : $(this).attr('data-id'),
                'ten' : $(this).attr('data-name'),
                'gia' : $(this).attr('data-gia'),
            }
            ls_goi_dt.push(dt);
        }
    });

    var ds_gdt = [];

    function kt_mang(id){
        let kt = 0
        if(ds_gdt.length > 0){
            ds_gdt.forEach((element)=>{
                if(id == element.id){
                    kt = 1;
                }
            });
        }
        if(kt == 0){
            return false;
        }else{
            return true;
        }

    }
    function tinh_tien(){
        if(ds_gdt.length > 0){
            let tt = 0;
            ds_gdt.forEach((element)=>{
                tt += Number(element.thanh_tien);
            });
            if(tt > 0){
                tong_tien_thu = tt;
                $('#products_table').find('.tong_tien_thu').html(Intl.NumberFormat('en-VN').format(tong_tien_thu) + ' đ');
            }

        }
        else{
            $('#products_table').find('.tong_tien_thu').html( '0 đ');
        }
    }

    $('#tron_goidt').on('click', '.themgoi', function() {
        let id = $('#goidieutri').val();
        if(id != '' && id != null){
            let html ='';
            console.log(kt_mang(id));
            if(kt_mang(id) == true){
                alert('Gói điều trị này đã có');
            }else{
                if(ls_goi_dt.length > 0){
                    ls_goi_dt.forEach((element)=>{
                        if(element.id == id){
                            html = `<tr class="vat_tu_${element.id}" data-id="${element.id}" data-tien="${element.gia}" data-tong-tien="${element.gia}" data-sl="1">
                                <td width="5%" class="text-center">${stt}</td>
                                <td width="65%" class="text-center">Gói điều trị (${element.ten})</td>
                                <td width="10%" class="text-center"><input type="number" value="1" min="0" max="100" class="form-control so_luong_gdt" ></td>
                                <td width="10%" class="text-center thanh_tien">${Intl.NumberFormat('en-VN').format(element.gia)} đ</td>
                                <td width="10%" class="text-center"><a class="btn btn-sm btn-danger remove-row"><i class="fa fa-minus-circle"></i></a></td>
                            </tr>`;
                            let vt = {
                                'id' : element.id,
                                'ten_goi' : 'Gói điều trị',
                                'soluong_goi': 1,
                                'thanh_tien': element.gia,
                            }
                            ds_gdt.push(vt);
                            stt++;
                            tinh_tien();
                        }
                    });
                }
                if( html != ''){
                    $('.bang_vattu').append(html);
                }
                calTotal();
            }
        }
    });

    $('#products_table').on('click', '.remove-row', function() {
        let tr = $(this).closest('tr');
        let id = tr.attr('data-id');
        if(ds_gdt.length > 0){
            ds_gdt.forEach((element)=>{
                if(id == element.id){
                    ds_gdt.splice(element, 1);
                    stt--;
                    tinh_tien();
                }
            });
        }
        console.log(ds_gdt);
        calTotal();
        tr.remove();
    });

    $('#goidieutri').on('change' ,function() {
        let vt = $(this).val();
        if( vt != '' && vt != null){
            $('.themgoi').removeAttr("disabled");
        }
        else{
            $('.themgoi').attr( 'disabled', 'disabled' );
        }
    });
    $('#products_table').on('change keypress keyup', 'input.so_luong_gdt', function() {
        let tr = $(this).closest('tr');
        let num = tr.find('input.so_luong_gdt').val();
        let id = tr.attr('data-id');
        //let sl = Number(tr.attr('data-sl'));
        let stien = Number(tr.attr('data-tien'));
        let tong_tien = num*stien;
        if(ds_gdt.length > 0){
            ds_gdt.forEach((element)=>{
                if(id == element.id){
                    element.soluong_vt = num;
                    element.thanh_tien = tong_tien;
                    tr.attr('data-tong-tien',tong_tien);
                    tr.find('.thanh_tien').html(Intl.NumberFormat('en-VN').format(tong_tien) + ' đ');
                    tinh_tien();
                }
            });
        }

        // $(this).closest('tr').remove();
        calTotal();
    });
    function calTotal(){
        if(ds_gdt.length > 0){
            $('.vat_tu_goi').val(JSON.stringify(ds_gdt));
            console.log($('.vat_tu_goi').val());
        }
    }
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
                    let redirectURL = $('#redirect-route').val();
                    if(redirectURL)
                    window.location.replace(redirectURL);

                } else {
                    toastr.error(result.message);
                }
            },
        });
    });
</script>
