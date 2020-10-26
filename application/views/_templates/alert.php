<?php if(isset($_SESSION['alert']) && $_SESSION['alert'] != ''): ?>
	<div class="alert pr-lg-4 pr-4 pl-lg-4 pl-4 pt-lg-3 pt-3 pb-lg-3 pb-3">
		<div class="alert-icon text-center mr-lg-3 mr-3">
			<span class="lnr lnr-flag vm"></span>
		</div>
		<div class="alert-text">
			<span><?php echo $_SESSION['alert']; ?></span>
		</div>
	</div>
	<script type="text/javascript">
		function showAlert() {
			$('.alert').animate({
				'opacity': 1,
				'right': '30px'
			}, 350);
			setTimeout(hideAlert, 4500);
		}
		function hideAlert() {
			$('.alert').animate({
				'opacity': 0,
				'right': '-500px'
			}, 350);
		}
		showAlert();
	</script>
	<?php $_SESSION['alert'] = ''; ?>
<?php endif; ?>
