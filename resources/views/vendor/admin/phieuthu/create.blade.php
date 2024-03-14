

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
                        <label for="ten" class="col-sm-2 asterisk control-label">Mã Phiếu Thu</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                <input required="1" type="text" id="ma_phieuthu" name="ma_phieuthu" value="" class="form-control ten" placeholder="Input mã khách hàng">
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label for="mo_ta" class="col-sm-2  control-label">Họ và tên</label>
                        <div class="col-sm-8">
                            <input required="1" type="text" id="ho_ten" name="ho_ten" value="" class="form-control ho_ten" placeholder="Input Tên">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <label for="mo_ta" class="col-sm-2  control-label">Số điện thoại</label>
                        <div class="col-sm-8">
                            <input required="1" type="text" id="dien_thoai" name="dien_thoai" value="" class="form-control dien_thoai" placeholder="SĐT">
                        </div>
                    </div>
                    <div class="col-md-12" id="tron_vattu">
                        <div class="form-group clearfix">
                            <label for="gia" class="col-sm-2  control-label">Gói Điều Trị</label>

                            <div class="col-sm-8">
                                <select name="vattu" class="form-control" id="vattu">
                                    <option value="">-- trọn gói điều trị --</option>
                                    @foreach($ls_goi_dt as $gdt)
                                    <option value="{{ $gdt->id }}" @if($gdt->id == old('created_by')) selected @endif>{{ $gdt->ten}}</option>
                                    @endforeach
                                </select>
                                <div id="ls_vt">
                                    @foreach($ls_goi_dt as $gdt)
                                    <div class="ls_vt" data-id="{{ $gdt->id }}" data-name="{{ $gdt->ten }}"  style="display: none;"></div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <span class="themvattu btn btn-primary">Thêm Gói</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" id="tron_vattu">
                        <div class="form-group clearfix">
                            <label for="gia" class="col-sm-2  control-label">Thuốc Điều Trị</label>

                            <div class="col-sm-8">
                                <select name="vattu" class="form-control" id="vattu">
                                    <option value="">-- trọn thuốc điều trị --</option>
                                    @foreach($ls_goi_dt as $gdt)
                                    <option value="{{ $gdt->id }}" @if($gdt->id == old('created_by')) selected @endif>{{ $gdt->ten}}</option>
                                    @endforeach
                                </select>
                                <div id="ls_vt">
                                    @foreach($ls_goi_dt as $gdt)
                                    <div class="ls_vt" data-id="{{ $gdt->id }}" data-name="{{ $gdt->ten }}"  style="display: none;"></div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <span class="themvattu btn btn-primary">Thêm Gói</span>
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
                                <th width="80%">Tên Vật Tư</th>
                                <th width="10%">Số lượng</th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                        <tbody class="bang_vattu">
                            {{-- <tr class="vat_tu_">
                                <th width="80%">Tên Vật Tư</th>
                                <th width="10%"><input type="number" value="" min="0" max="100" class="form-control so_luong_vt"></th>
                                <th width="10%"><a class="btn btn-sm btn-danger remove-row"><i class="fa fa-minus-circle"></i></a></th>
                            </tr> --}}
                        </tbody>
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
    $('.themvattu').attr('disabled', 'disabled');
    var ls_vat_tu = [];
    $('#ls_vt').find('.ls_vt').each(function() {
        if($(this).attr('data-id') != ''){
            let vt = {
                'id' : $(this).attr('data-id'),
                'ten_vt' : $(this).attr('data-name'),
            }
            ls_vat_tu.push(vt);
        }
    });

    var vattus = [];
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
    function kt_mang(id){
        let kt = 0
        if(vattus.length > 0){
            vattus.forEach((element)=>{
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

    $('#tron_vattu').on('click', '.themvattu', function() {
        let id = $('#vattu').val();
        if(id != '' && id != null){
            let html ='';
            console.log(kt_mang(id));
            if(kt_mang(id) == true){
                alert('Vật tư này đã có');
            }else{
                if(ls_vat_tu.length > 0){

                    ls_vat_tu.forEach((element)=>{
                        if(element.id == id){
                            html = `<tr class="vat_tu_${element.id}" data-id="${element.id}">
                                <th width="80%">${element.ten_vt}</th>
                                <th width="10%"><input type="number" value="1" min="0" max="100" class="form-control so_luong_vt" ></th>
                                <th width="10%"><a class="btn btn-sm btn-danger remove-row"><i class="fa fa-minus-circle"></i></a></th>
                            </tr>`;
                            let vt = {
                                'id' : element.id,
                                'ten_vt' : element.ten_vt,
                                'soluong_vt': 1,
                            }
                            vattus.push(vt);
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
        if(vattus.length > 0){
            vattus.forEach((element)=>{
                if(id == element.id){
                    vattus.splice(element, 1);
                    console.log(element);
                }
            });
        }
        console.log(vattus);
        calTotal();
        tr.remove();
    });

    $('#vattu').on('change' ,function() {
        let vt = $(this).val();
        if( vt != '' && vt != null){
            $('.themvattu').removeAttr("disabled");
        }
        else{
            $('.themvattu').attr( 'disabled', 'disabled' );
        }
    });
    $('#products_table').on('change keypress keyup', 'input.so_luong_vt', function() {
        let tr = $(this).closest('tr');
        let num = tr.find('input.so_luong_vt').val();
        let id = tr.attr('data-id');
        if(vattus.length > 0){
            vattus.forEach((element)=>{
                if(id == element.id){
                    element.soluong_vt = num;
                }
            });
        }

        // $(this).closest('tr').remove();
        calTotal();
    });
    function calTotal(){
        if(vattus.length > 0){
            $('.vat_tu_goi').val(JSON.stringify(vattus));
            console.log($('.vat_tu_goi').val());
        }
    }

</script>
