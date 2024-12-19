{{-- Traducción de datetimepicker --}}
<script src="{!! asset('js/vendor/moment/locale/es.js') !!}"></script>

<script type="text/javascript">
    $('#publication_date').datetimepicker({
        locale: 'es',
        format: 'YYYY-MM-DD HH:mm:ss',
        useCurrent: true,
        icons: {
            up: "icon-arrow-up-circle icons font-2xl",
            down: "icon-arrow-down-circle icons font-2xl"
        },
        sideBySide: true
    })
</script>