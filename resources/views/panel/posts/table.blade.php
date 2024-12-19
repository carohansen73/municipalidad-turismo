<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
<thead>
    <th>Publicado</th>
    <th>Publicado</th>
    <th>Título</th>
    <th>Categoría</th>
    <th>Creado por</th>
    <th>Publicado</th>
    <th>Acción</th>
</thead>
<tbody>
@foreach($posts as $post)
    <tr>
        <td>{{ date('Y-m-d H:i', strtotime($post->publication_date)) }}</td>
        <td>{!! Date::parse($post->publication_date)->setTimeZone('America/Argentina/Buenos_Aires')->format('d/m/Y') !!} · {!! Date::parse($post->publication_date)->setTimeZone('America/Argentina/Buenos_Aires')->format('H:i') !!}</td>
        <td>{!! $post->title !!}</td>
        <td>{!! $post->category->name !!}</td>
        <td>{!! $post->user->name !!} {!! $post->user->lastname !!}</td>
        
        @if($post->publish == 1)
            <td class="text-success">Si</td>
        @else
            <td class="text-danger">No</td>
        @endif
        
        <td>
            
            <div class='btn-group'>
                @if (Request::is('posts/papelera*'))
                {!! Form::open(['route' => ['posts.trash.delete', $post->id], 'method' => 'delete']) !!}
                    <a href="{!! route('posts.trash.restore', [$post->id]) !!}" class='btn btn-ghost-success btn-sm'><i class="fa fa-recycle"></i></a>

                    {!! Form::button('<i class="fa fa-times"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger btn-sm', 'onclick' => "return confirm('¿Está seguro/a que desea eliminar el post de forma permanente?')"]) !!}
                {!! Form::close() !!}
                @else
                {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
                    <a href="{!! route('posts.edit', [$post->id]) !!}" class='btn btn-ghost-info btn-sm'><i class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger btn-sm', 'onclick' => "return confirm('¿Está seguro/a que desea eliminar el post?')"]) !!}
                {!! Form::close() !!}
                @endif
            </div>
            
        </td>
    </tr>
@endforeach
</tbody>
</table>
