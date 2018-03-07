
<!DOCTYPE html>
<html lang="zn-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>未來學網站登入系統</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            background-color: rgb(78, 80, 94);
        }
        .container{
            margin-top: 100px;
        }
        .login_title{
            font-size: 25px;           
            font-weight: bolder;
        }
        .login_text{
            font-size: 20px;
        }
        .login_alert_area{
            margin-right: 15%;
            margin-left: 15%;
        }
        #login_panel{
            margin-right: 20%;
            margin-left: 20%;
        }
    </style>
    
</head>
<body>
    <div class="container">
        <div class="panel panel-default" id="login_panel">
            <div class="panel-heading login_title">登入</div>
            <div class="panel-body">      
                <form class="form-horizontal" method="POST" id="Login_form" action="http://163.13.127.72:1202">
                    {{--  <input type="hidden" name="_token" value="{{ csrf_token() }}">  --}}
                    <div class="form-group">
                        <label for="inputStuID" class="col-md-2 control-label login_text">信箱</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control login_text" id="inputStuID" name="userAccount" placeholder="Student ID">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-md-2 control-label login_text">密碼</label>
                        <div class="col-md-10">
                            <input type="password" class="form-control login_text" id="inputPassword" name="userPassword" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <div class="checkbox">
                                <label class="login_text">
                                    <input type="checkbox" id="remember_me"> 記住我
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn btn-default login_text" id="btn_submit">登入</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
    <script>
        'use strict';
        $(document).ready(function(){
            var remeber_me = false;
            init();

            $('#remember_me').click(function(){
                var inputStuID = $('#inputStuID').val();
                remeber_me = $(this).prop('checked');
                if(remeber_me == true){
                    $.cookie('user_StuID', inputStuID, {expires: 1, path:'/'});
                    console.log(document.cookie);
                }else{
                    $.cookie('user_StuID', '', {expires:1, path:'/'});
                    console.log(document.cookie);
                }
            });

            $('#btn_submit').click(function(event){
                event.preventDefault();
                var password = $('#inputPassword').val();
                if (password.length < 9) {
                    alert('PS:密碼長度必須大於9');
                } else {
                    $("#Login_form").submit();
                }
            });
        })
        function init(){
            var StuID = $.cookie('user_StuID');
            if(StuID!=''){
                $('#inputStuID').val(StuID);
                $('#remember_me').prop('checked',true);
            }
        }
    </script>
</body>
</html>