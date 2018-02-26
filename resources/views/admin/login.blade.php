<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="/public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/public/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="/public/vendors/animate.css/animate.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="/public/build/css/custom.min.css" rel="stylesheet">
    <script src="/public/vendors/jquery/dist/jquery.js"></script>
</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form action="{{ url('admin/login') }}" method="post">
                    {{ csrf_field() }}
                    <h1>登录</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="账户" required="required" value="{{ old('account') }}" name="account"/>
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="密码" required="required" value="{{ old('password') }}" name="password"/>
                    </div>
                    <div>
                        <input type="text" class="form-control" placeholder="验证码" required="required" value="" name="captcha"/>
                        <span style="display: inline-block; height: 50px; width: 200px;">
                            {!! captcha_img() !!}
                            <script>
                                $(function(){
                                    $('[alt=captcha]').on('click', function(){
                                        var src = $(this).attr('src');
                                        $(this).attr('src', src+'&'+Math.random())
                                    });
                                });
                            </script>
                        </span>
                    </div>

                    <div>
                        <button class="btn btn-default submit" href="index.html">登录</button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-paw"></i> 欧亚 | 租赁</h1>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
<p style="position: absolute; bottom: 10px;right:20px">Thank Gentelella Alela</p>
<script>
    @foreach ($errors -> all() as $e)
        alert('{{$e}}');
    @endforeach
</script>
</body>
</html>