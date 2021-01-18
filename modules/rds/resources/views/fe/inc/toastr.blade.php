@if (isset($_SESSION['end.message']))
	<script>
	requirejs(['jquery', 'jquery.toastr'], function ($, toastr) {
		setTimeout(function () {
			toastr.options = {
				closeButton : true,
				progressBar : true,
				showMethod : 'slideDown',
				timeOut : 4000
			};
			@if ($_SESSION['end.level'] == 'success' )
			toastr.success('{!! $_SESSION['end.message'] !!}');
			@endif
			@if ($_SESSION['end.level'] == 'danger' )
			toastr.error('{!! $_SESSION['end.message'] !!}');
			@endif
		}, 1300);
	})
	</script>
@endif