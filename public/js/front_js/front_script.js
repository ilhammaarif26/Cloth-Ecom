// filter products
$(document).ready(function(){

    // csrf token for ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#sort").on('change', function(){
        var sort = $(this).val();
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattren = get_filter('pattren');
        var fit = get_filter('fit');
        var occassion = get_filter('occassion');
        var url = $("#url").val();
            $.ajax({
                url:url,
                method:"get",
                data:{fabric:fabric, sleeve:sleeve, pattren:pattren, fit:fit, occassion:occassion, sort:sort, url:url},
                success:function(data){
                    $('.filter_products').html(data);
                }
            });
    });

    $(".fabric").on('click', function(){
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattren = get_filter('pattren');
        var fit = get_filter('fit');
        var occassion = get_filter('occassion');
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url:url,
            method: "get",
            data:{fabric:fabric, sleeve:sleeve, pattren:pattren, fit:fit, occassion:occassion, sort:sort, url:url},
            success:function(data){
                $(".filter_products").html(data);
            }
        });

    });

    $(".sleeve").on('click', function(){
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattren = get_filter('pattren');
        var fit = get_filter('fit');
        var occassion = get_filter('occassion');
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url:url,
            method: "get",
            data: {fabric:fabric, sleeve:sleeve, pattren:pattren, fit:fit, occassion:occassion, sort:sort, url:url},
            success:function(data){
                $(".filter_products").html(data);
            }
        });

    });

    $(".pattren").on('click', function(){
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattren = get_filter('pattren');
        var fit = get_filter('fit');
        var occassion = get_filter('occassion');
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url:url,
            method: "get",
            data: {fabric:fabric, sleeve:sleeve, pattren:pattren, fit:fit, occassion:occassion, sort:sort, url:url},
            success:function(data){
                $(".filter_products").html(data);
            }
        });

    });

    $(".fit").on('click', function(){
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattren = get_filter('pattren');
        var fit = get_filter('fit');
        var occassion = get_filter('occassion');
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url:url,
            method: "get",
            data: {fabric:fabric, sleeve:sleeve, pattren:pattren, fit:fit, occassion:occassion, sort:sort, url:url},
            success:function(data){
                $(".filter_products").html(data);
            }
        });

    });

    $(".occassion").on('click', function(){
        var fabric = get_filter('fabric');
        var sleeve = get_filter('sleeve');
        var pattren = get_filter('pattren');
        var fit = get_filter('fit');
        var occassion = get_filter('occassion');
        var sort = $("#sort option:selected").val();
        var url = $("#url").val();
        $.ajax({
            url:url,
            method: "get",
            data: {fabric:fabric, sleeve:sleeve, pattren:pattren, fit:fit, occassion:occassion, sort:sort, url:url},
            success:function(data){
                $(".filter_products").html(data);
            }
        })

    });

    function get_filter(class_name){
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });

        return filter;
    }

    // change price when size is changed
    $("#getPrice").change(function(){
        var size = $(this).val();
        if(size == ""){
            $(".error-size").html("<div class='alert alert-danger' role='alert'>please select size!</div>");
            return false;
        }
        var product_id = $(this).attr("product-id");
        $.ajax({
            url: '/get-attribute-price',
            type: "post",
            data: {size:size, product_id:product_id},
            success:function(resp){
                if(resp['discounted_price'] > 0){
                    $(".getAttrPrice").html("<del>Rp. " + resp['product_price'] + "</del> Rp."  + resp['discounted_price']);
                } else {
                    $(".getAttrPrice").html("Rp. " + resp['product_price']);
                }
            }, error:function(){
                alert("error");
            }
        });
    })
});
