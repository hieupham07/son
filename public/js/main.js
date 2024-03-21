const formatter = new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND',
    minimumFractionDigits:2
});
$( document ).ready(function() {
    $('#btnSubmit').click(function (e) {
        postCheckIn();
    });
});
function addRow(data) {
    if(typeof data == "undefined" || data == null) return false;
    let price = data.price;
    let qty = 1;
    let total = price * qty;
    let totalText =formatter.format(total);

    let isExit = false;
    $('#products_table').find('tbody tr').each(function() {
        if($(this).hasClass(data.id)) {
            isExit = true;
            let currQty = $(this).find('input.qty').val();
            $(this).find('input.qty').val(Number(currQty)+1);
            $('input.qty').trigger('change');
            return false;
        }
    });
    if(isExit) return false;
    let $tr = '<tr class="'+data.id+'">\n' +

        '          <td><a href="#">'+data.code + '/' + data.name+' <i class="fa fa-info-circle"></i></a><input type="hidden" name="products['+data.id+'][product_id]" value="'+data.id+'" /></td>\n' +
        '          <td>'+data.unit+'</td>\n' +
        '          <td class="qty" width="10%">\n' +
        '              <input type="number" name="products['+data.id+'][qty]" class="form-control qty" value="'+qty+'" min="0"/>\n' +
        '          </td>\n' +
        '          <td class="price" width="10%">\n' +
        //'              <span>'+formatter.format(price)+'</span>\n' +
        '              <input type="text" name="products['+data.id+'][price]" value="'+price+'" class="form-control price money" />\n' +
        '          </td>\n' +
        '          <td class=""><input type="number" name="products['+data.id+'][f_discount]" value="0" min="0" max="100" class="form-control f-discount" /></td>\n' +
        '          <td class=""><input type="number" name="products['+data.id+'][m_discount]" value="0" min="0" class="form-control m-discount" /></td>\n' +
        '          <td class="total">\n' +
        '              <span>'+totalText+'</span>\n' +
        '              <input type="hidden" name="products['+data.id+'][total]" value="'+total+'" /></td>\n'+
        '          <td class=""><input type="text" name="products['+data.id+'][description]" value="" class=""></input></td>\n' +
        '          <td><a href="#" class="btn btn-sm btn-danger remove-row"><i class="fa fa-minus-circle"></i></a></td>\n' +
        '       </tr>';

    $('#products_table').find('tbody').append($tr);
    calTotal();
}
function calTotal() {
    let subTotal = 0;
    let vat =0;
    let discount = Number($(".discount").val());
    let discountAmount = Number($('.discountAmount').val());

    $('#products_table').find('td.total').each(function(){
        subTotal += Number($(this).find('input').val());
    });

    let totalVat = (vat/100) * subTotal
    let totalDiscount = discount/100 * subTotal;

    if($(".discountType").val() == 'fDiscount') {
        discountAmount = 0;
    }

    if($(".discountType").val() == 'mDiscount') {
        totalDiscount = 0;
    }

    $(".priceText").val(formatter.format(subTotal + totalVat - totalDiscount - discountAmount));
    $("#totalPrice").val(subTotal + totalVat - totalDiscount - discountAmount);
}

function checkinManually(e) {
    if(e.keyCode == 13) {
        postCheckIn();
        return false;
    }
}
function postCheckIn() {
    let employeeCode = $('#txtEmployeeCode').val();
    let device_id=$('#device_id').val();
    if(employeeCode && device_id) {
        let url = '/admin/hrm/checkin';
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : url,
            type : "post",
            dataType:"json",
            data : {
                employee_code : employeeCode,
                device_id: device_id
            },
            success : function (result){
                if(result['status']==1) {
                    $.admin.toastr.success(result['message'], 'Thông báo', {positionClass:"toast-bottom-right"});
                }
                else {
                    $.admin.toastr.error(result['message'], 'Cảnh báo', {positionClass:"toast-top-center"})
                };
                showEmployeeInfo(result);
            }
        });

        $('#txtEmployeeCode').val('');
    }else {
        $.admin.toastr.error('Chưa chọn phòng', '', {positionClass:"toast-top-center"});
    }
}
function showEmployeeInfo(data) {
    if(data['status']==1) {
        let employee=data['employee'];
        let html=`<div class="box-header with-border">
                <h3 class="box-title">${employee.name}</h3>
            </div>
            <div class="box-body">
                <div class="pull-left employee-img">
                    <img src="${employee.picture_path}">
                </div>
               <div class="status-checkin-info">
                    Trạng thái <strong>${data['states']}</strong> lúc ${new Date().toLocaleString() }                                     
                </div>

            </div>
        `;
        $('#employee_info').html(html);
    }else {
        $('#employee_info').html('');
    }
};


function __currency_convert_recursively(element, use_page_currency = false) {
    element.find('.display_currency').each(function() {
        var value = $(this).text();
        var __currency_precision = 0;
        var show_symbol = $(this).data('currency_symbol');
        if (show_symbol == undefined || show_symbol != true) {
            show_symbol = false;
        }

        var highlight = $(this).data('highlight');
        if (highlight == true) {
            __highlight(value, $(this));
        }

        var is_quantity = $(this).data('is_quantity');
        if (is_quantity == undefined || is_quantity != true) {
            is_quantity = false;
        }

        if (is_quantity) {
            show_symbol = false;
        }

        $(this).text(__currency_trans_from_en(value, show_symbol, use_page_currency, __currency_precision, is_quantity));
    });
}
//If the value is positive, text-success class will be applied else text-danger
function __highlight(value, obj) {
    obj.removeClass('text-success').removeClass('text-danger');
    if (value > 0) {
        obj.addClass('text-success');
    } else if (value < 0) {
        obj.addClass('text-danger');
    }
}
function __currency_trans_from_en(
    input,
    show_symbol = true,
    use_page_currency = false,
    precision = 2,
    is_quantity = false
) {
    var s = 'đ';
    var thousand = ',';
    var decimal = '.';
    var __currency_symbol_placement='after';
    var __quantity_precision=2;

    symbol = '';
    var format = '%s%v';
    if (show_symbol) {
        symbol = s;
        format = '%s %v';
        if (__currency_symbol_placement == 'after') {
            format = '%v %s';
        }
    }

    if (is_quantity) {
        precision = __quantity_precision;
    }

    return accounting.formatMoney(input, symbol, precision, thousand, decimal, format);
}
function exportMinusSalary()
{
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    let day=-1;
    var now= new Date();
    if(urlParams.has('month')) {
        month=urlParams.get('month');
    }else
    {
        month=now.getMonth()+1;
    }
    if(urlParams.has('year')) {
        year=urlParams.get('year');
    }else
    {
        year=now.getFullYear();
    }
    if(urlParams.has('day')) {
        day=urlParams.get('day');
    }
    window.location.href='/admin/report/export/minus-salary-detail?'+'month='+month+'&year='+year+'&day='+day;
}
function exportTimeKeeperShift()
{
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    let day=-1;
    var now= new Date();
    if(urlParams.has('month')) {
        month=urlParams.get('month');
    }else
    {
        month=now.getMonth()+1;
    }
    if(urlParams.has('year')) {
        year=urlParams.get('year');
    }else
    {
        year=now.getFullYear();
    }
    if(urlParams.has('day')) {
        day=urlParams.get('day');
    }
    window.location.href='/admin/hrm/export/timekeeper-shift?'+'month='+month+'&year='+year+'&day='+day;
}
function exportSalaryTotal()
{
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    let day=-1;
    var now= new Date();
    if(urlParams.has('month')) {
        month=urlParams.get('month');
    }else
    {
        month=now.getMonth()+1;
    }
    if(urlParams.has('year')) {
        year=urlParams.get('year');
    }else
    {
        year=now.getFullYear();
    }
    if(urlParams.has('day')) {
        day=urlParams.get('day');
    }
    window.location.href='/admin/report/export/salary-total-detail?'+'month='+month+'&year='+year+'&day='+day;
}
function exportEmployee()
{
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    window.location.href='/admin/report/export/employee';
}
function exportTh13Salary() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    window.location.href='/admin/report/export/th13-salary';
}

function exportUser() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    window.location.href='/admin/report/export/users';
}
function exportTimeKeeping() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    var now= new Date();
    if(urlParams.has('month')) {
        month=urlParams.get('month');
    }else
    {
        month=now.getMonth()+1;
    }
    if(urlParams.has('year')) {
        year=urlParams.get('year');
    }else
    {
        year=now.getFullYear();
    }
    if(urlParams.has('device_id')) {
        device_id=urlParams.get('device_id');
    }
    window.location.href='/admin/report/export/timekeeping?'+'month='+month+'&year='+year+'&device_id='+device_id;
}

function exportTimeKeepingTotal() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    var now= new Date();
    if(urlParams.has('month')) {
        month=urlParams.get('month');
    }else
    {
        month=now.getMonth()+1;
    }
    if(urlParams.has('year')) {
        year=urlParams.get('year');
    }else
    {
        year=now.getFullYear();
    }
    if(urlParams.has('employee_id')) {
        employee_id=urlParams.get('employee_id');
    }
    window.location.href='/admin/report/export/timekeeping-total?'+'month='+month+'&year='+year+'&employee_id='+employee_id;
}

function exportCompareWallet() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    var now= new Date();
    if(urlParams.has('month')) {
        month=urlParams.get('month');
    }else
    {
        month=now.getMonth()+1;
    }
    if(urlParams.has('year')) {
        year=urlParams.get('year');
    }else
    {
        year=now.getFullYear();
    }
    if (urlParams.has('month_pre')){
        month_pre=urlParams.get('month_pre');
    }else{
        if (month==12){
            month_pre=1;
        }else{
            month_pre=month-1;
        }

    }


    if(urlParams.has('department')) {
        department=urlParams.get('department');
    }
    window.location.href='/admin/report/export/compare-wallet?'+'month='+month+'&year='+year+'&department='+department+'&month_pre='+month_pre;
}
function exportThuThuatPhu() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    var now= new Date();
    start='';
    end='';
    if(urlParams.has('month')) {
        month=urlParams.get('month');
    }else
    {
        month=now.getMonth()+1;
    }
    if(urlParams.has('year')) {
        year=urlParams.get('year');
    }else
    {
        year=now.getFullYear();
    }
    if(urlParams.has('location')) {
        ma_co_so=urlParams.get('location');
    }else{
        ma_co_so='';
    }
    if (urlParams.has('ngay_kham_benh[start]'))
    {
        start=urlParams.get('ngay_kham_benh[start]');
    }
    if (urlParams.has('ngay_kham_benh[end]'))
    {
        end=urlParams.get('ngay_kham_benh[end]');
    }

    window.location.href='/admin/report/export/thu-thuat-phu?'+'location='+ma_co_so+'&start='+start+'&end='+end;;
}

function exportSalaryWallet() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    var now= new Date();
    if(urlParams.has('month')) {
        month=urlParams.get('month');
    }else
    {
        month=now.getMonth()+1;
    }
    if(urlParams.has('year')) {
        year=urlParams.get('year');
    }else
    {
        year=now.getFullYear();
    }
    if(urlParams.has('department')) {
        department=urlParams.get('department');
    }
    window.location.href='/admin/report/export/salary-wallet?'+'month='+month+'&year='+year+'&department='+department;
}
function exportReportSalaryEmployee()
{
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    var now= new Date();
    if(urlParams.has('month')) {
        month=urlParams.get('month');
    }else
    {
        month=now.getMonth()+1;
    }
    if(urlParams.has('year')) {
        year=urlParams.get('year');
    }else
    {
        year=now.getFullYear();
    }
    if(urlParams.has('department')) {
        department=urlParams.get('department');
    }
    window.location.href='/admin/report/export/salary-employee?'+'month='+month+'&year='+year+'&department='+department;
}
function exportReportBounus()
{
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    var now= new Date();
    if(urlParams.has('month')) {
        month=urlParams.get('month');
    }else
    {
        month=now.getMonth()+1;
    }
    if(urlParams.has('year')) {
        year=urlParams.get('year');
    }else
    {
        year=now.getFullYear();
    }
    if (urlParams.has('day'))
    {
        day=urlParams.get('day')
    }else{
        day=now.getDay();
    }

    if(urlParams.has('department')) {
        department=urlParams.get('department');
    }
    window.location.href='/admin/report/export/bonus?'+'month='+month+'&year='+year+'&department='+department+'&day='+day;
}