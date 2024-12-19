<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <th>Nombre</th>
        <th>Slug</th>
        <th>Publicado</th>
        <th>Acción</th>
    </thead>
    <tbody>
    @foreach($postCategories as $postCategory)
        <tr>
            <td>{!! $postCategory->name !!}</td>
            <td>{!! $postCategory->slug !!}</td>
            @if ($postCategory->publish)
                <td class="text-success">Si</td>
            @else
                <td class="text-danger">No</td>
            @endif
            <td>
                {!! Form::open(['route' => ['posts.categorias.destroy', $postCategory->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{--<a href="{!! route('posts.categorias.show', [$postCategory->id]) !!}" class='btn btn-ghost-success btn-sm'><i class="fa fa-eye"></i></a>--}}
                    <a href="{!! route('posts.categorias.edit', [$postCategory->id]) !!}" class='btn btn-ghost-info btn-sm' title='Editar categoría'><i class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger btn-sm', 'onclick' => "return confirm('¿Está seguro/a que desea eliminar la categoría?')", 'title' => 'Eliminar categoría']) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>