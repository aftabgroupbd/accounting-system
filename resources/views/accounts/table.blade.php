
@forelse ($accounts as $account)
<tr>
    <td>{{$account->name}}</td>
    <td>{{$account->balance}}</td>
</tr>
@empty
<tr>
    <td colspan="43">
        <div class="alert alert-warning m-0 text-center" role="alert">
            Data Not found!
        </div>
    </td>
</tr>
@endforelse
<tr>
    <td colspan="43">
        <div>
            {{ $accounts->links('pagination::bootstrap-5') }}
        </div>
    </td>
</tr>