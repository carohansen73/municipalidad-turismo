<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <th>Nombre</th>
        <th>Icono</th>
        <th>Acción</th>
    </thead>
    <tbody>
    @foreach($socialNetworks as $socialNetwork)
        <tr>
            <td>{!! $socialNetwork->name !!}</td>
            <td><i class="{!! $socialNetwork->icon !!}"></i> {!! $socialNetwork->icon !!}</td>
            <td>
                {!! Form::open(['route' => ['redes.destroy', $socialNetwork->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('redes.edit', [$socialNetwork->id]) !!}" class='btn btn-ghost-info btn-sm'><i class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger btn-sm', 'onclick' => "return confirm('¿Está seguro/a que desea eliminar la red social?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>