

<div class="themgoidieutri clearfix" style="background: #fff;">
<div class="box-header with-border">
    <h3 class="box-title">Thêm mới Gói Điều Trị</h3>

    <div class="box-tools">
        <div class="btn-group pull-right" style="margin-right: 5px">
            <a href="/admin/goi-dieu-tris/" class="btn btn-sm btn-default" title="List"><i class="fa fa-list"></i><span class="hidden-xs">&nbsp;List</span></a>
        </div>
    </div>
</div>
<form action="{{ route("admin.goi-dieu-tris.store") }}" method="POST" id="create-order-form">

    <div class="box-body">

        <div class="fields-group">

            <div class="col-md-12">
                <div class="form-group clearfix">
                    <label for="ten" class="col-sm-2 asterisk control-label">Tên</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                            <input required="1" type="text" id="ten" name="ten" value="" class="form-control ten" placeholder="Input Tên">
                        </div>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label for="mo_ta" class="col-sm-2  control-label">Mô tả</label>
                    <div class="col-sm-8">
                        <textarea name="mo_ta" class="form-control mo_ta" rows="5" placeholder="Input Mô tả"></textarea>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label for="gia" class="col-sm-2  control-label">Giá</label>

                    <div class="col-sm-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                            <input type="number" id="gia" name="gia" value="" class="form-control gia" placeholder="Input Giá">
                        </div>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label for="gia" class="col-sm-2  control-label">Giá Ưu Đãi</label>

                    <div class="col-sm-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                            <input type="number" id="giam_gia" name="giam_gia" value="" class="form-control giam_gia" placeholder="Input Giá">
                        </div>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label for="so_buoi" class="col-sm-2  control-label">Số buổi</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                            <input type="number" id="so_buoi" name="so_buoi" value="" class="form-control so_buoi" placeholder="Input Số buổi">
                        </div>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label for="ghi_chu" class="col-sm-2  control-label">Ghi chú</label>
                    <div class="col-sm-8">
                        <textarea name="ghi_chu" class="form-control ghi_chu" rows="5" placeholder="Input Ghi chú"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12" id="tron_vattu">
            <div class="form-group clearfix">
                    <label for="gia" class="col-sm-2  control-label">Vật tư</label>

                    <div class="col-sm-8">
                        <select name="vattu" class="form-control" id="vattu">
                                <option value="">-- trọn vật tư --</option>
                                @foreach($vattu as $loc)

                                    <option value="{{ $loc->id }}" @if($loc->id == old('created_by')) selected @endif>{{ $loc->ten}}</option>
                                @endforeach
                            </select>
                            <div id="ls_vt">
                                @foreach($vattu as $loc)
                                <div class="ls_vt" data-id="{{ $loc->id }}" data-name="{{ $loc->ten }}"  style="display: none;"></div>
                                @endforeach
                            </div>
                    </div>
                    <div class="col-sm-2">
                        <span class="themvattu btn btn-primary">Thêm vật tư</span>
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
