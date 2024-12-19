<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <th>Título de sección noticias</th>
        <th>Título de sección eventos</th>
        <th>Título de sección equipo</th>
        <th>Acción</th>
    </thead>
    <tbody>
        @foreach($siteConfigurations as $siteConfiguration)
        <tr>
            <td>{!! $siteConfiguration->title_news !!}</td>
            <td>{!! $siteConfiguration->title_events !!}</td>
            <td>{!! $siteConfiguration->title_team !!}</td>
            <td>
                <a href="{!! route('siteConfigurations.edit', [$siteConfiguration->id]) !!}" class='btn btn-ghost-info btn-sm' title='Editar configuración'><i class="fa fa-edit"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>