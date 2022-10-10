<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.formatNumber-0.1.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/tableexport.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/FileSaver.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/xlsx.core.min.js') }}"></script>
<!-- Custom scripts -->
<script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>
<script src="{{ asset('assets/extra-libs/DataTables/datatables.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#exportBtn').click(function() {
            TableExport(document.getElementById("data"), {
                formats: ["xls", "csv", "txt"],
                filename: "top-students-sheet",
                sheetname: "top-students-sheet",
            });
        })
        $('#nav-rubrique-tab').click(function() {
            $('#defaultContent').removeClass('show active')
            $('#default').removeClass('active text-primary')
            $('#nav-rubrique-tab').addClass('active text-primary')
            $('#nav-rubrique').addClass('show active')
            $('#nav-rubrique-not-tab').removeClass('active text-primary')
            $('#nav-rubrique-not').removeClass('show active')
            $('#nav-journal-tab').removeClass('active text-primary')
            $('#nav-journal').removeClass('active show')
        })
        $('#nav-rubrique-not-tab').click(function() {
            $('#defaultContent').removeClass('show active')
            $('#default').removeClass('active text-primary')
            $('#nav-rubrique-not-tab').addClass('active text-primary')
            $('#nav-rubrique-not').addClass('show active')
            $('#nav-rubrique-tab').removeClass('active text-primary')
            $('#nav-rubrique').removeClass('show active')
            $('#nav-journal-tab').removeClass('active text-primary')
            $('#nav-journal').removeClass('active show')
        })
        $('#nav-journal-tab').click(function() {
            $('#defaultContent').removeClass('show active')
            $('#default').removeClass('active text-primary')
            $('#nav-journal-tab').addClass('active text-primary')
            $('#nav-journal').addClass('show active')
            $('#nav-rubrique-not-tab').removeClass('active text-primary')
            $('#nav-rubrique-not').removeClass('show active')
            $('#nav-rubrique-tab').removeClass('active text-primary')
            $('#nav-rubrique').removeClass('active show')
        })
        $('#default').click(function() {
            $('#nav-rubrique-tab').removeClass('active text-primary')
            $('#nav-rubrique').removeClass('active show')
            $('#nav-journal-tab').removeClass('active text-primary')
            $('#nav-journal').removeClass('active show')
            $('#defaultContent').addClass('show active')
            $('#nav-rubrique-not-tab').removeClass('active text-primary')
            $('#nav-rubrique-not').removeClass('show active')
            $('#default').addClass('active text-primary')
        })
        $('.numberFormat').formatNumber({
            cents: '.',
        });
    });
</script>
</body>

</html>
