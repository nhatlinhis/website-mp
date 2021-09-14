const BASEURL = "/-website-mp" //GLOBAL VAR
test = null

/**
 * 
 * 
 * Handle for HOME SITE
 * add ro cart, 
 * 
 * 
 * 
 */
$(document).ready(function () {
    $(document).on("click", "a.page-link", function (e) {
        e.preventDefault()
    })
    $(document).on("click", "button#sreach-product", function () {
        arr = $("#bodyy .product")
        arr.attr("show", "show")
        arr.removeAttr("hidden")
        s = $("input#sreach").val().toLowerCase();

        for (i = 0; i < arr.length; i++) {
            n = arr.eq(i).find("a.name-product").text().toLowerCase();
            console.log(s + "  " + n)
            if (n.search(s) == -1) {
                arr.eq(i).attr("hidden", "true")
                arr.eq(i).attr("show", "hide")
            }
        }
        $("#pagination").remove()
        paging()
    })
})

paging = function (pa = 1, arr = $("#bodyy .product[show='show']")) {
    bd = $("#bodyy")
    pag = $("#pagination")
    l = arr.length
    ck = false
    if (pa == 0) {
        pa = parseInt(pag.find("li.page-item.active").text()) - 1
        if (pa == 0) pa = 1
    }
    if (pa == -1) {
        pa = parseInt(pag.find("li.page-item.active").text()) + 1
        if (pa == parseInt(l / 15) + 2) pa = parseInt(l / 15) + 1
    }
    s = 15 * (pa - 1)
    e = 15 * (pa)
    for (i = 0; i < l; i++) {
        if (i >= s && i < e) {
            ck = true
            arr.eq(i).removeAttr("hidden")
        } else {
            arr.eq(i).attr("hidden", "true")
        }
    }
    if (ck) {
        if (pag.length == 0) {
            p = '<div class="mt-2 p-0 col-12 d-flex flex-row-reverse" id="pagination">'
            p += '<ul class="pagination">'
            p += '<li class="page-item"><a class="page-link" onclick="paging(0)" href="">Trước</a></li>'
            for (i = 0; i < l / 15; i++) {
                if (i == pa - 1) {
                    p += '<li class="page-item active"><a class="page-link" onclick="paging(' + (i + 1) + ')" href="">' + (i + 1)
                    p += '</a></li>'
                } else {
                    p += '<li class="page-item"><a class="page-link" onclick="paging(' + (i + 1) + ')" href="">' + (i + 1)
                    p += '</a></li>'
                }
            }
            p += '<li class="page-item"><a class="page-link" onclick="paging(-1)" href="">Sau</a></li>'
            p += '</ul>'
            p += '</div>'
            bd.after(p)
        } else {
            ar = pag.find("li.page-item")
            for (i = 0; i < ar.length; i++) {
                if (i == pa) {
                    ar.eq(i).addClass("active")
                } else {
                    ar.eq(i).removeClass("active")
                }
            }
        }
    }
}

loadImgAllProduct = function(){
    arr = $('.img_p')
    for (i = 0; i < arr.length; i++) {
        id = arr.eq(i).attr('id_p')
        t = arr.eq(i)
        $.ajax({
            type: "POST",
            url: BASEURL + "/product/GetImageProduct",
            data: { 'id': id },
            dataType: 'JSON'
        }).then(
            function (res) {
                $(".img_p[id_p='" + res.id + "']").attr('src', res.img)
            },
            function () {
                //alert("error img")
                console.log('er')
            }
        )
    }
}

loadProduct = function () {
    $.ajax({
        type: "POST",
        url: BASEURL + "/product/getAllProduct",
        dataType: 'JSON'
    }).then(
        // resolve/success callback
        function (response) {
            for (i = 0; i < response.length; i++) {
                $("#bodyy").append(response[i])
            }
            paging()
            loadImgAllProduct()
        },
        // reject/failure callback
        function () {
            alert('There was some error!');
        }
    )
}

loadTrendingProduct = function () {
    $.ajax({
        type: "POST",
        url: BASEURL + "/product/getTrendingProduct",
        dataType: 'JSON'
    }).then(
        // resolve/success callback
        function (response) {
            for (i = 0; i < response.length; i++) {
                $("#trending").append(response[i])
            }
            paging()
            loadImgAllProduct()
        },
        // reject/failure callback
        function () {
            alert('There was some error!');
        }
    )
}

loadCategory = function () {
    $.ajax({
        type: "POST",
        url: BASEURL + "/home/getCategory",
        dataType: 'JSON'
    }).then(
        // resolve/success callback
        function (response) {
            for (i = 0; i < response.length; i++) {
                s = '<ul class="dropdown-menu dropdown-menu-left">'
                for (j = 0; j < response[i].length; j++) {
                    id_Ca = response[i][j].id
                    name_Ca = response[i][j].name
                    s += '<li><a class="dropdown-item" href="' +
                        BASEURL + '/product/getByType/' + id_Ca + '">' + name_Ca + '</a></li>'
                }
                s += '</ul>'
                $("a.nav-link[id_ca='" + (i + 1) + "']").after(s)
            }
        },
        // reject/failure callback
        function () {
            alert('There was some error!');
        }
    )
}

sortProductASC = function(){
    arr = $("#bodyy .product[show='show']")
    arr_t = $("#bodyy .product[show='show']")
    len = arr.length
    arr = arr.sort(function(a,b){
        val_a = $(a).find("p.price-product").attr('price')
        val_b = $(b).find("p.price-product").attr('price')
        return val_a - val_b
    })
    $("#bodyy").empty()
    for(i=0; i<len; i++){
        $("#bodyy").append(arr.eq(i))
    }
    paging()
}
sortProductDESC = function(){
    arr = $("#bodyy .product[show='show']")
    arr_t = $("#bodyy .product[show='show']")
    len = arr.length
    arr = arr.sort(function(a,b){
        val_a = $(a).find("p.price-product").attr('price')
        val_b = $(b).find("p.price-product").attr('price')
        return val_b - val_a
    })
    $("#bodyy").empty()
    for(i=0; i<len; i++){
        $("#bodyy").append(arr.eq(i))
    }
    paging()
}
$(document).on('click', 'a.sort', function(e){
    e.preventDefault()
})
//-------------------------------------END OF HOME SITE


/**
 * 
 * 
 * 
 * Handle for ADMIN SITE 
 * -----------------------------------START ADMIN JS
 * loadPage, modifyTable, initTable, loadInsertP
 * 
 * 
 */

loadPage = function (pageID) {
    a = $(".navbar-nav li.active")
    for (i = 0; i < a.length; i++) a.eq(i).removeClass('active')
    $(pageID).addClass('active')
}

/**
 * 
 * init Table use dataTable
 */

modifyTable = function (tableID) {
    filter = $(tableID + "_filter")
    filter.find('label').addClass('form-group form-inline')
    filter.find("input").addClass('form-control ml-2')

    length = $(tableID + "_length")
    length.addClass('form-group form-inline')
    length.find("select").addClass('form-control ml-2 mr-2')
}

initTable = function (tableID, dataLink, callback) {
    $(tableID).addClass('nowrap')
    $(tableID).DataTable({
        responsive: true,
        "destroy": true,
        "ajax": {
            "url": BASEURL + dataLink,
            "type": "POST",
            "dataSrc": "data"
        },
        "initComplete": function (settings, json, callback) {
            modifyTable(tableID)
        }
    });

}

initTableDisplay = function (tableID, dataLink, callback) {
    $(tableID).addClass('nowrap')
    $(tableID).DataTable({
        responsive: true,
        "searching": false,
        "lengthChange": false,
        "info": false,
        "destroy": true,
        "ajax": {
            "url": BASEURL + dataLink,
            "type": "POST",
            "dataSrc": "data"
        },
        "initComplete": function (settings, json, callback) {
            modifyTable(tableID)
        }
    });

}

loadInsertP = function () {

    $.ajax({
        type: "POST",
        url: BASEURL + "/admin/getTypeProductForTagSelect",
        dataType: 'JSON'
    }).then(
        // resolve/success callback
        function (response) {
            if (response.status) {
                $("select.Type-product option").remove()
                s = ""
                for (i = 0; i < response.data.length; i++) {
                    s += '<option value="' + response.data[i][0] + '">' + response.data[i][1] + '</option>'
                }
                $("select.Type-product").append(s)
            }
        },
        // reject/failure callback
        function () {
            alert('There was some error tp!');
        }
    )
    $.ajax({
        type: "POST",
        url: BASEURL + "/admin/getWarehouseForTagSelect",
        dataType: 'JSON'
    }).then(
        // resolve/success callback
        function (response) {
            if (response.status) {
                p = $("div.form-row")
                $("button.AddWarehouse").removeAttr('disabled')
                for (i = 1; i < p.length; i++) p.eq(i).remove()

                $("select.Warehouse option").remove()
                s = ""
                for (i = 0; i < response.data.length; i++) {
                    s += '<option value="' + response.data[i][0] + '">' + response.data[i][1] + '</option>'
                }
                $("select.Warehouse").append(s)

                len_o = $("select#Warehouse:first option").length
                len = $(".form-row").length
                console.log(len_o + "  " + len)
                if (len_o == len) $("button.AddWarehouse").attr('disabled', 'true')
            }
        },
        // reject/failure callback
        function () {
            alert('There was some error whd!');
        }
    )
}
/**
 * 
 * search
 */
$(document).ready(function () {
    tb_id = "#" + $("input.find").attr('tb_id')
    col = 0
    /**
     * 
     * find table
     */
    $("input.find").keyup(function () {
        col = $(this).parents(".find-input").find("option:selected").val()
        val = $(this).val()
        tb_id = "#" + $(this).attr('tb_id')

        $(tb_id).DataTable().column(col).search(val).draw()
        console.log(col + " " + val)
    })
    /**
     * 
     * select change
     */
    $("div.find-input select").change(function () {
        $(tb_id).DataTable().column(col).search('').draw()
        col = $(this).find("option:selected").val()
        val = $("input.find").val()

        $(tb_id).DataTable().column(col).search(val).draw()
        console.log(col + " " + val)
    })
})

$(document).ready(function () {
    //sizing logo
    $("#sidebarToggle, #sidebarToggleTop").on("click", function (e) {
        if ($("#logo").hasClass('pr-md-5 pl-md-5')) {
            $("#logo").toggleClass('pr-md-5 pl-md-5');
            $("#logo").toggleClass('pr-md-3 pl-md-3');
        }
    })
    $(window).resize(function () {
        if ($("ul.navbar-nav").hasClass("toggled") && $("#logo").hasClass('pr-md-5 pl-md-5')) {
            $("#logo").toggleClass('pr-md-5 pl-md-5');
            $("#logo").toggleClass('pr-md-3 pl-md-3');
        }
    });
    /**
     * 
     * user active/ disable
     */
    $(document).on('click', '#user_table .status', function () {
        if ($(this).text() == "ACTIVE") {
            link = "/admin/disableUser"
        } else {
            link = "/admin/activeUser"
        }
        status = false
        $.ajax({
            type: "POST",
            url: BASEURL + link,
            data: { 'Account': $(this).attr('account') },
            dataType: 'JSON'
        }).then(
            // resolve/success callback
            function (response) {
                if (response.status) {
                    status = true;
                }
            },
            // reject/failure callback
            function () {
                alert('There was some error!');
            }
        )
        if (status) {
            $("#user_table").DataTable().ajax.reload()
            a = $(".status")
            for (i = 0; i < a.length; i++) {
                if (a.eq(i).attr('account') == $(this).attr('account')) {
                    a.eq(i).toggleClass('btn-danger')
                    a.eq(i).toggleClass('btn-success')
                }
            }
        }
    })

    /**
     * 
     * 
     * warehouse active/disable
     */
    w_modify = null
    $(document).on('click', '#warehouse_table .status', function () {
        if ($(this).text() == "ACTIVE") {
            link = "/admin/disableWarehouse"
        } else {
            link = "/admin/activeWarehouse"
        }
        status = false
        $.ajax({
            type: "POST",
            url: BASEURL + link,
            data: { 'id': $(this).attr('id_w') },
            dataType: 'JSON'
        }).then(
            // resolve/success callback
            function (response) {
                if (response.status) {
                    status = true;
                }
            },
            // reject/failure callback
            function () {
                alert('There was some error!');
            }
        )
        if (status) {
            $("#warehouse_table").DataTable().ajax.reload()
            a = $(".status")
            for (i = 0; i < a.length; i++) {
                if (a.eq(i).attr('id_w') == $(this).attr('id_w')) {
                    a.eq(i).toggleClass('btn-success')
                    a.eq(i).toggleClass('btn-danger')
                    if (a.eq(i).text() == "ACTIVE") {
                        a.eq(i).parents('tr').find('button.modify').removeAttr('disabled')
                        a.eq(i).parents('tr').find('button.detail').removeAttr('disabled')
                    } else {
                        a.eq(i).parents('tr').find('button.modify').attr('disabled', 'true')
                        a.eq(i).parents('tr').find('button.detail').attr('disabled', 'true')
                    }
                }
            }
        }
    })
    /**
     * 
     * 
     * warehouse .modify
     */
    $(document).on('click', '#warehouse_table .modify', function () {
        w_id = $(this).attr('id_w')
        w_modify = $(this).parents('tbody').find('button.modify:hidden[id_w="' + w_id + '"]')
        if (w_modify.length < 1) {
            w_modify = $(this)
        }

        const data = {
            'name': w_modify.parents('tr').find('span.w-name').text(),
            'city': w_modify.parents('tr').find('span.w-city').text(),
            'province': w_modify.parents('tr').find('span.w-province').text(),
            'address': w_modify.parents('tr').find('span.w-address').text(),
        }

        $("#modify-warehouse .modal-body input.Name").val(data.name)
        $("#modify-warehouse .modal-body input.City").val(data.city)
        $("#modify-warehouse .modal-body input.Province").val(data.province)
        $("#modify-warehouse .modal-body input.Address").val(data.address)
    })

    $(document).on('click', '#w-save', function () {
        const data = {
            'id': w_modify.attr('id_w'),
            'name': $(".modal-body input.Name").val(),
            'city': $(".modal-body input.City").val(),
            'province': $(".modal-body input.Province").val(),
            'address': $(".modal-body input.Address").val(),
        }

        $.ajax({
            type: "POST",
            url: BASEURL + "/admin/saveWarehouse",
            data: data,
            dataType: 'JSON'
        }).then(
            // resolve/success callback
            function (response) {
                if (response.status) {
                    $("#warehouse_table").DataTable().ajax.reload()
                    $('#modify-warehouse').modal('toggle')
                }
            },
            // reject/failure callback
            function () {
                alert('There was some error!');
            }
        )
    })

    /**
     * 
     * warehouse detail
     */
    $(document).on('click', '#warehouse_table .detail', function () {
        id = $(this).attr('id_w')
        initTable("#warehouse_detail_table", "/admin/detailsWarehouse/" + id)
        
    })

    /**
     * 
     * insert warehouse
     */
    $("#taokhohang").click(function () {
        $(".alert").remove()
        const data = {
            'name': $("input.Name").val(),
            'address': $("input.Address").val(),
            'city': $("input.City").val(),
            'province': $("input.Province").val(),
            'status': $("select.Status option:selected").val()
        }
        if (data.name == "")
            $("input.Name").addClass("is-invalid")
        else
            $("input.Name").removeClass("is-invalid")

        if (data.address == "")
            $("input.Address").addClass("is-invalid")
        else
            $("input.Address").removeClass("is-invalid")

        if (data.city == "")
            $("input.City").addClass("is-invalid")
        else
            $("input.City").removeClass("is-invalid")

        if (data.province == "")
            $("input.Province").addClass("is-invalid")
        else
            $("input.Province").removeClass("is-invalid")


        if (data.name != "" && data.address != "" && data.city != "" && data.province != "") {
            $.ajax({
                type: 'POST',
                url: BASEURL + '/admin/insertWarehouse',
                data: data,
                dataType: 'JSON'
            }).then(
                //success
                function (response) {
                    $(".alert").remove()
                    if (response.status == true) {
                        s = '<div class="alert alert-success text-center" role="alert">'
                        s += 'Thêm kho hàng thành công thành công!!'
                        s += '</div>'
                        $("#admin-navbar").after(s)
                    } else {
                        if (response.NameError != null) {
                            $("input.Name").addClass("is-invalid")
                            $(".NameError").html(response.NameError)
                        }
                        s = '<div class="alert alert-danger text-center" role="alert">'
                        s += 'Thêm kho hàng không thành công!!'
                        if (response.msg != null) s += response.msg
                        s += '</div>'
                        $("#admin-navbar").after(s)
                    }
                },
                //error
                function () {
                    alert('There was some error!');
                }
            )
        }
    })

    /**
     * 
     * 
     * type product active/disable
     */
    tp_modify = null
    $(document).on('click', '#type_product_table .status', function () {
        if ($(this).text() == "ACTIVE") {
            link = "/admin/disableTypeProduct"
        } else {
            link = "/admin/activeTypeProduct"
        }
        status = false
        console.log($(this).attr('id_tp'))
        $.ajax({
            type: "POST",
            url: BASEURL + link,
            data: { 'id': $(this).attr('id_tp') },
            dataType: 'JSON'
        }).then(
            // resolve/success callback
            function (response) {
                if (response.status) {
                    status = true;
                }
            },
            // reject/failure callback
            function () {
                alert('There was some error!');
            }
        )
        if (status) {
            $("#type_product_table").DataTable().ajax.reload()
            a = $(".status")
            for (i = 0; i < a.length; i++) {
                if (a.eq(i).attr('id_tp') == $(this).attr('id_tp')) {
                    a.eq(i).toggleClass('btn-success')
                    a.eq(i).toggleClass('btn-danger')
                    if (a.eq(i).text() == "ACTIVE") {
                        a.eq(i).parents('tr').find('button.modify').removeAttr('disabled')
                    } else {
                        a.eq(i).parents('tr').find('button.modify').attr('disabled', 'true')
                    }
                }
            }
        }
    })
    /**
     * 
     * 
     * type product .modify
     */
    $(document).on('click', '#type_product_table .modify', function () {
        tp_id = $(this).attr('id_tp')
        tp_modify = $(this).parents('tbody').find('button.modify:hidden[id_tp="' + tp_id + '"]')
        if (tp_modify.length < 1) {
            tp_modify = $(this)
        }

        const data = {
            'name': tp_modify.parents('tr').find('span.tp-name').text(),
            'category': tp_modify.parents('tr').find('span.tp-category').attr('id_category')
        }
        console.log(data)
        $("#modify-type-product .modal-body input.Name").val(data.name)
        $("#modify-type-product .modal-body select.Category option[value='" + data.category + "']").attr('selected', 'true')
    })

    $(document).on('click', '#tp-save', function () {
        const data = {
            'id': tp_modify.attr('id_tp'),
            'name': $(".modal-body input.Name").val(),
            'id_category': $(".modal-body select.Category option:selected").val()
        }

        console.log(data)

        $.ajax({
            type: "POST",
            url: BASEURL + "/admin/saveTypeProduct",
            data: data,
            dataType: 'JSON'
        }).then(
            // resolve/success callback
            function (response) {
                if (response.status) {
                    $("#type_product_table").DataTable().ajax.reload()
                    $('#modify-type-product').modal('toggle')
                }
            },
            // reject/failure callback
            function () {
                alert('There was some error!');
            }
        )
    })

    /**
     * 
     * insert type product
     */
    $("#taoloaisp").click(function () {
        $(".alert").remove()
        const data = {
            'name': $("input.Name").val(),
            'status': $("select.Status option:selected").val(),
            'id_category': $("select.Category option:selected").val()
        }
        if (data.name == "")
            $("input.Name").addClass("is-invalid")
        else
            $("input.Name").removeClass("is-invalid")

        if (data.name != "") {
            $.ajax({
                type: 'POST',
                url: BASEURL + '/admin/insertTypeProduct',
                data: data,
                dataType: 'JSON'
            }).then(
                //success
                function (response) {
                    $(".alert").remove()
                    if (response.status == true) {
                        s = '<div class="alert alert-success text-center" role="alert">'
                        s += 'Thêm loại sản phẩm thành công thành công!!'
                        s += '</div>'
                        $("#admin-navbar").after(s)
                    } else {
                        if (response.NameError != null) {
                            $("input.Name").addClass("is-invalid")
                            $(".NameError").html(response.NameError)
                        }
                        s = '<div class="alert alert-danger text-center" role="alert">'
                        s += 'Thêm loại sản phẩm không thành công!!'
                        if (response.msg != null) s += response.msg
                        s += '</div>'
                        $("#admin-navbar").after(s)
                    }
                    console.log(response)
                },
                //error
                function () {
                    alert('There was some error!');
                }
            )
        }
    })


    /**
     * 
     * 
     * product active/disable
     */
    $(document).on('click', '#product_table .status', function () {
        if ($(this).text() == "ACTIVE") {
            link = "/admin/disableProduct"
        } else {
            link = "/admin/activeProduct"
        }
        status = false
        $.ajax({
            type: "POST",
            url: BASEURL + link,
            data: { 'id': $(this).attr('id_p') },
            dataType: 'JSON'
        }).then(
            // resolve/success callback
            function (response) {
                if (response.status) {
                    status = true;
                }
            },
            // reject/failure callback
            function () {
                alert('There was some error!');
            }
        )
        if (status) {
            $("#product_table").DataTable().ajax.reload()
            a = $(".status")
            for (i = 0; i < a.length; i++) {
                if (a.eq(i).attr('id_w') == $(this).attr('id_p')) {
                    a.eq(i).toggleClass('btn-success')
                    a.eq(i).toggleClass('btn-danger')
                    if (a.eq(i).text() == "ACTIVE") {
                        a.eq(i).parents('tr').find('button.modify').removeAttr('disabled')
                    } else {
                        a.eq(i).parents('tr').find('button.modify').attr('disabled', 'true')
                    }
                }
            }
        }
    })
    /**
     * 
     * 
     * product .modify
     */
    function readURL(input) {
        if (input.files && input.files[0]) {
            reader = new FileReader();
            reader.onload = function (e) {
                $('img#img-product').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("input#Img").change(function () {
        readURL(this);
    });
    p_modify = null
    $(document).on('click', 'button.AddWarehouse', function () {
        p = $(this).parents('.form-row')
        s = p.html()
        len = $(".form-row").length
        len_o = $("select#Warehouse:first option").length
        if (len <= len_o) {
            s = s.replace('<button class="AddWarehouse btn btn-success" type="button"><i class="fas fa-plus"></i></button>',
                '<button class="RemoveWarehouse btn btn-danger" type="button"><i class="fas fa-times"></i></button>')
            s = '<div class="form-row form-group">' + s + '</div>'
            p.after(s)
        }
        if (len + 1 == len_o) {
            $(this).attr('disabled', 'true')
        }
    })
    $(document).on('click', 'button.RemoveWarehouse', function () {
        p = $(this)
        p.parents('.form-row').remove()
        $("button.AddWarehouse").removeAttr('disabled')
    })
    $(document).on('focus', 'select.Warehouse', function () {
        $(this).data('lastValue', $(this).val());
    });
    $(document).on('change', 'select.Warehouse', function () {
        var lastRole = $(this).data('lastValue');
        p = $("div.form-row")
        w = []
        for (i = 0; i < p.length; i++) {
            w.push(p.eq(i).find("option:selected").val())
            if (i != 0) {
                if (w[i - 1] == w[i]) {
                    alert("Lỗi: kho đã tồn tại")
                    $(this).val(lastRole);
                    return false;
                }
            }
        }

    })
    $(document).on('click', '#product_table .modify', function () {
        p_id = $(this).attr('id_p')
        p_modify = $(this)
        const data = {
            'id': p_id
        }
        $("input#Img").val('')
        TypeProduct = null
        /**
         * 
         * get product
         */
        $.ajax({
            type: "POST",
            url: BASEURL + "/admin/getOneProduct",
            data: data,
            dataType: 'JSON'
        }).then(
            // resolve/success callback
            function (response) {
                $("input#Name").val(response.data['name'])
                $("input#Brand").val(response.data['brand'])
                $("input#Color").val(response.data['color'])
                $("input#Price").val(response.data['price'])
                if (response.data['img'] != null) {
                    $("img#img-product").attr('src', response.data['img'])
                }
                $("input#Short-Description").val(response.data['short_discription'])
                $("textarea#Description").val(response.data['discription'])
                TypeProduct = response.data['id_type']
                $.ajax({
                    type: "POST",
                    url: BASEURL + "/admin/getTypeProductForTagSelect",
                    dataType: 'JSON'
                }).then(
                    // resolve/success callback
                    function (response) {
                        if (response.status) {
                            $("select.Type-product option").remove()
                            s = ""
                            for (i = 0; i < response.data.length; i++) {
                                s += '<option value="' + response.data[i][0] + '">' + response.data[i][1] + '</option>'
                            }
                            $("select.Type-product").append(s)
                            $("select.Type-product option[value='" + TypeProduct + "'").attr('selected', 'true')
                        }
                    },
                    // reject/failure callback
                    function () {
                        alert('There was some error tp!');
                    }
                )
            },
            // reject/failure callback
            function () {
                alert('There was some error p!');
            }
        )

        Warehouse = null
        $.ajax({
            type: "POST",
            url: BASEURL + "/admin/getWarehouseByIdProduct",
            data: data,
            dataType: 'JSON'
        }).then(
            // resolve/success callback
            function (response) {
                if (response.status) {
                    Warehouse = response.data
                    $("input.Quantity").val(0)
                    $.ajax({
                        type: "POST",
                        url: BASEURL + "/admin/getWarehouseForTagSelect",
                        dataType: 'JSON'
                    }).then(
                        // resolve/success callback
                        function (response) {
                            if (response.status) {
                                p = $("div.form-row")
                                $("button.AddWarehouse").removeAttr('disabled')
                                for (i = 1; i < p.length; i++) p.eq(i).remove()

                                $("select.Warehouse option").remove()
                                s = ""
                                for (i = 0; i < response.data.length; i++) {
                                    s += '<option value="' + response.data[i][0] + '">' + response.data[i][1] + '</option>'
                                }
                                $("select.Warehouse").append(s)

                                p = $("div.form-row")
                                s = p.html()
                                s = s.replace('<button class="AddWarehouse btn btn-success" type="button"><i class="fas fa-plus"></i></button>',
                                    '<button class="RemoveWarehouse btn btn-danger" type="button"><i class="fas fa-times"></i></button>')
                                len_o = $("select#Warehouse:first option").length
                                if (len_o == Warehouse.length) $("button.AddWarehouse").attr('disabled', 'true')
                                for (i = 0; i < Warehouse.length; i++) {
                                    if (i == 0) {
                                        p.find("option[value='" + Warehouse[0].id_warehouse + "'").attr('selected', 'true')
                                        p.find("input#Quantity").val(Warehouse[0].quantity)
                                    } else {
                                        a = '<div class="form-row form-group" r_wh="' + i + '">' + s + '</div>'
                                        p.after(a)
                                        $("div.form-row[r_wh='" + i + "']").find("option[value='" + Warehouse[i].id_warehouse + "'").attr('selected', 'true')
                                        $("div.form-row[r_wh='" + i + "']").find("input#Quantity").val(Warehouse[i].quantity)
                                    }
                                }
                            }
                        },
                        // reject/failure callback
                        function () {
                            alert('There was some error whd!');
                        }
                    )
                }
            },
            // reject/failure callback
            function () {
                alert('There was some error wh!');
            }
        )
    })

    $(document).on('click', '#p-save', function () {
        id = p_modify.attr('id_p')
        p = $("div.form-row")
        w = []
        for (i = 0; i < p.length; i++) {
            w.push([p.eq(i).find("input#Quantity").val(), id,
            p.eq(i).find("option:selected").val()])
            if (i > 0) {
                if (w[i][2] == w[i - 1][2]) {
                    alert('Kho ko được trùng')
                    return
                }
            }
        }
        const data = {
            'id': id,
            'name': $(".modal-body input#Name").val(),
            'brand': $(".modal-body input#Brand").val(),
            'color': $(".modal-body input#Color").val(),
            'price': $(".modal-body input#Price").val(),
            'img': $("img#img-product").attr('src'),
            'short_discription': $("input#Short-Description").val(),
            'discription': $("textarea#Description").val(),
            'id_type': $("select.Type-product option:selected").val(),
            'warehouse': w
        }
        $.ajax({
            type: "POST",
            url: BASEURL + "/admin/saveProduct",
            data: data,
            dataType: 'JSON'
        }).then(
            // resolve/success callback
            function (response) {
                if (response.status) {
                    $("#product_table").DataTable().ajax.reload()
                    $('#modify-product').modal('toggle')
                    p_modify = null
                } else {
                    alert('error to save')
                }
            },
            // reject/failure callback
            function () {
                alert('There was some error sp!');
            }
        )
    })
    /**
     * 
     * insert p
     */
    $(document).on('click', '#p-insert', function () {
        p = $("div.form-row")
        w = []
        check = true
        for (i = 0; i < p.length; i++) {
            w.push([p.eq(i).find("input#Quantity").val(),
            p.eq(i).find("option:selected").val()])
            if (w[i][0] == "") {
                p.eq(i).find("input.Quantity").addClass("is-invalid")
                check = false
            }
            else
                p.eq(i).find("input.Quantity").removeClass("is-invalid")
            if (i > 0) {
                if (w[i][1] == w[i - 1][1]) {
                    alert('Kho ko được trùng')
                    return
                }
            }
        }
        const data = {
            'name': $("input#Name").val(),
            'brand': $("input#Brand").val(),
            'color': $("input#Color").val(),
            'price': $("input#Price").val(),
            'img': $("img#img-product").attr('src'),
            'short_discription': $("input#Short-Description").val(),
            'discription': $("textarea#Description").val(),
            'id_type': $("select.Type-product option:selected").val(),
            'warehouse': w
        }
        console.log(w);
        if (data.name == "") {
            $("input.Name").addClass("is-invalid")
            check = false
        }
        else
            $("input.Name").removeClass("is-invalid")

        if (data.brand == "") {
            $("input.Brand").addClass("is-invalid")
            check = false
        }
        else
            $("input.Brand").removeClass("is-invalid")

        if (data.price == "") {
            $("input.Price").addClass("is-invalid")
            check = false
        }
        else
            $("input.Price").removeClass("is-invalid")

        if (data.short_discription == "") {
            $("input.Short-Description").addClass("is-invalid")
            check = false
        }
        else
            $("input.Short-Description").removeClass("is-invalid")

        if (check) {
            $.ajax({
                type: "POST",
                url: BASEURL + "/admin/insertProduct",
                data: data,
                dataType: 'JSON'
            }).then(
                // resolve/success callback
                function (response) {
                    if (response.status) {
                        $('.alert').remove()
                        s = '<div class="alert alert-success text-center" role="alert">'
                        s += 'Thêm loại sản phẩm thành công thành công!!'
                        s += '</div>'
                        $("#admin-navbar").after(s)
                    }
                },
                // reject/failure callback
                function () {
                    alert('There was some error ip!');
                }
            )
        }
    })

    /**
     * 
     * ORDER HANDLE admin site
     * 
     * 
     */
    // modify order
    $(document).on('click', '#order_table .modify', function () {
        o_id = $(this).attr('id_o')
        $.ajax({
            type : "POST",
            url : BASEURL + "/admin/detailOrder",
            data : {'id_o' : o_id},
            dataType : 'JSON'
        }).then(
            function(res){
                o = res.order
                $("#modify-order .modal-body").attr('id_o',o.id)
                $("input#Name").val(o.full_name)
                $("input#Phone").val(o.phone)
                $("input#shipping-fee").val(o.shipping_fee)
                $("input#City").val(o.city)
                $("input#Province").val(o.province)
                $("input#Address").val(o.address)
                od = res.od
                w = res.w
                $('#modify-order .order-detail').empty()
                for(i=0; i<od.length; i++){
                    s = '<div class="form-group product-detail-order row">'
                    s += '<label class="col-12"><strong><i class="fas fa-boxes"></i> Tên sản phẩm: </strong>'
                    s += '<span class="name_product" id_p="'+od[i].id_product+'">'+od[i].name+'</span></label>'
                    s += '<div class="form-group form-inline col-12"><strong class="col-4">Số lượng: &nbsp</strong>'
                    s += '<input type="number" class="form-control quantity col-8" value="'+od[i].quantity+'" min="1">'
                    s += '</div><div class="form-group form-inline col-12"><strong class="col-4">Giá: &nbsp</strong>'
                    s += '<input type="number" class="form-control price col-8" value="'+od[i].price+'">'
                    s += '</div><div class="form-group form-inline col-12"><strong class="col-4">Kho: &nbsp</strong>'
                    s += '<select class="form-control Warehouse col-8">'
                    wd = w[i]
                    for(j=0; j<wd.length; j++){
                        s+= '<option value="'+wd[j].id+'" quan="'+wd[j].quantity+'">'+wd[j].display+'</option>'
                    }
                    s += '</select></div></div><hr>';
                    $('.order-detail').append(s)
                }
            },
            function(){
                alert('error detail order')
            }
        )
    })
    //confirm order
    $(document).on('click', '#o-confirm', function () {
        __w = $(".product-detail-order")
        od = []
        o = {}
        o.id = $("#modify-order .modal-body").attr('id_o')
        o.full_name = $("input#Name").val()
        o.shipping_fee = $("input#shipping-fee").val()
        o.city = $("input#City").val()
        o.province = $("input#Province").val()
        o.address = $("input#Address").val()
        o.total_price = parseInt(o.shipping_fee)
        
        for(i=0; i<__w.length; i++){
            wd = {}
            wd.id_p = __w.eq(i).find(".name_product").attr('id_p')
            wd.quan = __w.eq(i).find("input.quantity").val()
            wd.price = __w.eq(i).find("input.price").val()
            wd.id_w = __w.eq(i).find("option:selected").val()
            wd.quan_w = __w.eq(i).find("option:selected").attr('quan') - wd.quan
            if(wd.quan_w < 0){
                alert('Số lượng sản phẩm ' + __w.eq(i).find(".name_product").text() +' quá lớn!!')
                return
            }
            if(wd.price < 0){
                alert('Giá sản phẩm ' + __w.eq(i).find(".name_product").text() +' bé hơn 0!!')
                return
            }
            o.total_price += wd.quan * wd.price
            od.push(wd)
        }
        
        const data = {
            'od' : od,
            'o' : o
        }
        console.log(data)
        test=data
        $.ajax({
            type: "POST",
            url: BASEURL + "/admin/confirmOrder",
            data: data,
            dataType: 'JSON'
        }).then(
            function (res) {
                console.log(res)
                if(res.status){
                    $("#order_table").DataTable().ajax.reload()
                    $("#modify-order").modal('toggle')
                } else {
                    alert('error when confirm')
                }
            }, 
            function () {
                alert('erorr handle confirm')
            }
        )
    })
    // next status
    $(document).on('click', '.next-status', function () {
        id = $(this).attr('id_o') 
        $.ajax({
            type : "POST",
            url : BASEURL + "/admin/nextStatus",
            data : { 'id' : id },
            dataType : 'JSON'
        }).then(
            function (res) {
                console.log(res)
                if(res.status){
                    $("#order_table").DataTable().ajax.reload()
                } else {
                    alert('error handle next status')
                }
            },
            function () {
                alert('error when handle')
            }
        )
    })
    // cancel
    $(document).on('click', '.o-cancel', function () {
        id = $(this).attr('id_o') 
        $.ajax({
            type : "POST",
            url : BASEURL + "/admin/cancel",
            data : { 'id' : id },
            dataType : 'JSON'
        }).then(
            function (res) {
                console.log(res)
                if(res.status){
                    $("#order_table").DataTable().ajax.reload()
                } else {
                    alert('error handle next status')
                }
            },
            function () {
                alert('error when handle')
            }
        )
    })
     /**
     * 
     * INVOICE HANDLE admin site
     * 
     * 
     */
    // detail order
    $(document).on('click', '#order_table .detail', function () {
        o_id = $(this).attr('id_o')
        $("#detail-order h5").text('Thông tin đơn hàng ID: ' + o_id)
        $.ajax({
            type : "POST",
            url : BASEURL + "/admin/detailOrder",
            data : {'id_o' : o_id},
            dataType : 'JSON'
        }).then(
            function(res){
                o = res.order
                $("#detail-order .modal-body").attr('id_o',o.id)
                $("input#Name_m").val(o.full_name)
                $("input#Phone_m").val(o.phone)
                $("input#shipping-fee_m").val(o.shipping_fee)
                $("input#City_m").val(o.city)
                $("input#Province_m").val(o.province)
                $("input#Address_m").val(o.address)
                od = res.od
                w = res.w
                $('#detail-order .order-detail').empty()
                for(i=0; i<od.length; i++){
                    s = '<div class="form-group product-detail-order row">'
                    s += '<label class="col-12"><strong><i class="fas fa-boxes"></i> Tên sản phẩm: </strong>'
                    s += '<span class="name_product" id_p="'+od[i].id_product+'">'+od[i].name+'</span></label>'
                    s += '<div class="form-group form-inline col-12"><strong class="col-4">Số lượng: &nbsp</strong>'
                    s += '<input type="number" class="form-control quantity col-8" value="'+od[i].quantity+'" disabled>'
                    s += '</div><div class="form-group form-inline col-12"><strong class="col-4">Giá: &nbsp</strong>'
                    s += '<input type="number" class="form-control price col-8" value="'+od[i].price+'" disabled>'
                    s += '</div><div class="form-group form-inline col-12"><strong class="col-4">Kho: &nbsp</strong>'
                    s += '<select class="form-control Warehouse col-8" disabled>'
                    wd = w[i]
                    for(j=0; j<wd.length; j++){
                        if (od[i].id_warehouse == wd[j].id){
                            s+= '<option selected value="'+wd[j].id+'" quan="'+wd[j].quantity+'">'+wd[j].name+'</option>'
                        }
                    }
                    s += '</select></div></div><hr>';
                    $('#detail-order .order-detail').append(s)
                }
            },
            function(){
                alert('error detail order')
            }
        )
    })
     /**
     * 
     * ORDER CANCEL HANDLE admin site
     * 
     * 
     */
    // detail order cancel, invoice
    $(document).on('click', '#invoice_table .detail, #order_cancel_table .detail', function () {
        o_id = $(this).attr('id_o')
        $.ajax({
            type : "POST",
            url : BASEURL + "/admin/detailOrder",
            data : {'id_o' : o_id},
            dataType : 'JSON'
        }).then(
            function(res){
                o = res.order
                $(".modal-body").attr('id_o',o.id)
                $("input#Name").val(o.full_name)
                $("input#Phone").val(o.phone)
                $("input#shipping-fee").val(o.shipping_fee)
                $("input#City").val(o.city)
                $("input#Province").val(o.province)
                $("input#Address").val(o.address)
                od = res.od
                w = res.w
                $('.order-detail').empty()
                for(i=0; i<od.length; i++){
                    s = '<div class="form-group product-detail-order row">'
                    s += '<label class="col-12"><strong><i class="fas fa-boxes"></i> Tên sản phẩm: </strong>'
                    s += '<span class="name_product" id_p="'+od[i].id_product+'">'+od[i].name+'</span></label>'
                    s += '<div class="form-group form-inline col-12"><strong class="col-4">Số lượng: &nbsp</strong>'
                    s += '<input type="number" class="form-control quantity col-8" value="'+od[i].quantity+'" disabled>'
                    s += '</div><div class="form-group form-inline col-12"><strong class="col-4">Giá: &nbsp</strong>'
                    s += '<input type="number" class="form-control price col-8" value="'+od[i].price+'" disabled>'
                    s += '</div><div class="form-group form-inline col-12"><strong class="col-4">Kho: &nbsp</strong>'
                    s += '<select class="form-control Warehouse col-8" disabled>'
                    wd = w[i]
                    for(j=0; j<wd.length; j++){
                        if (od[i].id_warehouse == wd[j].id){
                            s+= '<option selected value="'+wd[j].id+'" quan="'+wd[j].quantity+'">'+wd[j].name+'</option>'
                        }
                    }
                    s += '</select></div></div><hr>';
                    $('.order-detail').append(s)
                }
            },
            function(){
                alert('error detail order')
            }
        )
    })
})

/*!
 * Start Bootstrap - SB Admin 2 v4.1.3 (https://startbootstrap.com/theme/sb-admin-2)
 * Copyright 2013-2020 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin-2/blob/master/LICENSE)
 */

!function ($) {
    "use strict"; // Start of use strict

    // Toggle the side navigation
    $("#sidebarToggle, #sidebarToggleTop").on('click', function (e) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
        if ($(".sidebar").hasClass("toggled")) {
            $('.sidebar .collapse').collapse('hide');
        };
    });

    // Close any open menu accordions when window is resized below 768px
    $(window).resize(function () {
        if ($(window).width() < 768) {
            $('.sidebar .collapse').collapse('hide');
        };

        // Toggle the side navigation when window is resized below 480px
        if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
            $("body").addClass("sidebar-toggled");
            $(".sidebar").addClass("toggled");
            $('.sidebar .collapse').collapse('hide');
        };
    });

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
        if ($(window).width() > 768) {
            var e0 = e.originalEvent,
                delta = e0.wheelDelta || -e0.detail;
            this.scrollTop += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
        }
    });

    // Scroll to top button appear
    $(document).on('scroll', function () {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $('.scroll-to-top').fadeIn();
        } else {
            $('.scroll-to-top').fadeOut();
        }
    });

    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function (e) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top)
        }, 1000, 'easeInOutExpo');
        e.preventDefault();
    });

}(jQuery);

//---------------------------------------------End of ADMIN SITE



/**
 * 
 * 
 * Handle for CART
 * load, order, modify
 * 
 * 
 * 
 */

formatPrice = function (price) {
    r = "";
    c = 0;
    for (i = price.length - 1; i >= 0; i--) {
        if (c % 3 == 0 && c != 0) {
            r += ",";
        }
        r += price[i];
        c++
    }
    return r.split("").reverse().join("");
}
$(document).ready(function () {
    updateCD = function (input) {
        val = input.val()
        total_p = formatPrice((parseInt(price) * parseInt(val)).toString()) + " ₫"
        input.parents('.cart_product').find('.total_price').text(total_p)
        input.parents('.cart_product').find('.total_price').attr('total_p', (parseInt(price) * parseInt(val)))
        total = 0
        arr = $(".total_price")
        for (i = 0; i < arr.length; i++) {
            total += parseInt(arr.eq(i).attr('total_p'))
        }
        $("#tamtinh_c").text(formatPrice(total.toString()))
        $("#thanhtien_c").text(formatPrice(total.toString()))
        $("#tamtinh_c").attr('tien', total)
        $("#thanhtien_c").attr('tien', total)
    }
    $(document).on('change', 'input.quantity-p', function () {
        val = $(this).val()
        price = $(this).parents('.cart_product').find('.price_p').attr('price_p')
        id = $(this).attr('id_p')
        account = $("strong.account_user").text()
        cart = JSON.parse(localStorage.getItem('cart'))
        if (account == "") {
            for (i = 0; i < cart.length; i++) {
                if (cart[i].id == id) {
                    cart[i].quan = val
                    break
                }
            }
            localStorage.setItem('cart', JSON.stringify(cart))
            updateCD($(this))
        } else {
            input = $(this)
            const data = {
                'id_p': id,
                'quan': val
            }
            $.ajax({
                type: 'POST',
                url: BASEURL + '/cart/updateQuantity',
                data: data,
                dataType: 'JSON'
            }).then(
                function (res) {
                    console.log(res)
                    if (res.status) {
                        updateCD(input)
                    } else {
                        alert('error updatecd')
                    }
                },
                function () {
                    alert('some error')
                }
            )
        }
    })
    $(document).on('click', '.xoa_cart_p', function (e) {
        e.preventDefault()
        id = $(this).attr('id_p')
        account = $("strong.account_user").text()
        cart = JSON.parse(localStorage.getItem('cart'))
        if (account == "") {
            for (i = 0; i < cart.length; i++) {
                if (cart[i].id == id) {
                    cart.splice(i, 1)
                    break
                }
            }
            localStorage.setItem('cart', JSON.stringify(cart))
            loadCart(account)
        } else {
            //remove cart detail
            cd = $(this)
            const data = {
                'id_p': id
            }
            $.ajax({
                type: 'POST',
                url: BASEURL + '/cart/removeCartDetail',
                data: data,
                dataType: 'JSON'
            }).then(
                function (res) {
                    console.log(res)
                    if (res.status) {
                        loadCart(account)
                    } else {
                        alert('error removecd')
                    }
                },
                function () {
                    alert('some error')
                }
            )
        }
    })
})
displayCart = function (cart) {
    if (cart == null || cart.length == 0) {
        $("#content").empty()
        s = '<img src="' + BASEURL + '/public/assets/img/cart-empty.png" class="img-fluid">'
        s += '<p class="text-secondary mt-3"><i>Chưa có sản phẩm nào</i></p>'
        $("#content").append(s)
        $("#content").addClass("bg-light text-center p-4")
        $("#content").removeClass("row")
    } else {
        $("#quantity_sp").text(cart.length)
        $("#body_cart").empty()
        total = 0
        for (i = 0; i < cart.length; i++) {
            const data = {
                'id_p': cart[i].id,
                'quan': cart[i].quan
            }
            $.ajax({
                type: 'POST',
                url: BASEURL + '/cart/getInfoByIdProduct',
                data: data,
                dataType: 'JSON'
            }).then(
                function (res) {
                    if(res.quan > res.p.quantity){
                        res.quan = res.p.quantity
                        const data = {
                            'id_p': res.p.id,
                            'quan': res.p.quantity
                        }
                        $.ajax({
                            type: 'POST',
                            url: BASEURL + '/cart/updateQuantity',
                            data: data,
                            dataType: 'JSON'
                        }).then(
                            function (res) {
                                if (res.status) {
                                    // updateCD(input)
                                } else {
                                    alert('error updatecd')
                                }
                            },
                            function () {
                                alert('some error update cartdetail')
                            }
                        )
                    }
                    ct = '<hr>'
                    ct += '<div class="row mt-1 cart_product"><div class="col-lg-6 col-md-6"><div class="row ml-2">'
                    ct += '<div class="col-4 p-0"><a href="' + BASEURL + '/product/infoProduct/' + res.p.id + '">'
                    ct += '<img class="img-fluid border" src="' + res.p.img + '"></a></div>'
                    ct += '<div class="col-8 p-0 pl-3 d-flex align-items-start flex-column"><a class="name-product" href="' + BASEURL + '/product/infoProduct/' + res.p.id + '">'
                    ct += res.p.name + '</a>' + '<div class="mt-auto"><a class="xoa_cart_p" href="" id_p="' + res.p.id + '">Xóa</a></div>'
                    ct += '</div></div></div><div class="col-lg-2 col-md-2">'
                    ct += '<p class="price-product mt-2 mb-2 price_p" price_p="' + res.p.price + '">' + formatPrice(res.p.price) + ' ₫</p></div>'
                    ct += '<div class="col-lg-2 col-md-2">'
                    ct += '<input type="number" class="form-control quantity-p" id_p="' + res.p.id + '"'
                    ct += 'value="' + parseInt(res.quan) + '" min="1" max="' + res.p.quantity + '"></div>'
                    ct += '<div class="col-lg-2 col-md-2">'
                    ct += '<p class="price-product mt-2 mb-2 total_price" total_p="'
                    ct += (parseInt(res.quan) * parseInt(res.p.price)) + '">'
                    ct += formatPrice((parseInt(res.quan) * parseInt(res.p.price)).toString())
                    ct += ' ₫</p></div></div>'
                    $("#body_cart").append(ct)
                    total += parseInt(res.quan) * parseInt(res.p.price)
                    $("#tamtinh_c").text(formatPrice(total.toString()))
                    $("#thanhtien_c").text(formatPrice(total.toString()))
                    $("#tamtinh_c").attr('tien', total)
                    $("#thanhtien_c").attr('tien', total)
                },
                function () {
                    alert('error display')
                }
            )
        }
    }
}
loadCart = function (acc = "") {
    if (acc == "") {
        cart = JSON.parse(localStorage.getItem('cart'))
        displayCart(cart)
    } else {
        $.ajax({
            type: 'POST',
            url: BASEURL + '/cart/getCartInfo',
            dataType: 'JSON'
        }).then(
            function (res) {
                displayCart(res)
            },
            function () {
                alert('error load cart info')
            }
        )
    }
}
//-------------------------------------END OF CART HANDLE




/**
 * 
 * 
 * Handle for ORDER
 * display, input address, confirm 
 * 
 * 
 * 
 */
displayOrder = function (cart) {
    if (cart == null || cart.length == 0) {
        $("#content").empty()
        s = '<img src="' + BASEURL + '/public/assets/img/cart-empty.png" class="img-fluid">'
        s += '<p class="text-secondary mt-3"><i>Chưa có sản phẩm nào</i></p>'
        $("#content").append(s)
        $("#content").addClass("bg-light text-center p-4")
        $("#content").removeClass("row")
        return
    }
    tt = 0
    total = 20000
    for (i = 0; i < cart.length; i++) {
        const data = {
            'id_p': cart[i].id,
            'quan': cart[i].quan
        }
        $.ajax({
            type: 'POST',
            url: BASEURL + '/cart/getInfoByIdProduct',
            data: data,
            dataType: 'JSON'
        }).then(
            function (res) {
                ct = '<div class="row cart-detail" id_p="'+res.p.id+'"><div class="col-3">'
                ct += '<a class="cart_list_product_img" href="' + BASEURL + '/product/infoProduct/' + res.p.id + '">'
                ct += '<img class="img-fluid border" src="' + res.p.img + '"></a></div>'
                ct += '<div class="col-9 order-detail-p"><a class="name-product" href="' + BASEURL + '/product/infoProduct/' + res.p.id + '">'
                ct += res.p.name + '</a><div class="d-flex"><p><span id="quantity">'+res.quan+'</span> x '
                ct += '<span class="price-product" id="price" price_p="' + res.p.price + '">'+formatPrice(res.p.price)+'₫</span></p>'
                ct += '<div class="ml-auto mr-2 price-product">' + formatPrice((parseInt(res.quan) * parseInt(res.p.price)).toString())
                ct += '₫</div></div></div></div>'
                ct += '<hr>'

                $("#info-cart").append(ct)
                total += parseInt(res.quan) * parseInt(res.p.price)
                tt += parseInt(res.quan) * parseInt(res.p.price)
                $("#tamtinh_c").text(formatPrice(tt.toString()))
                $("#thanhtien_c").text(formatPrice(total.toString()))
                $("#tamtinh_c").attr('tien', tt)
                $("#thanhtien_c").attr('tien', total)
            },
            function () {
                alert('error display')
            }
        )
    }
}
loadOrder = function (acc = "") {
    if (acc == "") {
        cart = JSON.parse(localStorage.getItem('cart'))
        displayOrder(cart)
    } else {
        $.ajax({
            type: 'POST',
            url: BASEURL + '/cart/getCartInfo',
            dataType: 'JSON'
        }).then(
            function (res) {
                console.log(res)
                displayOrder(res)
            },
            function () {
                alert('error load order info')
            }
        )
    }
}
loadAddress = function(){
    $.ajax({
        type: 'POST',
        url: BASEURL + '/user/getAddressInfo',
        dataType: 'JSON'
    }).then(
        function (res) {
            $("#FullName").val(res.fullName)
            $("#Phone").val(res.phone)
            $("#Address").val(res.address)
            $("#City").val(res.city)
            $("#Province").val(res.province)
        },
        function () {
            alert('error load address info')
        }
    )
}
removeAllCD = function(Account){
    if(Account == ""){
        localStorage.removeItem('cart')
    } else {
        $.ajax({
            type : "POST",
            url  : BASEURL + "/cart/removeAllCartDetail"
        }).then(
            function(res){
            },
            function(){
                alert('error')
            }
        )
    }
}
$(document).ready(function(){
    $("#btn-tt").click(function(){
        arr = $(".cart-detail")
        cd_arr = []
        total = 20000
        for(i=0; i<arr.length; i++){
            quan = arr.eq(i).find('span#quantity').text()
            price = arr.eq(i).find('span#price').attr('price_p')
            total += parseInt(quan)*parseInt(price)
            cd = {
                'id' : arr.eq(i).attr('id_p'),
                'quan' : quan,
                'price' : price
            }
            cd_arr.push(cd);
        }
        od = {
            'Account' : $('strong.account_user').text(),
            'FullName' : $("input#FullName").val(),
            'Phone' : $('input#Phone').val(),
            'Address' : $('input#Address').val(),
            'City' : $('input#City').val(),
            'Province' : $('input#Province').val(),
            'Total' : total.toString(),
            'Cd' : cd_arr
        }

        if (od.FullName == ""){
            $(".FullName").addClass("is-invalid")
            return
        }
        else
            $(".FullName").removeClass("is-invalid")

        if (od.Phone == ""){
            $(".Phone").addClass("is-invalid")
            return
        }
        else
            $(".Phone").removeClass("is-invalid")

        if (od.Address == ""){
            $(".Address").addClass("is-invalid")
            return
        }
        else
            $(".Address").removeClass("is-invalid")

        if (od.City == ""){
            $(".City").addClass("is-invalid")
            return
        }
        else
            $(".City").removeClass("is-invalid")

        if (od.Province == ""){
            $(".Province").addClass("is-invalid")
            return
        }
        else
            $(".Province").removeClass("is-invalid")
        
        
        $.ajax({
            type: 'POST',
            url: BASEURL+'/order/order',
            data: od,
            dataType: 'JSON'
        }).then(
            //success
            function(res){
                if(res.status){
                    removeAllCD(od.Account)
                    s = '<div class="row pr-4 pl-2 pt-2">'
                    s += '<b class="col">Họ và tên: </b>'
                    s += '<p class="col">'+od.FullName+'</p></div>'
                    s += '<div class="row pr-4 pl-2">'
                    s += '<b class="col">Số điện thoại: </b>'
                    s += '<p class="col">'+od.Phone+'</p></div>'
                    s += '<div class="row pr-4 pl-2">'
                    s += '<b class="col">Địa chỉ: </b>'
                    s += '<p class="col">'+od.Address+', '+od.Province+', '+od.City+'</p></div>'
                    s += '<div class="row"><i class="col text-secondary">*Đặt hàng thành công, '
                    s += 'có điện thoại xác nhận trong 24h tới</i></div>'
                    $("#info-order").html(s)
                } else {
                    alert('fail order')
                }
            },
            //fail
            function(){
                alert('error order')
            }
        )
    })
})



//-------------------------------------END OF ORDER HANDLE




/**
 * 
 * 
 * Handle for PRODUCT view
 * add ro cart, 
 * 
 * 
 * 
 */
$(document).ready(function () {
    $(".addToCart").click(function () {
        const data = {
            'account': $(".account_user").text(),
            'id_p': $(this).parents('div.row').attr('id_p'),
            'quan': $("input.quantity").val()
        }
        if ($(".account_user").text() != "") {
            $.ajax({
                type: 'POST',
                url: BASEURL + '/product/addCart',
                data: data,
                dataType: 'JSON'
            }).then(
                function (res) {
                    if (res.status == true) {
                        $('.alert').remove()
                        s = '<div class="container mt-3 alert alert-success alert-dismissible fade show" role="alert">'
                        s += 'Thêm vào giỏ thành công'
                        s += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                        s += '<span aria-hidden="true">&times;</span></button>'
                        s += '</div>'
                        $("nav").after(s)
                    } else {
                        alert('error')
                    }
                },
                function () {
                    alert("error addCart")
                }
            )
        } else {
            cart = JSON.parse(localStorage.getItem('cart'))
            r = {
                'id': data['id_p'],
                'quan': data['quan']
            }
            if (cart == null) {
                cart = []
                cart.push(r)
            } else {
                ck = false
                for (i = 0; i < cart.length; i++) {
                    console.log(cart[i])
                    if (cart[i].id == r.id) {
                        cart[i].quan = parseInt(cart[i].quan) + 1
                        ck = true
                        break
                    }
                }
                if (!ck) {
                    cart.push(r)
                }
            }
            $('.alert').remove()
            localStorage.setItem('cart', JSON.stringify(cart))
            s = '<div class="container mt-3 alert alert-success alert-dismissible fade show" role="alert">'
            s += 'Thêm vào giỏ thành công'
            s += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
            s += '<span aria-hidden="true">&times;</span></button>'
            s += '</div>'
            $("nav").after(s)
        }
    })
})
//-------------------------------------END OF PRODUCT HANDLE



/**
 * 
 * 
 * Handle for USER
 * signup, login, logout, create new user 
 * 
 * 
 * 
 */
//signup page
$(document).ready(function () {
    $(".Password, .conPassword").keyup(function () {
        Password = $("#Password").val()
        conPassword = $("#conPassword").val()
        if (Password != conPassword) {
            $(".conPasswordError").html("Mật khẩu xác nhận sai!!")
            $(".conPassword").addClass("is-invalid")
        } else {
            $(".conPassword").removeClass("is-invalid")
        }
    })
    $("input").keydown(function () {
        val = $(this).val()
        $(this).removeClass("is-invalid")
    })
    $(document).on('click', '#signup', function () {
        $(".alert").remove()
        const userData = {
            'Account': $("#Account").val(),
            'Password': $("#Password").val(),
            'FullName': $("#FullName").val(),
            'Email': $("#Email").val(),
            'Phone': $("#Phone").val(),
            'Address': $("#Address").val(),
            'City': $("#City").val(),
            'Province': $("#Province").val(),
        }
        conPassword = $("#conPassword").val()
        if (userData.Account == "")
            $(".Account").addClass("is-invalid")
        else
            $(".Account").removeClass("is-invalid")

        if (userData.Password == "")
            $(".Password").addClass("is-invalid")
        else
            $(".Password").removeClass("is-invalid")

        if (userData.FullName == "")
            $(".FullName").addClass("is-invalid")
        else
            $(".FullName").removeClass("is-invalid")

        if (userData.Email == "")
            $(".Email").addClass("is-invalid")
        else
            $(".Email").removeClass("is-invalid")

        if (userData.Phone == "")
            $(".Phone").addClass("is-invalid")
        else
            $(".Phone").removeClass("is-invalid")

        if (userData.Address == "")
            $(".Address").addClass("is-invalid")
        else
            $(".Address").removeClass("is-invalid")

        if (userData.City == "")
            $(".City").addClass("is-invalid")
        else
            $(".City").removeClass("is-invalid")

        if (userData.Province == "")
            $(".Province").addClass("is-invalid")
        else
            $(".Province").removeClass("is-invalid")

        if (userData.Account != "" && userData.Password != "" && userData.FullName != "" && userData.Address != ""
            && userData.Phone != "" && userData.City != "" && userData.Province != ""
            && userData.Password == conPassword) {
            $.ajax({
                type: "POST",
                url: BASEURL + '/user/createAccount',
                data: userData,
                dataType: 'JSON'
            }).then(
                // resolve/success callback
                function (response) {
                    $(".alert").remove()
                    if (response.status == true) {
                        s = '<div class="alert alert-success text-center" role="alert">'
                        s += 'Tạo tài khoản thành công!! <a href="' + BASEURL + '/user/login/" class="alert-link">Nhấn để đăng nhập</a>'
                        s += '</div>'
                        $(".container_s").before(s)
                    } else {
                        s = '<div class="alert alert-danger text-center" role="alert">'
                        s += 'Tạo tài khoản không thành công!!'
                        s += '</div>'
                        $(".container_s").before(s)
                        if (response.AccountError != null) {
                            $(".Account").addClass("is-invalid")
                            $(".AccountError").html(response.AccountError)
                        } else {
                            $(".Account").removeClass("is-invalid")
                        }
                        if (response.PhoneError != null) {
                            $(".Phone").addClass("is-invalid")
                            $(".PhoneError").html(response.PhoneError)
                        } else {
                            $(".Phone").removeClass("is-invalid")
                        }
                    }
                },
                // reject/failure callback
                function () {
                    alert('There was some error!');
                }
            )
        }
    })
    // Login
    $('#login').click(function () {
        $(".alert").remove()
        const userData = {
            'Account': $("#Account").val(),
            'Password': $("#Password").val()
        }
        if (userData.Account == "")
            $(".Account").addClass("is-invalid")
        else
            $(".Account").removeClass("is-invalid")

        if (userData.Password == "")
            $(".Password").addClass("is-invalid")
        else
            $(".Password").removeClass("is-invalid")

        if (userData.Account != "" && userData.Password != "") {
            $.ajax({
                type: "POST",
                url: BASEURL + '/user/loginAccount',
                data: userData,
                dataType: 'JSON'
            }).then(
                // resolve/success callback
                function (response) {
                    $(".alert").remove()
                    if (response.status == true) {
                        location.href = BASEURL;
                    } else {
                        s = '<div class="alert alert-danger text-center" role="alert">'
                        s += 'Đăng nhập không thành công!!'
                        s += '</div>'
                        $("header").after(s)
                        if (response.AccountError != null) {
                            $(".Account").addClass("is-invalid")
                            $(".AccountError").html(response.AccountError)
                        } else {
                            $(".Account").removeClass("is-invalid")
                        }
                        if (response.PasswordError != null) {
                            $(".Password").addClass("is-invalid")
                            $(".PasswordError").html(response.PasswordError)
                        } else {
                            $(".Password").removeClass("is-invalid")
                        }
                    }
                },
                // reject/failure callback
                function () {
                    alert('There was some error!');
                }
            )
        }
    })

    //Profile
    $("#stt").click(function () {
        $("#ltt").removeAttr('hidden')
        $(".FullName").removeAttr('readonly')
        $(".Email").removeAttr('readonly')
        $(".Address").removeAttr('readonly')
        $(".City").removeAttr('readonly')
        $(".Province").removeAttr('readonly')
    })

    $("#ltt").click(function () {
        $(".alert").remove()
        const userData = {
            'Account': $("#Account").text(),
            'Password': "",
            'FullName': $("#FullName").val(),
            'Email': $("#Email").val(),
            'Phone': $("#Phone").val(),
            'Address': $("#Address").val(),
            'City': $("#City").val(),
            'Province': $("#Province").val(),
        }

        if (userData.FullName == "")
            $(".FullName").addClass("is-invalid")
        else
            $(".FullName").removeClass("is-invalid")

        if (userData.Email == "")
            $(".Email").addClass("is-invalid")
        else
            $(".Email").removeClass("is-invalid")

        if (userData.Phone == "")
            $(".Phone").addClass("is-invalid")
        else
            $(".Phone").removeClass("is-invalid")

        if (userData.Address == "")
            $(".Address").addClass("is-invalid")
        else
            $(".Address").removeClass("is-invalid")

        if (userData.City == "")
            $(".City").addClass("is-invalid")
        else
            $(".City").removeClass("is-invalid")

        if (userData.Province == "")
            $(".Province").addClass("is-invalid")
        else
            $(".Province").removeClass("is-invalid")

        if (userData.Account != "" && userData.FullName != "" && userData.Address != ""
            && userData.Phone != "" && userData.City != "" && userData.Province != "") {
            $.ajax({
                type: "POST",
                url: BASEURL + '/user/updateUser',
                data: userData,
                dataType: 'JSON'
            }).then(
                // resolve/success callback
                function (response) {
                    $(".alert").remove()
                    if (response.status == true) {
                        s = '<div class="alert alert-success text-center" role="alert">'
                        s += 'Lưu thông tin tài khoản thành công!!'
                        s += '</div>'
                        $("header").after(s)
                        $("#ltt").attr('hidden', 'true')
                        $(".FullName").attr('readonly', 'true')
                        $(".Email").attr('readonly', 'true')
                        $(".Address").attr('readonly', 'true')
                        $(".City").attr('readonly', 'true')
                        $(".Province").attr('readonly', 'true')
                    } else {
                        s = '<div class="alert alert-danger text-center" role="alert">'
                        s += 'Lưu thông tin tài khoản không thành công!!'
                        s += '</div>'
                        $("header").after(s)
                    }
                },
                // reject/failure callback
                function () {
                    alert('There was some error!');
                }
            )
        }
    })
    $('#lmk').click(function () {
        $(".alert").remove()
        const userData = {
            'Account': $("#Account").text(),
            'Password': $("#oldPassword").val(),
            'FullName': $("#FullName").val(),
            'Email': $("#Email").val(),
            'Phone': $("#Phone").val(),
            'Address': $("#Address").val(),
            'City': $("#City").val(),
            'Province': $("#Province").val(),
        }
        newPassword = $("#Password").val()
        conPassword = $("#conPassword").val()

        if (conPassword == "")
            $(".conPassword").addClass("is-invalid")
        else
            $(".conPassword").removeClass("is-invalid")

        if (newPassword == "")
            $(".Password").addClass("is-invalid")
        else
            $(".Password").removeClass("is-invalid")

        if (userData.Password == "")
            $(".oldPassword").addClass("is-invalid")
        else
            $(".oldPassword").removeClass("is-invalid")

        if (userData.Password != "" && conPassword != "" && newPassword != ""
            && newPassword == conPassword) {
            $.ajax({
                type: "POST",
                url: BASEURL + '/user/updatePassword/' + newPassword,
                data: userData,
                dataType: 'JSON'
            }).then(
                // resolve/success callback
                function (response) {
                    $(".alert").remove()
                    if (response.status == true) {
                        s = '<div class="alert alert-success text-center" role="alert">'
                        s += 'Lưu mật khẩu mới thành công!!'
                        s += '</div>'
                        $(".lmk").before(s)
                    } else {
                        s = '<div class="alert alert-danger text-center" role="alert">'
                        s += 'Lưu mật khẩu mới không thành công!!'
                        s += '</div>'
                        $(".lmk").before(s)
                        if (response.PasswordError != null) {
                            $(".oldPasswordError").html(response.PasswordError)
                            $(".oldPassword").addClass("is-invalid")
                        } else {
                            $(".oldPassword").removeClass("is-invalid")
                        }
                    }
                },
                // reject/failure callback
                function () {
                    alert('There was some error!');
                }
            )
        }
    })
    function readURL(input) {
        if (input.files && input.files[0]) {
            reader = new FileReader();
            reader.onload = function (e) {
                $('#img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#Img").change(function () {
        readURL(this);
        $("#luu").removeAttr('hidden')
    });
    $("#luu").click(function () {
        const userData = {
            'Account': $("#Account").text(),
            'Password': "",
            'FullName': "",
            'Email': "",
            'Phone': "",
            'Address': "",
            'City': "",
            'Province': "",
            'Img': $('#img').attr('src')
        }
        //console.log(userData)
        $.ajax({
            type: "POST",
            url: BASEURL + '/user/setImg',
            data: userData,
            dataType: 'JSON'
        }).then(
            // resolve/success callback
            function (response) {
                if (response.status) {
                    $("#luu").attr('hidden', 'true')
                } else {
                    alert("error pic")
                }
            },
            // reject/failure callback
            function () {
                alert('There was some error!');
            }
        )
    })
    $("#xtk").click(function () {
        $.ajax({
            type: "POST",
            url: BASEURL + '/user/deleteAccount'
        }).then(
            // resolve/success callback
            function (response) {
                console.log(response)
                location.href = BASEURL + '/user/logout_s'
            },
            // reject/failure callback
            function () {
                alert('There was some error!');
            }
        )
    })
})