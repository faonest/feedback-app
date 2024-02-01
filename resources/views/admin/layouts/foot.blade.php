<script src="{{ asset('assets/js/all.js') }}"></script>

<script src="{{ asset('assets/assets/vendors/toastr/js/toastr.min.js') }}"></script>
<script src="{{ asset('assets/assets/js/init/toastr.js') }}"></script>

<script src="{{ asset('assets/assets/vendors/data-table/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/assets/vendors/data-table/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/assets/vendors/data-table/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/assets/vendors/data-table/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/assets/vendors/data-table/js/responsive.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/assets/js/init/data-table.js') }}"></script>

<script>
    window.addEventListener(
        "load",
        function() {
            var forms = document.getElementsByClassName("needs-validation");
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener(
                    "submit",
                    function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add("was-validated");
                    },
                    false
                );
            });
        },
        false
    );
</script>
