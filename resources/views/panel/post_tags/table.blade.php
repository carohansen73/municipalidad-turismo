<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <th>Nombre</th>
        <th>Slug</th>
        <th>Publicado</th>
        <th>Acción</th>
    </thead>
    <tbody>
    @foreach($postTags as $postTag)
        <tr>
            <td>{!! $postTag->name !!}</td>
            <td>{!! $postTag->slug !!}</td>
            @if ($postTag->publish)
                <td class="text-success">Si</td>
            @else
                <td class="text-danger">No</td>
            @endif
            <td>
                {!! Form::open(['route' => ['posts.tags.destroy', $postTag->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('posts.tags.show', [$postTag->id]) !!}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>--}}
                    <a href="{!! route('posts.tags.edit', [$postTag->id]) !!}" class='btn btn-ghost-info btn-sm btn-sm' title="Editar tag"><i class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger btn-sm', 'onclick' => "return confirm('¿Está seguro/a que desea eliminar el tag?')", 'title' => 'Eliminar tag']) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>