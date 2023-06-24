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
                        {{--                        <div class="form-check col-lg-3">--}}
                        {{--                            <input class="form-check-input personal-data" required type="checkbox"--}}
                        {{--                                   id="flexCheckDefault"--}}
                        {{--                                   title='Для продолжения вы обязаны подтвердить'>--}}
                        {{--                            <label class="form-check-label" for="flexCheckDefault">--}}
                        {{--                                Подтверждаю обработку своих персональных данных--}}
                        {{--                            </label>--}}
                        {{--                        </div>--}}
                        <div class="col-lg-2">
                            <button type="submit" class="upload btn btn-success btn-sm"> Подтвердите загрузку
                                изображения
                            </button>
                        </div>
                        <div class="col-lg">
                            <small>Подтверждая загрузку изображения вы соглашаетесь на обработку персональных
                                данных</small>
                        </div>
                    </div>
                </form>
            </div>
            <div class="loading container mt-3 d-none">
                <div class="alert alert-success row" role="alert">
                    <div class="col-1 spinner-border text-success me-2" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="lead col">
                        Происходят необходимые вычисление. Это может занять пару минут.
                    </div>
                </div>
            </div>
            <div class="container mt-3">
                <div class="row">
                    <div class="col">
                        <div class="upload-img d-none pt-3">
                            <p>Ваше изображение</p>
                            <img id="view-img" class="img-thumbnail img-fluid" src="">
                        </div>
                        <div class="card answer-ai p-0 mt-3 d-none">
                        </div>
                    </div>
                    <div class="col">
                        <div id="image-container" class="d-none">
                            <h4>Зоны подозрительные на рак</h4>
                            <div id="carouselExampleCaptions" class="carousel slide" data-bs-interval="false"  >
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                                            class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                                            aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                                            aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div id="0" class="carousel-item active" style="border-radius: 7px">
                                        <img src="" class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                        </div>
                                    </div>
                                    <div id="1" class="second carousel-item" style="border-radius: 7px">
                                        <img src="" class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                        </div>
                                    </div>
                                    <div id="2" class="third carousel-item" style="border-radius: 7px">
                                        <img src="" class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                        </div>
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Предыдущий</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Следующий</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
