$(document).ready(function () {
    $('.mammograma').submit(function (ev) {
        ev.preventDefault()

        var data = new FormData();
        data.append('file', $("#image")[0].files[0]);

        $('.loading').removeClass('d-none');

        $.when(sendPhp(data), getCluster(data), getPrediction(data)).done(function (responsePHP, responseCluster, responseAI) {
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

function getCluster(data) {
    return $.ajax({
        url: 'http://localhost:5000/image/cluster',
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            var images = response.images;
            for (var i = 0; i < images.length; i++) {
                var img = 'data:image/png;base64,' + images[i];
                $('.carousel-inner > #'+ i + ' > img' ).attr('src', img)
                // $('#image-container').append(img);
            }
            $('#image-container').removeClass('d-none')
        },
    })

}

function getPrediction(data) {
    return $.ajax({
        url: 'http://localhost:5000/image/prediction',
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data == 1) {
                $(".answer-ai").append(' <p class="alert alert-danger m-0">' + "У вас наблюдается подозрение на злокачетсвенное образование. Советуем обратиться к специалисту " + '</p>');
            } else {
                $(".answer-ai").append(' <p class="alert alert-success m-0">' + "У не вас наблюдается подозрение на злокачетсвенное образование. " + '</p>');
            }
            $('.answer-ai').removeClass('d-none')
        }
    })
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
