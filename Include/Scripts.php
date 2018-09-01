<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            ckfinder: {
                uploadUrl: '/Blog/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
            }
        }  )
        .catch( error => {
            console.error( error );
        } );
</script>