<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        "language": {
            "url": "{!! url('vendor/datatables/datatables_simple.json') !!}",
        },
        "order": [[0, 'desc' ]],
        'columnDefs': [
        { 'orderData':[0], 'targets': [1] },
        {
            'targets': [0],
            'visible': false,
            'searchable': false
        },
        ]
    });
} );
</script>