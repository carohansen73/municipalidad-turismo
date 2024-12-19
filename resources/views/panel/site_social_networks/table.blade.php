<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <th>Red</th>
        <th>URL</th>
        <th>Acción</th>
    </thead>
    <tbody>
    @foreach($siteSocialNetworks as $siteSocialNetwork)
        <tr>
            <td><i class="{!! $siteSocialNetwork->socialNetwork->icon !!}"></i> {!! $siteSocialNetwork->socialNetwork->name !!}</td>
            <td>{!! $siteSocialNetwork->url !!}</td>
            <td>
                {!! Form::open(['route' => ['sitio.redes.destroy', $siteSocialNetwork->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        {{--<a href="{!! route('sitio.redes.show', [$siteSocialNetwork->id]) !!}" class='btn btn-ghost-success btn-sm'><i class="fa fa-eye"></i></a>--}}
                        <a href="{!! route('sitio.redes.edit', [$siteSocialNetwork->id]) !!}" class='btn btn-ghost-info btn-sm'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger btn-sm', 'onclick' => "return confirm('¿Está seguro/a que desea eliminar la red social?')"]) !!}
                    </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>