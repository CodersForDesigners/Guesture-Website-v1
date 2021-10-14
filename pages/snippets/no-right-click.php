<script type="text/javascript">
	document.addEventListener( "contextmenu", function ( event ) {
		event.preventDefault();
		event.stopImmediatePropagation();
		event.stopPropagation();
		return false;
	}, { capture: true } );
</script>