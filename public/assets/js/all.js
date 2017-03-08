$(document).ready(function(){

    function getMessage(message, type){
        $('#message').fadeIn('fast').html(message).removeClass().addClass(type);
        window.location="#message";
    }

    $('#moreLink').on("click", function(){
        $('#moreLinks').append("<input type='text' placeholder='URL para Download' class='urlDownload urlDownloadSub form-style' required />");
    });

    $('#haveLegend').change(function(){
        if(this.checked){
            $('#legendUrl').toggle('fast');
        }else{
            $('#legendUrl').toggle('fast');
        }
    });

    $('#newFilme').on("submit", function(){
        var title = $('#title').val();
        var sinopse = $('#sinopse').val();
        var poster = $('#poster').val();
        var categories = $('#categories').val();
        var duration = $('#duration').val();
        var year = $('#year').val();
        var director = $('#director').val();
        var size = $('#size').val();
        var imdb = $('#imdb').val();
        var quality = $('#quality').val();
        var qualityAudio = $('#qualityAudio').val();
        var qualityVideo = $('#qualityVideo').val();
        var urlDownload = [];
        $('.urlDownload').each(function(){
            if($(this).val() != ""){
                urlDownload.push($(this).val());
            }
        });
        if($('#haveLegend').is(":checked")){
            var legendUrl = ($('#legendUrl').val() != "") ? $('#legendUrl').val() : "";
        }else{
            legendUrl = "";
        }

        if(title == "" || sinopse == "" || poster == "" || categories == "" || duration == "" || year == "" || director == "" || size == "" || imdb == "" || quality == "" || qualityAudio == "" || qualityVideo == ""){
            getMessage("Preencha todos os campos!", "error");
        }else if(urlDownload.length == 0){
            getMessage("Adicione ao menos 1 Link para Download");
        }else{
            $.ajax({
                type: "post",
                url: "application/functions/ajax.php",
                data: {
                    title: title,
                    sinopse: sinopse,
                    poster: poster,
                    categories: categories,
                    duration: duration,
                    year: year,
                    director: director,
                    size: size,
                    imdb: imdb,
                    quality: quality,
                    qualityAudio: qualityAudio,
                    qualityVideo: qualityVideo,
                    urlDownload: urlDownload,
                    legendUrl: legendUrl,
                    typeRequest: "newMovie"
                },
                success: function(data){
                    console.log(data);
                    if(data == 1){
                        $('#newFilme')[0].reset();
                        getMessage("Filme enviado com sucesso!", "success");
                    }else{
                        getMessage(data, "error");
                    }
                }
            });
        }


    });



});
$(function(){

    $('#administration_form').submit(function(){
        var password = $('#password').val();
        if(password == ""){
            $('#message').text("Preencha todos os campos!").removeClass().addClass('error').fadeIn('fast');
        }else{
            $('#message').text("Verificando dados...").removeClass().addClass('error').fadeIn('fast');
            $.ajax({
                type: "post",
                url: "application/functions/ajax.php",
                data:{
                    password: password,
                    typeRequest: "loginAdm"
                },
                success: function(d){
                    if(d == 1){
                        window.location='dashboard';
                    }else{
                        $('#message').text(d).removeClass().addClass('error').fadeIn('fast');
                    }
                }
            });
        }
        return false;
    });
});
$(document).ready(function(){
    var mySwiper = new Swiper ('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,

        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        direction: 'horizontal',
        loop: true,
        slidesPerView: 3,
        spaceBetween: 30,

        preventClicks: false
    });
    var load = 0;
    $(window).scroll(function(){
        if($(window).scrollTop() == ($(document).height() - $(window).height())){
            $('#loading').show();
            load = load+10;
            $.post("application/functions/ajax.php",{load:load, typeRequest: "pagination"}, function(data){
                $("#all-movies").append(data);
                $('#loading').hide();
            });
        }
    });
});
