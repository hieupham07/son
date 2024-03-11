<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <form action="/admin/quote/{{$order->id}}" method="PUT" id="create-order-form">
                <div class="col-md-12">
                    <div class="form-group col-md-6 col-lg-3 col-xs-12" style="margin-left: -15px !important;">
                        <label class="control-label no-padding-right" for="customerId">Khách hàng
                        </label>
                        <div class="clearfix">
                            <select name="customerId" class="form-control" id="customerId">
                                <option value="{{$order->causer->id}}" selected="selected">{{$order->causer->name}}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6 col-lg-2 col-xs-12">
                        <label class="control-label no-padding-right" for="orderDate">Mã đơn </label>
                        <div class="clearfix">
                            <input placeholder="Mã đơn" name="orderCode" value="{{ old('orderCode', $order->invoice_no) }}" id="orderCode" class="form-control" type="text" readonly>
                        </div>
                    </div>

                    <div class="form-group col-md-6 col-lg-2 col-xs-12">
                        <label class="control-label no-padding-right" for="orderDate"> Ngày </label>
                        <div class="clearfix">
                            <input placeholder="Ngày" name="orderDate" value="{{ old('orderDate', date_format(date_create($order->order_date),"Y-m-d")) }}"
                                   id="orderDate" class="form-control" type="date">
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-2 col-sm-12 col-xs-12 form-group">
                        <label class="control-label no-padding-right" for="employeeId">Người tạo</label>
                        <div class="clearfix">
                            <select name="created_by" class="form-control" id="created_by">
                                <option value="">-- Tất cả --</option>
                                @foreach($users as $loc)
                                        <option value="{{ $loc->id }}" @if($loc->id == old('created_by', $order->created_by)) selected @endif>{{ $loc->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group" style="overflow: hidden">
                        <label class="control-label no-padding-right">Sản phẩm</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                            <select name="select-product" class="form-control" id="select-product">
                                <option value="">-- Chọn sản phẩm --</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="products_table">
                            <thead>
                            <tr>
                                <th width="25%">Sản phẩm</th>
                                <th width="5%">ĐVT</th>
                                <th width="7%">Số lượng</th>
                                <th width="6%">Đơn giá</th>
                                <th width="7%">% Chiết khấu</th>
                                <th width="7%">Tiền Chiết khấu</th>
                                <th width="7%">Thành tiền</th>
                                <th width="10%">Ghi chú</th>
                                <th width="2%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->details as $k => $ord)

                                <tr class="{{$ord->id}}">
                                    <td><a href="#">{{$ord->product->code}} / {{$ord->product->name}}
                                            <i class="fa fa-info-circle"></i></a>
                                        <input type="hidden" name="products[{{$ord->id}}][product_id]" value="{{$ord->product_id}}" />
                                    </td>
                                    <td>{{$ord->unit}}</td>
                                    <td class="qty" width="10%">
                                        <input type="number" name="products[{{$ord->id}}][qty]" class="form-control qty" value="{{$ord->qty}}" min="0"/>
                                    </td>
                                    <td class="price" width="10%">
                                        <input type="text" name="products[{{$ord->id}}][price]" value="{{$ord->price}}" class="form-control price"/>
                                    </td>
                                    <td class=""><input type="number" name="products[{{$ord->id}}][f_discount]" value="{{$ord->f_discount}}" min="0" max="100" class="form-control f-discount" /></td>
                                    <td class=""><input type="number" name="products[{{$ord->id}}][m_discount]" value="{{$ord->m_discount}}" min="0" class="form-control m-discount" /></td>
                                    <td class="total">
                                        <span>{{$ord->m_total }}</span>
                                        <input type="hidden" name="products[{{$ord->id}}][total]" value="{{$ord->m_total}}" />
                                    </td>
                                    <td class=""><input type="text" name="products[{{$ord->id}}][description]" value="{{$ord->description}}" class=""></input></td>
                                    <td><a href="#" class="btn btn-sm btn-danger remove-row"><i class="fa fa-minus-circle"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label no-padding-right" for="discount">Ghi chú</label>
                                <textarea class="form-control" name="desc" rows="4">{{$order->description}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-sm-4 no-padding-right" for="discount">Giảm giá</label>
                                <div class="col-sm-4">

                                    <select name="discountType" class="form-control discountType">
                                        <option value="fDiscount" @if ($order->f_discount > 0) selected @endif>Tỷ lệ %</option>
                                        <option value="mDiscount" @if ($order->m_discount > 0) selected @endif>Tiền mặt</option>
                                    </select>

                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="number" class="form-control discount" value="{{$order->f_discount}}" min="0" name="discount" disabled style="display: none">
                                        <input type="number" class="form-control discountAmount" value="{{ $order->m_discount }}" min="0" name="discountAmount" disabled style="display: none">
                                        <span class="input-group-addon" style="display: none">%</span>
                                    </div>

                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="control-label col-sm-4 no-padding-right text-bold" for="totalPrice">Total</label>
                                <div class="col-sm-8">
                                    <input name="totalPriceText" value="{{ $order->m_total }}"
                                           class="form-control priceText" type="text" disabled/>
                                    <input name="totalPrice" value="{{$order->m_total}}"
                                           class="form-control" type="hidden" readonly id="totalPrice" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group" style="float: right">
                        <input class="btn btn-primary" type="submit" value="Lưu">
                        <a class="btn btn-danger" onclick="history.back()">Quay lại</a>
                    </div>
                </div>
            </form>
            <div class="clearfix"></div>
        </div>
    </div>

    <input type="hidden" value="{{ route('admin.quote.index') }}" id="redirect-route">
</div>

<script type="javascript">
    $( document ).ready(function() {
       // $('input.price, #unitPrice, #purchasePrice').inputmask("#.##0", {reverse: true});
        $('#customerId').select2({
            placeholder: 'Chọn khách hàng',
            delay: 250,
            escapeMarkup: function(markup) {
                return markup;
            },
            templateResult: function(data) {
                return data.html;
            },
            templateSelection: function(data) {
                return data.text;
            },
            ajax: {
                url: "/admin/api/warranty",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page || 1
                    };
                },
                processResults: function (res, params) {
                    let data = res.data;
                    let page = params.page || 1;
                    return {
                        results: $.map(data, function(item) {
                            return {
                                title: item.name,
                                text: item.code + "/" + item.name + "/" + item.mobile,
                                id: item.id,
                                html: item.code + "/" + item.name + "/" + item.mobile,
                                data: item
                            };
                        }),
                        pagination: {
                            more: page * 5 <= res.total
                        }
                    };
                },
                cache: true
            }
        }).on('select2:select', function (e) {
            $(".select-product").prop("disabled", false);
        }).trigger('change');
        $('#select-product').select2({
            placeholder: 'Chọn sản phẩm',
            delay: 250,
            escapeMarkup: function(markup) {
                return markup;
            },
            templateResult: function(data) {
                return data.html;
            },
            templateSelection: function(data) {
                return data;
            },
            ajax: {
                url: "/admin/api/products",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page || 1
                    };
                },
                processResults: function (res, params) {
                    let data = res.data;
                    let page = params.page || 1;
                    return {
                        results: $.map(data, function(item) {
                            return {
                                title: item.name,
                                text: item.code + "/" + item.name ,
                                id: item.id,
                                html: item.code + "/" + item.name,
                                data: item
                            };
                        }),
                        pagination: {
                            more: page * 5 <= res.total
                        }
                    };
                },
                cache: true
            }
        }).on('select2:select', function (e) {
            let data = e.params.data;
            addRow(data.data);
        }).trigger('change');
        $('#products_table').on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
            calTotal();
        });

        $('#products_table').on('change keypress keyup', 'input.qty, input.price, ' +
            '.f-discount, .m-discount', function() {
            let $tr = $(this).closest('tr');
            let num = $tr.find('input.qty').val();
            let price = $tr.find('input.price').val();
            price = Number(price);

            let fDiscount = $tr.find('.f-discount').val();
            let mDiscount = $tr.find('.m-discount').val();

            $tr.find('.m-discount').attr('max', price);

            if(fDiscount > 100) {
                $tr.find('.f-discount').val(100);
            }

            if(Number(mDiscount) > Number(price)) {
                $tr.find('.m-discount').val(price);
            }

            let total = num * price;
            if(fDiscount > 0) {
                total = num * (price - fDiscount*price/100);
            } else if(mDiscount > 0) {
                total = num * (price - mDiscount);
            }

            $tr.find('td.total > input').val(total);
            $tr.find('td.total > span').text(formatter.format(total));
            calTotal();
            $('.paid, #totalPrice').trigger('change');
        });
        $(".discountType").on('change', function(e) {
            $(".discount, .discountAmount").hide().prop("disabled", true);
            $(".discount, .discountAmount").closest('.input-group').find('.input-group-addon').hide();
            let val = $(".discount").val();
            let vall = $(".discountAmount").val();
            if($(this).val() == 'fDiscount') {
                $(".discount").show().prop("disabled", false).val(val);
                $(".discount").closest('.input-group').find('.input-group-addon')
                    .show().text('%');
            }
            if($(this).val() == 'mDiscount') {
                $(".discountAmount").val(vall);
                $(".discountAmount").show().prop("disabled", false);
                $(".discountAmount").closest('.input-group').find('.input-group-addon').show().text('VND');
            }
            calTotal();
        });

        $(".discountType").trigger('change');

        $(".discount, .discountAmount, .paid, #totalPrice").on('change keypress keyup', function () {
            calTotal();
        });

        $("#create-order-form").submit(function (e) {
            e.preventDefault();
            let url = $(this).attr('action');
            console.log(url);
            var data = $(this).serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'PUT',
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
    });
</script>
