function deleteObject(self, url, id_name, event, confirm_message) {
    /* Act on the event */
    event.preventDefault();
    if(!confirm(confirm_message)) {
        return;
    }
    var object_id = $(self).attr("data");
    var data = {};
    data[id_name] = object_id;
    $.ajax({
        url: url,
        data: data,
    })
    .done(function(data) {
        var rs = JSON.parse(data);
        var can_delete = rs.can_delete;//data chứa 0 hoặc 1
        if (can_delete == 1) {
            var href = $(self).attr("href");
            window.location.href = href;
        }
        else {
            $(".error").html(rs.message);
        }
    })
    .fail(function() {
        console.log("error");
    });
}

$(function(){

    $(".btn-delete-role").click(function(event) {
        /* Act on the event */
        var url = "index.php?c=permission&a=checkDeleteRole";
        var id_name = "role_id";
        var confirm_message = "Bạn muốn xóa vai trò này phải không?";
        deleteObject(this, url , id_name, event, confirm_message);
         
    });

    $(".btn-delete-cat").click(function(event) {
        /* Act on the event */
        var url = "index.php?c=category&a=checkDelete";
        var id_name = "category_id";
        var confirm_message = "Bạn muốn xóa thư mục này phải không?";
        deleteObject(this, url , id_name, event, confirm_message);
         
    });

    $(".btn-delete-brand").click(function(event) {
        /* Act on the event */
        var url = "index.php?c=brand&a=checkDelete";
        var id_name = "brand_id";
        var confirm_message = "Bạn muốn xóa nhãn hiệu này phải không?";
        deleteObject(this, url , id_name, event, confirm_message);
         
    });

    $("#delete").parents("form").submit(function(event) {
        /* Act on the event */
        if(!confirm("Bạn muốn xóa phải không?")) {
            return false;
        }
        var form_data = $(this).serialize();        
        var c = getUrlParameter('c');
        var self = this;
        $.ajax({
            url: 'index.php?c=' + c +'&a=checkDeletes',
            data: form_data
        }) 
        .done(function(data) {
            var rs = JSON.parse(data);
            var can_delete = rs.can_delete;//data chứa 0 hoặc 1
            if (can_delete == 1) {
                self.submit();
            }
            else {
                $(".error").html(rs.message);
            }

            console.log("success");
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        return false;
    });
	// Thay đổi province(tỉnh, thành phố)
    $("#content-wrapper .province").change(function(event) {
        var province_id = $(this).val();
        if (!province_id) {
            updateSelectBox(null, "#content-wrapper .district");
            updateSelectBox(null, "#content-wrapper .ward");
            return;
        }
        $.ajax({
            url: 'index.php?c=address&a=getDistricts',
            type: 'GET',
            data: {province_id: province_id}
        })
        .done(function(data) {
            updateSelectBox(data, "#content-wrapper .district");
            updateSelectBox(null, "#content-wrapper .ward");
        });

        if ($("#content-wrapper .shipping-fee").length) {
            $.ajax({
                url: 'index.php?c=address&a=getShippingFee',
                type: 'GET',
                data: {province_id: province_id}
            })
            .done(function(data) {
                //update shipping fee and total on UI
                var shipping_fee = data;
                updateShippingFee(shipping_fee);
            });
        }
    });

    // Thay đổi district(quận)
    $("#content-wrapper .district").change(function(event) {
        var district_id = $(this).val();
        if (!district_id) {
            updateSelectBox(null, "#content-wrapper .ward");
            return;
        }

        $.ajax({
            url: 'index.php?c=address&a=getWards',
            type: 'GET',
            data: {district_id: district_id}
        })
        .done(function(data) {
            updateSelectBox(data, "#content-wrapper .ward");
        });
    });

    //Change customer
    $(".chosen-customer").change(function(event) {
        /* Act on the event */
        $(".shipping-name").val("");
        $(".shipping-mobile").val("");
        updateSelectBox(null, ".province");
        updateSelectBox(null, ".district");
        updateSelectBox(null, ".ward");
        $(".housenumber_street").val("");
        var customer_id = $(this).val();
        // Nếu người dùng chọn "Chọn khách hàng" thì dừng tiến trình
        if (!customer_id) {
            updateShippingFee(0);
            return;
        }

        $.ajax({
            url: 'index.php?c=order&a=ajaxGetShippingInfoDefault',
            data: {customer_id: customer_id},
        })
        .done(function(data) {
            data = JSON.parse(data);

            $(".shipping-name").val(data.shipping_name);
            $(".shipping-mobile").val(data.shipping_mobile);
            
            updateSelectBox(JSON.stringify(data.provinces), ".province", data.selected_province_id);
            updateSelectBox(JSON.stringify(data.districts), ".district", data.selected_district_id);
            updateSelectBox(JSON.stringify(data.wards), ".ward", data.selected_ward_id);
            $(".housenumber_street").val(data.housenumber_street);

            if (data.selected_province_id) {
                updateShippingFeeAjax(data.selected_province_id);
            }
        })
        .fail(function() {
            console.log("error");
        });
        
    });

    $("#search-barcode").keydown(function(event) {
        /* Act on the event */
        if (event.keyCode == 13) {
            // Không kích hoạt sự kiện submit trên form
            event.preventDefault();
        }
        
    });

    $("#search-barcode").keyup(function(event) {
        /* Act on the event */
        var barcode = $(this).val();
        if (!barcode) {
            return;
        }


        //enter
        if (event.keyCode == 13) {
            $.ajax({
            url: 'index.php?c=product&a=findBarcode',
            data: {barcode: barcode},
            })
            .done(function(data) {
                if (!data) {
                    alert("Không tìm thấy sản phẩm này");
                    return;
                }
                $("#search-barcode").val("");
                var product = JSON.parse(data);

                //Nếu tồn tại barcode trong bảng rồi thì tăng số lượng lên 1 đơn vị
                var tds = $(".product-item tbody tr td:first-child");//chứa barcode
                for(var i = 0; i <= tds.length - 1; i++) {
                    var td = tds[i];
                    var barcode_in_table = $(td).html();
                    if (barcode_in_table == product.barcode) {
                        //existing
                        //tăng qty lên 1 đơn vị
                        input_obj = $(td).parent().find('input[type=number]');
                        var current_val = $(input_obj).val();
                        $(input_obj).val(Number(current_val) + 1);
                        updateQty(input_obj);
                        return;
                    }
                }

                //Ngược lại thì thêm vào bảng
                var str_price = "";
                if (product.sale_price != product.price) {
                    str_price = `<del>${number_format(product.price)}đ</del> `;
                }
                str_price += number_format(product.sale_price) + "đ";
                var tr = `<tr> 
                              <td>${product.barcode}</td>
                              <td>
                                ${product.name}
                                <input type="hidden" name="product_ids[]" value="${product.id}">
                              </td>
                              <td>
                                   <img src="../upload/${product.featured_image}">
                                   
                                </td>
                              <td>${str_price}</td>
                              <td>
                                <input name="qties[]" class="qty" data="${product.sale_price}" type="number" min="1" value="1" onchange="updateQty(this)">
                              </td>
                              <td>${number_format(product.sale_price)}đ</td>
                              <td>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)">X</button>
                              </td>
                          </tr>`;
                $(".product-item").append(tr);
                updatePaymentTotal();
                console.log("success");
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        }
        
        
    });
});
function checkAll(check_all) {
	$(check_all).change(function() {
	    var checkboxes = $(this).closest('table').find(':checkbox').not(":disabled");
	    checkboxes.prop('checked', $(this).is(':checked'));
	});
}

var loadFile = function(event) {
	var image = document.getElementById('image');
	image.src = URL.createObjectURL(event.target.files[0]);
};

// Cập nhật các option cho thẻ select
function updateSelectBox(data, selector, selected_id=null) {
    var items = JSON.parse(data);
    $(selector).find('option').not(':first').remove();
    if (!data) return;
    for (let i = 0; i < items.length; i++) {
        let item = items[i];
        selected = ""; 
        if (selected_id ==  item.id) {
            selected = "selected";
        }
        let option = '<option ' + selected + ' value="' + item.id + '"> ' + item.name + '</option>';
        $(selector).append(option);
    } 
}

function updateSubTotal() {
    var inputs = $(".product-item tbody input[type=number]");
    var sub_total = 0;
    for(var i = 0; i <= inputs.length - 1; i++) {
        var input = inputs[i];
        var sale_price = $(input).attr("data");
        var qty = $(input).val();
        sub_total += sale_price * qty;
    }
    var format_sub_total = number_format(sub_total) + "đ";
    $(".sub-total").html(format_sub_total);
    $(".sub-total").attr("data", sub_total);
}

function updatePaymentTotal(){
    updateSubTotal();
    var shipping_fee = $("#content-wrapper .shipping-fee").val();
    var sub_total = $("#content-wrapper .sub-total").attr("data");
    var payment_total = Number(shipping_fee) + Number(sub_total);
    $("#content-wrapper .payment-total").html(number_format(payment_total) + "đ");
}

function updateShippingFeeAjax(province_id) {
    $.ajax({
        url: 'index.php?c=address&a=getShippingFee',
        data: {province_id: province_id},
    })
    .done(function(data) {
        var shipping_fee = data;
        updateShippingFee(shipping_fee);
    })
    .fail(function() {
        console.log("error");
    });
    
}

function updateShippingFee(shipping_fee) {
    shipping_fee = Number(shipping_fee);
    $("#content-wrapper .shipping-fee").val(shipping_fee);
    updatePaymentTotal();
}

function updateQty(self){
    var sale_price = $(self).attr("data");
    var qty = $(self).val();
    var total = sale_price * qty;
    var format_total = number_format(total) + "đ";
    $(self).parent().next().html(format_total);
    updatePaymentTotal();
}

function deleteRow(self) {
    var row = $(self).parent().parent();
    $(row).remove();
    updatePaymentTotal();
}


var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};