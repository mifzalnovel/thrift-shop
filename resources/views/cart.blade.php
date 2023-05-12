@extends('layout.main')

@section('content')
<div id="site">
  <div class="container d-flex justify-content-center bg-primary">
    <div class="title-box d-flex justify-content-center">
        <h2>Cart</h2>

        <form action="">
            <div class="row d-flex">
                <div class="col-4">
                    <div class="row">
                        <p>{{ $cart->user->email }}</p>
                    </div>
                    @foreach($cart as $df)

                        <div class="row">
                            {{-- <p>{{ $df->user }}</p> --}}
                        </div>

                    @endforeach
                </div>
            </div>
        </form>
    </div>
  </div>
</div>

<script type="text/javascript">
        $(".update-cart").click(function (e) {
           e.preventDefault();
           var ele = $(this);
            $.ajax({
               url: '{{ url('update-cart') }}',
               method: "patch",
               data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
               success: function (response) {
                   window.location.reload();
               }
            });
        });
        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>

@endsection