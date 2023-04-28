@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="">
            <div class="col-md-12">
                <h2>Загрузите маммограму</h2>
                <div class="card">
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="">
                            <input id="image" type="file" name="image">
                        </div>
                        <button type="button" class="upload btn btn-success"> Подтвердите загрузку изображения</button>
                    </form>
                    <div class="upload-img d-none">
                        <img style="height: 500px; width: 500px" id="view-img" class="img-thumbnail" src="">
                    </div>
                </div>
                <div class="card answer-ai">
                </div>
                <div class="spinner-border loading d-none" role="status"></div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.upload').click(function () {
                var data = new FormData();
                data.append('file', $("#image")[0].files[0]);

                $('.loading').removeClass('d-none')
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'image/upload',
                    method: "POST",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                    .done(function (data) {
                        $('#view-img').attr('src', 'storage/uploads/' + data)
                        $('.upload-img').removeClass('d-none')
                    });

                $.ajax({
                    url: 'http://localhost:5000',
                    method: "POST",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false

                })
                    .done(function (data) {
                        $('.loading').addClass('d-none');
                        $(".answer-ai").append(' <p class="alert">' + data + '</p>');

                    });
            })
        })
    </script>
@endsection
