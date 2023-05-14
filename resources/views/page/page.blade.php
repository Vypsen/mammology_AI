@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Загрузите маммограму</h2>
        <div class="col-md-12 row">
            <div class="card h-50">
                <form class="mammograma" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row my-3 d-flex">
                        <div class="col-lg-3">
                            <input id="image" required class="align-content-center my-auto mx-auto" type="file"
                                   name="image">
                        </div>
                        <div class="form-check col-lg-3">
                            <input class="form-check-input personal-data" required type="checkbox"
                                   id="flexCheckDefault"
                                   title='Для продолжения вы обязаны подтвердить'>
                            <label class="form-check-label" for="flexCheckDefault">
                                Подтверждаю обработку своих персональных данных
                            </label>
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="upload btn btn-success btn-sm"> Подтвердите загрузку
                                изображения
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="upload-img d-none pt-3">
                <img id="view-img"  class="img-thumbnail img-fluid" src="">
            </div>
            <div class="spinner-border loading pt-3 d-none" role="status"></div>
            <div class="card answer-ai p-0 mt-3 d-none">
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.mammograma').submit(function (ev) {
                ev.preventDefault()

                var data = new FormData();
                data.append('file', $("#image")[0].files[0]);

                $('.loading').removeClass('d-none');

                $.when(sendPhp(data), sendAI(data)).done(function (responsePHP, responseAI) {
                    $('.loading').addClass('d-none');
                    sendPredict({'filename': responsePHP[0]['filename'], 'predict': responseAI[0]})

                }).fail(function (error) {

                });
            })
        })

        function sendPhp(data) {
            return $.ajax({
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
                    console.log(data);
                    $('#view-img').attr('src', 'storage/uploads/' + data['filename'])
                    $('.upload-img').removeClass('d-none')
                });
        }

        function sendAI(data) {
            return $.ajax({
                url: 'http://localhost:5000/image/upload',
                method: "POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false
            })
                .done(function (data) {
                    if (data === 1) {
                        $(".answer-ai").append(' <p class="alert alert-danger m-0">' + "Я думаю, у вас рак" + '</p>');
                    } else {
                        $(".answer-ai").append(' <p class="alert alert-success m-0">' + "Я думаю, у вы здоровы " + '</p>');
                    }
                    $('.answer-ai').removeClass('d-none')
                });
        }

        function sendPredict(data) {
            return $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'predict',
                method: "POST",
                data: data,
            })
        }
    </script>
@endsection
