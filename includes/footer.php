<br>
<div id="footer" class="p-3 bg-primary bg-white">
    <p class="text-center">Copyright &copy; - Community Library Registration System <?php echo date('Y'); ?></p>
</div>

</div>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
</script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(function() {
    $("#dob").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "-110: +0",
        dateFormat: "yy-mm-dd"
    });
});
</script>

</body>

</html>