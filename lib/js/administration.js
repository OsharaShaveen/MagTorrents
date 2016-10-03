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
