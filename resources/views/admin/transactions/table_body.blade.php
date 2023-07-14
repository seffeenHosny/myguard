<tr>
    <td>{{$index + 1}}</td>
    <td>{{$item->user->name}}</td>
    <td>
        @if($item->type == 'company')
            {{ __('admin.company') }}
        @else
            {{ __('admin.guard') }}
        @endif
    </td>
    <td>{{$item->amount}}</td>
    <td>{{$item->tax}}</td>
    <td>{{$item->total_price}}</td>
    <td>
        @if($item->status == 'approved')
            <span class="btn btn-success">
                {{__('admin.succeeded')}}
            </span>
        @else
            <span class="btn btn-danger">
                {{__('admin.failed')}}
            </span>
        @endif
    </td>
</tr>
