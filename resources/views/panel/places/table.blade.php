<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <th>Título</th>
        <th>Título</th>
        <th>Publicado</th>
        <th>Acción</th>
    </thead>
    <tbody>
    @foreach($places as $place)
        <tr>
            <td>{{ $place->title }}</td>
            <td>{!! $place->title !!}</td>
            @if($place->publish == 1)
                <td class="text-success">Si</td>
            @else
                <td class="text-danger">No</td>
            @endif
            <td>
                <div class='btn-group'>
                    {!! Form::open(['route' => ['lugar.destroy', $place->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('lugar.edit', [$place->id]) }}" class='btn btn-ghost-info btn-sm'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger btn-sm', 'onclick' => "return confirm('¿Está seguro/a que desea eliminar el lugar?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
                
            </td>
        </tr>
    @endforeach
    </tbody>
</table>