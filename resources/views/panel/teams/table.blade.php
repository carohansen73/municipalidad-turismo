<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <th>Nombre y apellido</th>
        <th>Trabajo / Puesto</th>
        <th>Acción</th>
    </thead>
    <tbody>
    @foreach($teams as $team)
        <tr>
            <td>{!! $team->name !!}</td>
            <td>{!! $team->job !!}</td>
            <td>
                {!! Form::open(['route' => ['equipo.destroy', $team->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('social.network.list', [$team->id]) !!}" class='btn btn-ghost-success btn-sm' title="Listado redes sociales"><i class="fa fa-at"></i></a>
                    <a href="{!! route('equipo.edit', [$team->id]) !!}" class='btn btn-ghost-info btn-sm' title="Editar"><i class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger btn-sm', 'onclick' => "return confirm('¿Está seguro/a que desea eliminar el miembro del equipo?')", 'title' => 'Eliminar']) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
