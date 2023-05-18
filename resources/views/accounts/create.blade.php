@extends('master')
@section('body')
<link rel="stylesheet" href="{{asset('/')}}assets/css/select2.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10 m-auto">
                            <form action="{{route('accounts.store')}}" method="post" id="transaction_form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="account_name">Account Name <small class="text-danger">*</small></label>
                                            <select class="form-control" id="account_name" name="account_name">
                                                <option value="">Search by account name</option>
                                            </select>
                                            <div class=" error error_account_name text-danger"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="amount">Amount<small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter amount" autocomplete="off">
                                            <div class="error_amount text-danger"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Type<small class="text-danger">*</small></label>
                                            <input type="text" class="form-control" id="type" name="type" placeholder="Enter type" autocomplete="off">
                                            <div class="error_type text-danger"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="date">Date <small class="text-danger">*</small></label>
                                            <input type="date" class="form-control" value="{{date('Y-m-d')}}" id="date" name="date" placeholder="Enter date" autocomplete="off">
                                            <div class="error_date text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" id="submit_btn" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-check-circle"></i> Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('/')}}assets/js/select2.full.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function(){
        $( "#account_name" ).select2({
            ajax: { 
                url: "{{route('search.accounts')}}",
                type: "get",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term // search term
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    });
    $("#transaction_form").on('submit', function(e) {
        e.preventDefault();
        const html = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
  Loading...`;
        $('#submit_btn').html(html);
        $('#submit_btn').prop('disabled', true);
        $("#transaction_form .error").html('');
        $.ajax({
            method: "POST",
            url: $(this).prop('action'),
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data)
            {
                $('#submit_btn').html(`<i class="fa fa-fw fa-lg fa-check-circle"></i> Submit`);
                $("#transaction_form .error").html('');
                if (data.error == true) {
                    if(data.check ==  true)
                    {
                        $.each(data.message, function( key, value ) {
                            $(".error_"+key).html(value);
                        });
                    }else{
                        swal({
                            text: data.message,
                            icon: "error",
                        });
                    }
                }else{
                    swal({
                        text: data.message,
                        icon: "success",
                    });
                    location.reload();
                }
                $('#submit_btn').prop('disabled', false);
            }
        });
    });
</script>
@endsection