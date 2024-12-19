<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <th>Título</th>
        <th>Publicado</th>
        <th>Acción</th>
    </thead>
    <tbody>
    @foreach($banners as $banner)
        <tr>
            <td>{!! $banner->title !!}</td>
            
            @if($banner->publish == 1)
                <td class="text-success">Si</td>
            @else
                <td class="text-danger">No</td>
            @endif
            
            <td>
                {!! Form::open(['route' => ['banners.destroy', $banner->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('banners.edit', [$banner->id]) !!}" class='btn btn-ghost-info  btn-sm'><i class="fa fa-edit"></i></a>
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger btn-sm', 'onclick' => "return confirm('Estás seguro/a que desea eliminar el banner?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>