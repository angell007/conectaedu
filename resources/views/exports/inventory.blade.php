<table>
    <thead>
        <tr>
            <th>Estante:</th>
            <th>Dirección:</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$items->name}}</td>
            <td>{{$items->address}}</td>
        </tr>
    </tbody>
</table>


<table class="table table-hover mb-0">
    <thead>
        <tr>
            <th>Creado:</th>
            <th>Actualizado:</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="text"><label class="text">{{$items->created_at}}</label></td>
            <td class="text"><label class="text">{{$items->updated_at}}</label></td>
        </tr>
    </tbody>
</table>



<table class="table table-hover mb-0">
    <thead>
        <tr>
            <th>Elemento</th>
            <th>Referencia</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items->elements as $item)
        @if ( $item->quantities->quantity == 0 )
        <tr>
            <td class="text"><label class="text">{{$item->name}}</label></td>
            <td class="text"><label class="text">{{$item->reference}}</label></td>
            <td class="text"><label class="badge badge-light-primary">{{$item->quantities->quantity}}</label>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>