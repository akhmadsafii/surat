<script src="{{ asset('asset/js/jquery.MultiFile.min.js') }}" type="text/javascript"></script>
<script>
    $(function() {
        $('.multi').MultiFile({
            onFileChange: function() {
                console.log(this, arguments);
            }
        });
    })
</script>
