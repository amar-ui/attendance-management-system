
@if(session()->has('save'))
    @section('script')
    <script>

        swal({
            title: "Good job!",
            text: "{{ session('save') }}",
            buttonsStyling: false,
            confirmButtonClass: "btn btn-success",
            type: "success"
        });

    </script>
    @endsection
@endif
@if(session()->has('delete'))
@section('script')
    <script>

        swal({
            title: "Error.!",
            text: "{{ session('delete') }}",
            buttonsStyling: false,
            confirmButtonClass: "btn btn-danger",
            type: "error"
        });

    </script>
    @endsection
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
