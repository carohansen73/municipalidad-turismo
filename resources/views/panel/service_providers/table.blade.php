<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <th>Title</th>
        <th>Title</th>
        {{-- <th>Descripcion</th> --}}
        <th>Ciudad</th>
        <th>Tipo</th>
        <th>Tipo</th>
        <th>Acción</th>
    </thead>
    <tbody>
    @foreach($serviceProviders as $sp)
        <tr>
            <td>{{ $sp->title }}</td>
            <td>{!! $sp->title !!}</td>
            {{-- <td>{!! $sp->description !!}</td> --}}
            <td>{!! $sp->location_city !!}</td>
            <td>{!! $sp->service->name !!}</td>
            <td>{!! $sp->type->type !!}</td>


            <td>
                <div class='btn-group'>
                    {{-- @if (Request::is('acontecimientos/papelera*'))
                    {!! Form::open(['route' => ['service-providers.destroy', $sp->id], 'method' => 'delete']) !!}
                        <a href="{!! route('service-providers.destroy', [$sp->id]) !!}" class='btn btn-ghost-success btn-sm'><i class="fa fa-recycle"></i></a>

                        {!! Form::button('<i class="fa fa-times"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger btn-sm', 'onclick' => "return confirm('¿Está seguro/a que desea eliminar el proveedor de forma permanente?')"]) !!}
                    {!! Form::close() !!}
                    @else --}}
                    {!! Form::open(['route' => ['service-providers.destroy', $sp->id], 'method' => 'delete']) !!}
                        <a href="{!! route('service-providers.edit', [$sp->id]) !!}" class='btn btn-ghost-info btn-sm'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger btn-sm', 'onclick' => "return confirm('¿Está seguro/a que desea eliminar el proveedor de servicios?')"]) !!}
                    {!! Form::close() !!}

                </div>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
