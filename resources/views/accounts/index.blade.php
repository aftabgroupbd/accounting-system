@extends('master')
@section('body')
<style>
    table th{
        position: sticky; top: -1px;
        background: #fff;
    }
</style>
    <div class="row">
        <div class="col-md-12">
            <form action="" method="post">
                @csrf
                <div class="card">
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissible show fade">
                            <strong>Success!</strong> {{ Session::get('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-header">
                        <span class="float-left">Account List</span>
                        <a href="{{route('accounts.create')}}" class="btn btn-info btn-sm float-right ml-3">Add New Transaction</a>
                    </div>
                    <div class="card-body">
                        <div class="row search-box border-shadow-1">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="show">Show</label>
                                    <select class="form-control" id="show" name="show">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    <small class="text-danger error_show fs-6"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="account_name">Account Name</label>
                                    <input type="text" placeholder="search by account name" autocomplete="off" class="form-control" id="account_name" name="account_name" />
                                    <small class="text-danger error_account_name fs-6"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row border-shadow-1">
                            <div class="col-md-12 ">
                                <div class="table-responsive" style="height: 350px;overflow-y: scroll;">
                                    <table class="table table-bordered table-hover text-center" id="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
                                            @include('accounts.table')
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
    $("#account_name").keyup(function(event){
        event.preventDefault();
        fetch_data(1);
    });
    $("#show").change(function(event){
        event.preventDefault();
        fetch_data(1);
    });
    const fetch_data = (page) =>
    {
        let url = "{{route('accounts.search')}}";
        let show            = $('#show').val();
        let account_name    = $('#account_name').val();
        url = url + `?page=${page}&show=${show}&account_name=${account_name}`;
        $.ajax({
            method: "GET",
            url: url,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            error: function(xhr, status, error) {
                swal({
                    title: 'Error',
                    text: 'Something wrong!',
                    icon: 'error',
                });
            },
            success: function(data)
            {
                if (data.error == true) {
                    swal({
                        title: 'Success',
                        text: data.message,
                        icon: 'success',
                    });
                }else{
                    $('#tbody').html(data.html);
                }
            }
        });
    }
    $(document).on('click', '.pagination a', function(event){
        event.preventDefault();
        var page    = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });
</script>
@endsection