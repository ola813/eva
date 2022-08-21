//

(function ($) {
    "use strict";
    $('.my-select').select2();
    $('.selectAll').on('click',function(){
        $('.my-select > option').prop('selected',true);
        $('.my-select').trigger('change');
    });
    $('.deselectAll').on('click',function(){
        $('.my-select > option').prop('selected',false);
        $('.my-select').trigger('change');
    });
       //Show/Hide Coupon Field for Manual/Automatic
       $('#ManualCoupon').click(function(){
        $('#couponField').show();
    });
    $('#AutomaticCoupon').click(function(){
        $('#couponField').hide();
    });
    $('#users').select2();
    $('#products').select2();

    $(document).on('click','.confirmDelete',function(){
        var record =$(this).attr('record');
        var recordid =$(this).attr('recordid');
        Swal.fire({
            title:'هل أنت متاكد من عملية الحذف ؟',
            text:"",
            icon:'error',
            showCancelButton:true,
            confirmButtonColor:'#3085d6',
            cancelButtonColor:'#d33',
            confirmButtonText:'! حذف ',
            cancelButtonText:'إلغاء',
        }).then((result)=>{
            if(result.value){
                window.location.href='/Coupons/delete-'+record+'/'+recordid;
            }
        });
    });
    $(document).on('click','.confirmDeletepoint',function(){
        var record =$(this).attr('record');
        var recordid =$(this).attr('recordid');
        Swal.fire({
            title:'هل أنت متاكد من عملية الحذف ؟',
            text:"",
            icon:'error',
            showCancelButton:true,
            confirmButtonColor:'#3085d6',
            cancelButtonColor:'#d33',
            confirmButtonText:'! حذف ',
            cancelButtonText:'إلغاء',
        }).then((result)=>{
            if(result.value){
                window.location.href='/CouponPoints/delete-'+record+'/'+recordid;
            }
        });
    });
    $(document).on('click','.confiradminmDelete',function(){
        var record =$(this).attr('record');
        var recordid =$(this).attr('recordid');
        Swal.fire({
            title:'هل أنت متاكد من عملية الحذف ؟',
            text:"",
            icon:'error',
            showCancelButton:true,
            confirmButtonColor:'#3085d6',
            cancelButtonColor:'#d33',
            confirmButtonText:'! حذف ',
            cancelButtonText:'إلغاء',
        }).then((result)=>{
            if(result.value){
                window.location.href='/delete-'+record+'/'+recordid;
            }
        });
    });
    $(document).on('click','.confirusermDelete',function(){
        var record =$(this).attr('record');
        var recordid =$(this).attr('recordid');
        Swal.fire({
            title:'هل أنت متاكد من عملية الحذف ؟',
            text:"",
            icon:'error',
            showCancelButton:true,
            confirmButtonColor:'#3085d6',
            cancelButtonColor:'#d33',
            confirmButtonText:'! حذف ',
            cancelButtonText:'إلغاء',
        }).then((result)=>{
            if(result.value){
                window.location.href='/delete-'+record+'/'+recordid;
            }
        });
    });
    $(document).on('click','.confirCategorymDelete',function(){
        var record =$(this).attr('record');
        var recordid =$(this).attr('recordid');
        Swal.fire({
            title:'هل أنت متاكد من عملية الحذف ؟',
            text:"",
            icon:'error',
            showCancelButton:true,
            confirmButtonColor:'#3085d6',
            cancelButtonColor:'#d33',
            confirmButtonText:'! حذف ',
            cancelButtonText:'إلغاء',
        }).then((result)=>{
            if(result.value){
                window.location.href='Categories/delete-'+record+'/'+recordid;
            }
        });
    });
    $(document).on('click','.confirmDeletecodegame',function(){
        var record =$(this).attr('record');
        var recordid =$(this).attr('recordid');
        Swal.fire({
            title:'هل أنت متاكد من عملية الحذف ؟',
            text:"",
            icon:'error',
            showCancelButton:true,
            confirmButtonColor:'#3085d6',
            cancelButtonColor:'#d33',
            confirmButtonText:'! حذف ',
            cancelButtonText:'إلغاء',
        }).then((result)=>{
            if(result.value){
                window.location.href='Code-game/delete-'+record+'/'+recordid;
            }
        });
    });

        $('#datatable1').DataTable({
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
        
          // "pagingType": "simple_numbers"
        
      });
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        
        $('.show-order').on('click',function(){
            // alert('testing code');
        $.ajax({
            type:"Post",
            url:"read",
            data:'html',
            success:function (data){
                // console.log(data);
                $('.order-notifcayion').html(data);
            },
        })
    });


    //==============================================multi tabe 

        /**
 * Created by edesimone on 04/06/16.
 */
window.onload=function() {

    // get tab container
    var container = document.getElementById("tabContainer");
    var tabcon = document.getElementById("tabscontent");
    // set current tab
    var navitem = document.getElementById("tabHeader_1");

    //store which tab we are on
    var ident = navitem.id.split("_")[1];
    //alert(ident);
    navitem.parentNode.setAttribute("data-current",ident);
    //set current tab with class of activetabheader
    navitem.setAttribute("class","tabActiveHeader");

    //hide two tab contents we don't need

    var pages = tabcon.getElementsByClassName("tabpage");
    for (var i = 0; i < pages.length; i++) {
        var comp=i+1;
        if(ident!=comp) {
            pages.item(i).style.display = "none";
        }
    };

    //this adds click event to tabs
    var tabs = container.getElementsByTagName("li");
    for (var i = 0; i < tabs.length; i++) {
        tabs[i].onclick=displayPage;
    }
}

// on click of one of tabs
function displayPage() {
    var current = this.parentNode.getAttribute("data-current");
    //remove class of activetabheader and hide old contents
    document.getElementById("tabHeader_" + current).removeAttribute("class");
    document.getElementById("tabpage_" + current).style.display="none";

    var ident = this.id.split("_")[1];

    //add class of activetabheader to new active tab and show contents
    this.setAttribute("class","tabActiveHeader");
    document.getElementById("tabpage_" + ident).style.display="block";
    this.parentNode.setAttribute("data-current",ident);
}

// coupon status point and Coupon 
$(document).on("click",".updateCouponStatus",function(){
    var status=$(this).children("i").attr("status");
    var coupon_id=$(this).attr("coupon_id");
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
      type:'post',
      url:'update-coupon-status',
      data:{
        status:status,
        coupon_id:coupon_id,
        
      },
      success:function(resp){
        if(resp['status'] == 0){
          $("#coupon-"+coupon_id).html("<i class='fa fa-toggle-off' aria-hidden='true' status='Inactive'></i>");
        }
        else if(resp['status']== 1){
          $("#coupon-"+coupon_id).html("<i class='fa fa-toggle-on' aria-hidden='true' status='Active'></i>");
        }
      },
      error:function(){
        alert("Error");
      }
    });
    });

    $(document).on("click",".updateCouponpointStatus",function(){
    var status=$(this).children("i").attr("statuss");
    var couponspoint_id=$(this).attr("couponspoint_id");
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
      type:'post',
      url:'update-coupon-point-status',
      data:{
        status:status,
        couponspoint_id:couponspoint_id,
        
      },
      success:function(resp){
        if(resp['status'] == 0){
          $("#couponpoint-"+couponspoint_id).html("<i class='fa fa-toggle-off' aria-hidden='true' statuss='Inactive'></i>");
        }
        else if(resp['status']== 1){
          $("#couponpoint-"+couponspoint_id).html("<i class='fa fa-toggle-on' aria-hidden='true' statuss='Active'></i>");
        }
      },
      error:function(){
        alert("Error");
      }
    });

  });
  

   })(jQuery);