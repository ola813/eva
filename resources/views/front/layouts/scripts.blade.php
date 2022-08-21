<script src="https://www.gstatic.com/firebasejs/4.6.2/firebase.js"></script>
<!--===============================================================================================-->	
<script src="{{asset('assets/front/plugin/jquery/jquery-3.2.1.min.js')}}"></script>
<!---dtatatable-->
<script type="text/javascript" src="{{asset('assets/front/js/datatables.min.js')}}"></script>    
<!--===============================================================================================-->
	<script src="{{asset('assets/front/plugin/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('assets/front/plugin/bootstrap/js/popper.js')}}"></script>
	<!-- <script src="{{asset('assets/front/js/plugin/bootstrap/js/popper.js.map')}}"></script> -->
	<script src="{{asset('assets/front/plugin/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('assets/front/plugin/select2/select2.min.js')}}"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="{{asset('assets/front/plugin/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('assets/front/plugin/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('assets/front/plugin/slick/slick.min.js')}}"></script>
	<script src="{{asset('assets/front/js/slick-custom.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('assets/front/plugin/parallax100/parallax100.js')}}"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="{{asset('assets/front/plugin/MagnificPopup/jquery.magnific-popup.min.js')}}"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
<!--===============================================================================================-->
	<script src="{{asset('assets/front/plugin/isotope/isotope.pkgd.min.js')}}"></script>
<!--===============================================================================================-->
<script>
	$('.js-addwish-b2').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");
				
				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/
		
		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});
		</script>
<!--===============================================================================================-->
<script src="{{asset('assets/front/plugin/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script>
	$('.js-pscroll').each(function(){
		$(this).css('position','relative');
		$(this).css('overflow','hidden');
		var ps = new PerfectScrollbar(this, {
			wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});
			
			$(window).on('resize', function(){
				ps.update();
			})
		});
		</script>
<!--===============================================================================================-->
<script src="{{asset('assets/front/js/main.js')}}"></script>
<script src="{{asset('assets/front/js/custom.js')}}"></script>
<script src="{{asset('assets/front/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('assets/front/js/slider.js')}}"></script>
  
<script src="{{asset('assets/js/firebase.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="{{asset('assets/front/plugin/sweetalert/sweetalert.min.js')}}"></script>
@if(session('status'))
<script>
  swal("{{session('status')}}")
  </script>
@endif

