<!DOCTYPE html>
<html lang="en">

<head>

    <title>Super Assist Systems LLC</title>

    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap core CSS -->
    <link href="/front/bootstrap/bootstrap.css" rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="/front/login.css" type="text/css">

</head>

<body class="back-black">

<div class="login-form">

    <div class="login-logo">

        Системд нэвтрэх

    </div>

    <form action="/sign/do_login" method="POST" class="form">

        <div class="form-group">

            <label for="username">Нэвтрэх нэр</label>

            <input type="text" value="" name="username" class="form-control" placeholder="Нэвтрэх нэр">

        </div>

        <div class="form-group">

            <label for="password">Нууц үг</label>

            <input type="password" value="" name="password" class="form-control" placeholder="Нууц үг">

        </div>

        <div class="form-group {{ $errors->has() ? 'has-error' : '' }}">

            <span class="help-block">

                {{ $errors->first() }}

            </span>

        </div>

        <div class="form-group">

            <input type="submit" value="Нэвтрэх" class="btn btn-success">

        </div>

    </form>

</div>

<script src="/front/min.js" type="text/javascript"></script>
<script src="/front/bootstrap/bootstrap.min.js" type="text/javascript"></script>

</body>