
 
 $(document).ready(function(){         
 
       //=================================================
       $('.increnemt-btn').click(function(e){
           e.preventDefault();
           var inc_value=$(this).closest('.product-data').find('.qty-input').val();
           var value=parseInt(inc_value,5);
           value = isNaN(value) ? 0: value;
               if(value<5){
                   value++;
                   $(this).closest('.product-data').find('.qty-input').val(value);
                }
               
            
    });

    $('.decrease-btn').click(function(e){
            e.preventDefault();
            var dec_value=$(this).closest('.product-data').find('.qty-input').val();
            var value=parseInt(dec_value,6);
            value = isNaN(value) ? 0: value;
            if(value>1){
                value--;
                $(this).closest('.product-data').find('.qty-input').val(value);
                
            }
        
    });

    $('.delete-cart-item').click(function(e){
        e.preventDefault();
        var product_id =$(this).closest('.product-data').find('.product_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        
        $.ajax({
            method:"Post",
            url:"/delete-cart-item",
            data:{
               'product_id': product_id,
            },
            success:function (response){
                window.location.reload();
                swal("",response.status,"success");
            }
        });
   
    });     

    $('.changQuantity').click(function(e){
        e.preventDefault();
        var prod_id =$(this).closest('.product-data').find('.product_id').val();
        var prod_qty =$(this).closest('.product-data').find('.qty-input').val();
        data={
            'product_id': prod_id,
            'product_qty': prod_qty,
         },
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
            method:"Post",
            url:"update-cart",
            data:data,
            success:function (response){
                window.location.reload();
                
            }
        });
   
    });   
    
    $("html").niceScroll({
        cursorcolor: "#8d4444",
        cursorborder: "1px solid #8d4444",
    });

    $('#datatable2').DataTable({
        // pagingType: "full_numbers",
        searching: true,
        lengthChange: true,
        pageLength: "10",
        processing: true,
        paging: true,
       responsive: true,
       language: {
        "info": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
        "search": "ابحث:",
        "infoEmpty": "يعرض 0 إلى 0 من أصل 0 مُدخل",
        "emptyTable":"لا يوجد بيانات في الجدول",
        "lengthMenu":     "إظهار _MENU_ مدخلات",
        "zeroRecords":    "لم يتم العثور على سجلات مطابقة",
        "infoFiltered":   "(تمت تصفية من _MAX_ إجمالي المدخلات)",
        "paginate": {
            "first": "الأول",
            "previous": "السابق",
            "next": "التالي",
            "last": "الأخير"
        },
    },

  

});

//Add product to card
var product=$(this).find('.product_status').val();
if(product==1){
    $("#btn").on('click', function() {
        $('#btn').attr({'data-toggle':'modal','data-target':'#exampleModal3'});
        $('#btn1').on('click', function(e) {
                         e.preventDefault();
                         var product_id=$(this).closest('.product-data').find('.product_id').val();
                         var product_qty=$(this).closest('.product-data').find('.qty-input').val();
                         var product_price=$(this).closest('.product-data').find('.product_price').text();
                         var price_point=$(this).closest('.product-data').find('.price_point').text();
                         var gift_point=$(this).closest('.product-data').find('.gift_point').text();
                         var user_name=$(this).closest('.product-data').find('.name').val();
                         var number=$(this).closest('.product-data').find('.number').val();
                      
                         $.ajaxSetup({
                             headers: {
                                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                             }
                         });
                         $.ajax({
                             method:"Post",
                             url:"/add-to-cart",
                             data:{
                                 'product_id': product_id,
                                 'product_qty': product_qty,
                                 'product_price': product_price,
                                 'price_point':price_point,
                                 'gift_point':gift_point,
                                 'user_name': user_name,
                                 'number': number,
                        
                          },
                                success:function (response){
                                    swal(response.status);
                                }
                            });
                        });
                    });
                }
                else{
                    $('#btn').on('click', function(e) {
                        $('#btn').addClass('addToCartBtn');
                        e.preventDefault();
                        var product_id=$(this).closest('.product-data').find('.product_id').val();
                        var product_qty=$(this).closest('.product-data').find('.qty-input').val();
                        var product_price=$(this).closest('.product-data').find('.product_price').text();
                        var price_point=$(this).closest('.product-data').find('.price_point').text();
                        var gift_point=$(this).closest('.product-data').find('.gift_point').text();
                      
                        $.ajaxSetup({
                             headers: {
                                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                             }
                         });
                         $.ajax({
                             method:"Post",
                             url:"/add-to-cart",
                             data:{
                                 'product_id': product_id,
                                 'product_qty': product_qty,
                                 'product_price': product_price,
                                 'price_point':price_point,
                                 'gift_point':gift_point,
                             },
                             
                             success:function (response){
                                 swal(response.status);
                             }
                         });
                     });
                 } 
     
                // Add Bill Mobile
                 $('.box').hide(); 
                 $('.form-select').change(function(){
                     if($('.form-select').val()) {
                         $('.box').show(); 
                         
                     } else {
                         $('.box').hide(); 
                     } 
                 });
                   
                 
                //  $('#btn3').on('click', function(e){
                //     $('.notic-button').show();
                //      $('#btn3').prop('disabled', true);
                //      setTimeout(function(){
                //         $('.notic-button').hide();
                //     },6000);
                //      setTimeout(function(){
                //         $('#btn3').prop('disabled', false);  
                //     },7000);

                    // setTimeout(function(){
                    //  e.preventDefault();
                    //  $("#company_name").change(function(){
                    //  var values=$("#company_name option:selected");
                    // });
                //   $('#company_name').on('change',function () {
                //              var Company=$(this).find(':selected').val();  
                //              var mobile_number=$(this).closest('.product-data').find('.mobile_number').val();
                //              var veryfiy_number=$(this).closest('.product-data').find('.veryfiy_number').val();
                //              var price=$(this).closest('.product-data').find('#price').val();
                            //  alert(Company);
                            //  alert(mobile_number);
                            //  alert(price);
                            //  $.ajaxSetup({
                            //      headers: {
                            //          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            //      }
                            //  });
                            //  $.ajax({
                            //      method:"Post",
                            //      url:'order-Mobile',
                            //      data:{
                            //          'Company': Company,
                            //          'mobile_number': mobile_number,
                            //          'veryfiy_number': veryfiy_number,
                            //          'price': price,
                            //          // 'product_price': product_price,
                            //      },
                                 
                                //  success:function (response){
                                //      swal(response.success);
                                //      $('.swal-button--confirm').on('click',function(){
                                //         $('#company_name').val('');
                                //         $('#mobile_number').val('');
                                //         $('#veryfiy_number').val('');
                                //         $('#price').val('');
                                //     });
                                //      // $('#btn3').prop('disabled', true);
                                     
                                  
                                //     },
                                    // error:function (data){
                                    //     if(data.status===422)
                                    //     var errors=$.parseJSON(data.responseText);
                                    //     //  swal(response.error);
                                    //          $.each(errors,function(key,value){
                                    //             $('#response').addClass("alert alert-danger");
                                    //             $("#" + key +"_error").text(value[0]);
                                    //             if($.isPlainObject(value)){
                                    //                 $.each(value,function(key,value){
                                    //                     console.log(key+""+value);
                                    //                     $('#response').show().append(value+"<br/>");
                                    //             })
                                    //         }
                                    //             else{
                                    //                 $('#response').show().append(value+"<br/>");
                                    //             }
                                    //          //    console.log(error);
                                    //          });
                            //  },
                            // });
                        // }
                        // }).change();
                    // });
                    
                // });
                // });
          
        // ======================================================================================
          
        // });

        
     $('#ApplyCouponpoint').on('click','.AddCouppoint',function(){
        var codepoint =$("#codepoint").val();
        // alert(codepoint);
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        $.ajax({
            type:'post',
            data:{
                'codepoint':codepoint,
            },
            url:'/apply-coupon-point',
            success:function(resp){
                if(resp.messages!=""){
                    swal(resp.messages);
                }
                if(resp.Couponpointnumber > 0){
                    alert(resp.Couponpointnumber)
                   $('.couponAmountpoint').append('<span class="coupontotal">'+ resp.Couponpointnumber + '</span>');
                   $('.total').empty();
                   $('.total').append('<span>'+ resp.gruad_total + '</span>');
                   $('.swal-button--confirm').on('click',function(){
                    $('.AddCouppoint').prop('disabled', true);
                   
                  
                    });
             
                 }
             
            },
            error:function(){
                alert("Error");
            }
        });
       
    });

        
//     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	
// 	<script>
// 	$(document).ready(function(){
// 		$('.addToCartBtn').click(function(e){
// 			e.preventDefault();
// 			var product_id=$(this).closest('.product_data').find('.product_id').val();
// 			var product_price=$(this).closest('.product_data').find('.price_input').val();
// 			$.ajaxSetup({
// 			headers: {
// 				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
// 			}
// 			});
// 		$.ajax({
// 			headers: {
//                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                         },
// 			method: "POST",
// 			url: "/addCart",
// 			data: { 
// 				'product_id': product_id,
// 				'product_price':product_price,
// 			},
// 			success: function(response){
// 				alert(response.status);
// 			},
// 		});
// 	});
// });
// </script>
});

