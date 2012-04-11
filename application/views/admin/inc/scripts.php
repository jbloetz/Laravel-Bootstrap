<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?=asset('js/jquery.js')?>"></script>
<script src="<?=asset('js/admin/jquery-ui-custom.js')?>"></script>
<script src="<?=asset('js/admin/bootstrap.js')?>"></script>
<script src="<?=asset('js/admin/wysiwyg.js')?>"></script>
<script src="<?=asset('js/admin/wysiwyg-bs.js')?>"></script>
<script type="text/javascript">
	if($('#content')){
		$('#content').wysihtml5();
	}
	if($('.editable_text')){
		$('.editable_text').each(function(index,elem) {
			$(elem).wysihtml5();
		});
	}
</script>