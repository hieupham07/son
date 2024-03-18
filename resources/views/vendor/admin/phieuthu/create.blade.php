
<style type="text/css">
    .o_tron_hoten{
        position: relative;
    }
    #bang_ten_khach{
        position: absolute;
        top: 100%;
        left: 15px;
        width: calc(100% - 30px );
        background: #ecf0f5;
        z-index: 1;
        display: none
    }
    #bang_ten_khach ul{
        list-style: none;
        padding: 0 ;
        margin: 0;
    }
    #bang_ten_khach li{
        list-style: none;
        cursor: pointer;
        padding: 3px;
    }
    #bang_ten_khach li:hover{
        background: #dbe8f7;
    }
    #bang_ten_khach .close{

    position: absolute;
    top: -15px;
    right: 5px;
    color: #000;
    opacity: 0.6;
    }
    #bang_dienthoai{
        position: absolute;
        top: 100%;
        left: 15px;
        width: calc(100% - 30px );
        background: #ecf0f5;
        z-index: 1;
        display: none
    }
    #bang_dienthoai ul{
        list-style: none;
        padding: 0 ;
        margin: 0;
    }
    #bang_dienthoai li{
        list-style: none;
        cursor: pointer;
        padding: 3px;
    }
    #bang_dienthoai li:hover{
        background: #dbe8f7;
    }
    #bang_dienthoai .close{

    position: absolute;
    top: -15px;
    right: 5px;
    color: #000;
    opacity: 0.6;
    }
</style>
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
                        <div class="col-sm-4 o_tron_hoten">
                            <input required="1" type="text" id="ho_ten" name="ho_ten1" value="" class="form-control ho_ten" placeholder="Input Tên">
                            <div id="bang_ten_khach" data="http://localhost/son/public/admin/phieu-thus/fetchname">

                                <ul class="bang_khach">

                                </ul>
                                <span class="close" style="display: inline;">✖</span>
                            </div>
                            <div id="ls_khachhang" style="display: none">
                                @foreach($ls_khach as $khach)
                                <p class="khach" data-id='{{$khach->id}}' data-name='{{$khach->ho_ten}}' data-dc='{{$khach->dia_chi}}' data-dt='{{$khach->dien_thoai}}'></p>
                                @endforeach
                            </div>
                        </div>
                        <label for="mo_ta" class="col-sm-2  control-label text-right">Số điện thoại</label>
                        <div class="col-sm-4">
                            <input required="1" type="text" id="dien_thoai" name="dien_thoai" value="" class="form-control dien_thoai" placeholder="SĐT">
                            <div id="bang_dienthoai">
                                <ul class="bang_khach">

                                </ul>
                                <span class="close" style="display: inline;">✖</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label for="mo_ta" class="col-sm-2  control-label  text-right">Ngày Sinh</label>
                        <div class="col-sm-4">
                            <input  type="text" id="ngay_sinh" name="ngay_sinh" value="" class="form-control ngay_sinh" placeholder="Input Ngày sinh">
                            {{-- <input  type="text" id="ngay_sinh" name="ngay_sinh" value="" class="form-control ngay_sinh" placeholder="Ngày Sinh"> --}}
                        </div>
                        <label for="mo_ta" class="col-sm-2  control-label text-right">Địa Chỉ</label>
                        <div class="col-sm-4">
                            <input  type="text" id="dia_chi" name="dia_chi" value="" class="form-control dia_chi" placeholder="Địa Chi">
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
                                    <div class="ls_thuoc" data-id="{{ $thuoc->id }}" data-name="{{ $thuoc->ten }}" data-gia="{{ $thuoc->gia }}" data-gia-giam="{{ $thuoc->giam_gia }}"  style="display: none;"></div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <span class="themthuoc btn btn-primary">Thêm thuốc</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label for="ten" class="col-sm-2  control-label  text-right">Số tiền thanh toán</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                <input  type="text" id="tien_thanhtoan" name="tien_thanhtoan" value="" class="form-control ten" placeholder="Input mã khách hàng">
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label for="ten" class="col-sm-2  control-label  text-right">Số tiền còn lại</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                <input  type="text" id="tien_con" name="tien_con" value="0" class="form-control tien_con" placeholder="Input mã khách hàng">
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label for="ten" class="col-sm-2  control-label  text-right">Ghi chú</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                <input  type="text" id="ghi_chu" name="ghi_chu" value="" class="form-control ghi_chu" placeholder="Input mã khách hàng">
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
    var ls_thuoc = [];
    var tong_tien_thu = 0;
    $('#ls_goidt').find('.goidt').each(function() {
        if($(this).attr('data-id') != ''){
            let dt = {
                'id' : $(this).attr('data-id'),
                'ten' : $(this).attr('data-name'),
                'ten_goi' : 'Gói điều trị',
                'gia' : $(this).attr('data-gia'),
            }
            ls_goi_dt.push(dt);
        }
    });
    $('#ls_thuoc').find('.ls_thuoc').each(function() {
        if($(this).attr('data-id') != ''){
            let tt = {
                'id' : $(this).attr('data-id'),
                'ten' : $(this).attr('data-name'),
                'ten_goi' : 'Thuóc',
                'gia' : $(this).attr('data-gia'),
            }
            ls_thuoc.push(tt);
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
                $('#tien_thanhtoan').val(tong_tien_thu);
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
                            html = `<tr class="vat_tu_${element.id}" data-id="${element.id}" data-name="${element.ten_goi}" data-tien="${element.gia}" data-tong-tien="${element.gia}" data-sl="1">
                                <td width="5%" class="text-center">${stt}</td>
                                <td width="65%" class="text-center">Gói điều trị (${element.ten})</td>
                                <td width="10%" class="text-center"><input type="number" value="1" min="0" max="100" class="form-control so_luong_gdt" ></td>
                                <td width="10%" class="text-center thanh_tien">${Intl.NumberFormat('en-VN').format(element.gia)} đ</td>
                                <td width="10%" class="text-center"><a class="btn btn-sm btn-danger remove-row"><i class="fa fa-minus-circle"></i></a></td>
                            </tr>`;
                            let vt = {
                                'id' : element.id,
                                'ten' : 'Gói điều trị ('+element.ten+')',
                                'gia' : element.gia,
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
    function lambang(){
        let html ='';
        let sttt = 1;
        ds_gdt.forEach((element)=>{
            html += `<tr class="vat_tu_${element.id}" data-id="${element.id}" data-name="${element.ten_goi}" data-tien="${element.gia}" data-tong-tien="${element.thanh_tien}" data-sl="${element.soluong_goi}">
                <td width="5%" class="text-center">${sttt}</td>
                <td width="65%" class="text-center">${element.ten}</td>
                <td width="10%" class="text-center"><input type="number" value="${element.soluong_goi}" min="0" max="100" class="form-control so_luong_gdt" ></td>
                <td width="10%" class="text-center thanh_tien">${Intl.NumberFormat('en-VN').format(element.thanh_tien)} đ</td>
                <td width="10%" class="text-center"><a class="btn btn-sm btn-danger remove-row"><i class="fa fa-minus-circle"></i></a></td>
            </tr>`;
            sttt++;
        });
        $('.bang_vattu').html(html);
    }
    $('#products_table').on('click', '.remove-row', function() {
        let tr = $(this).closest('tr');
        let id = tr.attr('data-id');

        let ten_goi = tr.attr('data-name');
        if(ds_gdt.length > 0){
            ds_gdt.forEach((element)=>{
                if(id == element.id && ten_goi == element.ten_goi){
                    let vta = ds_gdt.indexOf(element);
                    console.log(vta);
                    if (vta > -1) {
                        ds_gdt.splice(vta, 1);
                    }
                    stt--;
                    tinh_tien();
                }
            });
        }
        console.log(ds_gdt);
        calTotal();
        tr.remove();
        lambang();
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

    $('#thuoc').on('change' ,function() {
        let vt = $(this).val();
        if( vt != '' && vt != null){
            $('.themthuoc').removeAttr("disabled");
        }
        else{
            $('.themthuoc').attr( 'disabled', 'disabled' );
        }
    });

    $('#tron_thuoc').on('click', '.themthuoc', function() {
        let id = $('#thuoc').val();
        if(id != '' && id != null){
            let html ='';
            console.log(kt_mang(id));
            if(kt_mang(id) == true){
                alert('Gói điều trị này đã có');
            }else{
                if(ls_thuoc.length > 0){
                    ls_thuoc.forEach((element)=>{
                        if(element.id == id ){
                            html = `<tr class="vat_tu_${element.id}" data-id="${element.id}" data-name="${element.ten_goi}" data-tien="${element.gia}" data-tong-tien="${element.gia}" data-sl="1">
                                <td width="5%" class="text-center">${stt}</td>
                                <td width="65%" class="text-center">${element.ten}</td>
                                <td width="10%" class="text-center"><input type="number" value="1" min="0" max="100" class="form-control so_luong_gdt" ></td>
                                <td width="10%" class="text-center thanh_tien">${Intl.NumberFormat('en-VN').format(element.gia)} đ</td>
                                <td width="10%" class="text-center"><a class="btn btn-sm btn-danger remove-row"><i class="fa fa-minus-circle"></i></a></td>
                            </tr>`;
                            let vt = {
                                'id' : element.id,
                                'ten' : element.ten,
                                'gia' : element.gia,
                                'ten_goi' : 'Thuóc',
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

    var ls_khachhang = [];
    $('#ls_khachhang').find('.khach').each(function() {
        if($(this).attr('data-id') != ''){
            let dt = {
                'id' : $(this).attr('data-id'),
                'ho_ten' : $(this).attr('data-name'),
                'dia_chi' : $(this).attr('data-dc'),
                'dien_thoai' : $(this).attr('data-dt'),
            }
            ls_khachhang.push(dt);
        }
    });
    $('#bang_ten_khach .close').click(function(){
        $('#bang_ten_khach').fadeOut();
    });
    $('#ho_ten').keyup(function(){
        let val = $(this).val().trim();
        if((val!= null) && (val != '')){
            let data_s = ls_khachhang.filter(item => item.ho_ten.toLowerCase().indexOf(val) > -1);
            console.log(data_s);
            let html_seach = '';
            if(data_s.length > 0){
                $('#bang_ten_khach').fadeIn();
                data_s.forEach((element)=>{
                    html_seach += `<li class="t_ten" data-id='${element.id}' data-name='${element.ho_ten}' data-dc='${element.dia_chi}' data-dt='${element.dien_thoai}'>${element.ho_ten} (${element.dien_thoai})</li>`;
                });
                $('#bang_ten_khach').find('.bang_khach').html(html_seach);
            }
            else{
            }
        }
    });
    $('#dien_thoai').keyup(function(){
        let val = $(this).val().trim();
        if((val!= null) && (val != '')){
            let data_s = ls_khachhang.filter(item => item.dien_thoai.toLowerCase().indexOf(val) > -1);
            console.log(data_s);
            let html_seach = '';
            if(data_s.length > 0){
                $('#bang_dienthoai').fadeIn();
                data_s.forEach((element)=>{
                    html_seach += `<li class="t_ten" data-id='${element.id}' data-name='${element.ho_ten}' data-dc='${element.dia_chi}' data-dt='${element.dien_thoai}'>${element.dien_thoai}</li>`;
                });
                $('#bang_dienthoai').find('.bang_khach').html(html_seach);
            }
            else{
            }
        }
    });

    $('#bang_dienthoai .bang_khach').on('click', '.t_ten', function() {
        let khach_ten = $(this).attr('data-name');
        let khach_dc = $(this).attr('data-dc');
        let khach_dt = $(this).attr('data-dt');
        $('#ho_ten').val(khach_ten);
        $('#dien_thoai').val(khach_dt);
        $('#dia_chi').val(khach_dc);
        $('#bang_dienthoai').fadeOut();
    });

    $('#bang_ten_khach .bang_khach').on('click', '.t_ten', function() {
        let khach_ten = $(this).attr('data-name');
        let khach_dc = $(this).attr('data-dc');
        let khach_dt = $(this).attr('data-dt');
        $('#ho_ten').val(khach_ten);
        $('#dien_thoai').val(khach_dt);
        $('#dia_chi').val(khach_dc);
        $('#bang_ten_khach').fadeOut();
    });
    $('#tien_thanhtoan').on('change' ,function() {
        let tien_tt = $(this).val().trim();
        let tien_c = tong_tien_thu - tien_tt;
        $('#tien_con').val(tien_c);
    });
    $('#bang_dienthoai .close').click(function(){
        $('#bang_dienthoai').fadeOut();
    });
</script>
