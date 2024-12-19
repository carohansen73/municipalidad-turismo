<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <th>Publicado</th>
        <th>Publicado</th>
        <th>Título</th>
        <th>Publicado</th>
        <th>Creado por</th>
        <th>Acción</th>
    </thead>
    <tbody>
    @foreach($events as $event)
        <tr>
            <td>{{ date('Y-m-d H:i', strtotime($event->publication_date)) }}</td>
            <td>{!! Date::parse($event->publication_date)->setTimeZone('America/Argentina/Buenos_Aires')->format('d/m/Y') !!} · {!! Date::parse($event->publication_date)->setTimeZone('America/Argentina/Buenos_Aires')->format('H:i') !!}</td>
            <td>{!! $event->title !!}</td>
            @if($event->publish == 1)
                <td class="text-success">Si</td>
            @else
                <td class="text-danger">No</td>
            @endif
            <td>{!! $event->user->name !!} {!! $event->user->lastname !!}</td>
            <td>
                <div class='btn-group'>
                    @if (Request::is('acontecimientos/papelera*'))
                    {!! Form::open(['route' => ['events.trash.delete', $event->id], 'method' => 'delete']) !!}
                        <a href="{!! route('events.trash.restore', [$event->id]) !!}" class='btn btn-ghost-success btn-sm'><i class="fa fa-recycle"></i></a>

                        {!! Form::button('<i class="fa fa-times"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger btn-sm', 'onclick' => "return confirm('¿Está seguro/a que desea eliminar el post de forma permanente?')"]) !!}
                    {!! Form::close() !!}
                    @else
                    {!! Form::open(['route' => ['acontecimientos.destroy', $event->id], 'method' => 'delete']) !!}
                        <a href="{!! route('acontecimientos.edit', [$event->id]) !!}" class='btn btn-ghost-info btn-sm'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger btn-sm', 'onclick' => "return confirm('¿Está seguro/a que desea eliminar el post?')"]) !!}
                    {!! Form::close() !!}
                    @endif
                </div>
                
            </td>
        </tr>
    @endforeach
    </tbody>
</table>