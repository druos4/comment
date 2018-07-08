@extends('layouts.public')
 
@section('content')
 
    <h2>Регистрация</h2>
    <form method="POST" action="/register" id="reg-form">
        {{ csrf_field() }}
        <div class="form-group" id="div-email">
            <label for="email">E-mail (по умолчанию не отображается в профиле):</label>
            <input type="email" class="form-control" id="email" name="email" >
        </div>
        <div class="form-group" id="div-nickname">
            <label for="name">Никнейм (всегда отображается как имя профиля):</label>
            <input type="text" class="form-control" id="nickname" name="nickname" >
        </div>
        <div class="form-group" id="div-surname">
            <label for="name">Фамилия (по умолчанию не отображается в профиле):</label>
            <input type="text" class="form-control" id="surname" name="surname" >
        </div>

        <div class="form-group" id="div-name">
            <label for="name">Имя (по умолчанию не отображается в профиле):</label>
            <input type="text" class="form-control" id="name" name="name" >
        </div>
        
 

        <div class="form-group" id="div-password">
            <label for="password">Пароль (минимум 6 символов):</label>
            <input type="password" class="form-control" id="password" name="password" >
        </div>
        <div class="form-group" id="div-password2">
            <label for="password">Подтверждение пароля:</label>
            <input type="password" class="form-control" id="password2" name="password2" >
        </div>

        <div class="alert alert-danger error" role="alert" style="display: none;"></div>

        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary goReg">Зарегистрироваться</button>
        </div>

    </form>
 
@endsection

@section('footer')
<script>

    function validEmail(v) {
        var r = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
        return (v.match(r) == null) ? false : true;
    }

    $(".goReg").click(function(e){
        e.preventDefault();
        $('#div-email').removeClass('has-error');
        $('#div-surname').removeClass('has-error');
        $('#div-name').removeClass('has-error');
        $('#div-nickname').removeClass('has-error');
        $('#div-password').removeClass('has-error');
        $('#div-password2').removeClass('has-error');        
        $('#div-email').removeClass('has-success');
        $('#div-surname').removeClass('has-success');
        $('#div-name').removeClass('has-success');
        $('#div-nickname').removeClass('has-success');
        $('#div-password').removeClass('has-success');
        $('#div-password2').removeClass('has-success');
        $('.error').hide();
        $('.error').html('');  


        var mail = $('#email').val();
        var nickname = $('#nickname').val();
        var surname = $('#surname').val();
        var name = $('#name').val();
        var password = $('#password').val();
        var password2 = $('#password2').val();
        var passLen = password.length;
        var errTxt = '';
        var hasErrors = 0;

        if(mail == ''){
            $('#div-email').addClass('has-error');    
            errTxt = errTxt + 'Укажите Ваш e-mail.<br />';
            hasErrors = 1;
        } else {
            if (!validEmail(mail)) {
                errTxt = errTxt + 'Неверный формат e-mail.<br />';
                hasErrors = 1;
            }
        }
        if(nickname == ''){
            $('#div-nickname').addClass('has-error');    
            errTxt = errTxt + 'Укажите Ваш никнейм.<br />';
            hasErrors = 1;
        }
        if(surname == ''){
            $('#div-surname').addClass('has-error');    
            errTxt = errTxt + 'Укажите Вашу фамилию.<br />';
            console.log(errTxt);
            hasErrors = 1;
        } else {
            $('#div-surname').addClass('has-success');
        }
        if(name == ''){
            $('#div-name').addClass('has-error');    
            errTxt = errTxt + 'Укажите Ваше имя.<br />';
            hasErrors = 1;
        } else {
            $('#div-name').addClass('has-success');
        }
        if(password == ''){
            $('#div-password').addClass('has-error');    
            errTxt = errTxt + 'Вы не ввели пароль.<br />';
            hasErrors = 1;
        } else if(passLen < 6){
            $('#div-password').addClass('has-error');    
            errTxt = errTxt + 'Пароль слишком короткий.<br />';
            hasErrors = 1;
        } else if(password != password2){
            $('#div-password2').addClass('has-error');    
            errTxt = errTxt + 'Введенные пароли не совпадают.<br />';
            hasErrors = 1;
        } else {
            $('#div-password').addClass('has-success');    
            $('#div-password2').addClass('has-success');    
        }
        if(mail != '' && nickname != ''){
            $.ajax({
                type:'POST',
                url:'/register/checkAjax',
                data:{email:mail, nickname:nickname},
                success:function(data){
                    if(data.mail == 'n'){
                        $('#div-email').addClass('has-success');
                    } else {
                        $('#div-email').addClass('has-error');            
                        errTxt = errTxt + 'Такой e-mail уже зарегистрирован в системе!<br />';
                        hasErrors = 1;
                    }
                    if(data.nick == 'n'){
                        $('#div-nickname').addClass('has-success');
                    } else {
                        $('#div-nickname').addClass('has-error');            
                        errTxt = errTxt + 'Такой никнейм уже зарегистрирован в системе!<br />';
                        hasErrors = 1;
                    }

                    if(hasErrors == 1){
                        $('.error').show();
                        $('.error').html(errTxt);
                    } else {
                        $('#reg-form').submit();
                    }
                }
            });
        } else {
            if(errTxt != ''){
                $('.error').show();
                $('.error').html(errTxt);
            } 
        }
    });


</script>
@endsection
