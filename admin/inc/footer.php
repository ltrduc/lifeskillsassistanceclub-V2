<!-- Required Js -->
<script src="./assets/js/vendor-all.min.js"></script>
<script src="./assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="./assets/js/pcoded.min.js"></script>
<script src="./assets/js/datatables.min.js"></script>
<script src="./assets/js/data-basic-custom.js"></script>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myList li").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
</body>

</html>