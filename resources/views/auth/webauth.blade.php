<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta http-equiv="Pragma" content="no-cache"/>
<meta http-equiv="Cache-Control" content="no-cache"/>
<meta http-equiv="Content-Script-Type" content="text/javascript"/>

<style type="text/css" media="all">

input.login_disabled
{
    color: transparent;
    display: block;
    position: absolute;
    left: 304px;
    top: 62px;
    width: 67px;
    height: 60px;
    background: url({{ asset('img/webauth/btn_login_disabled.png') }}) no-repeat;
}

input.login
{
    color: transparent;
    display: block;
    position: absolute;
    left: 304px;
    top: 62px;
    width: 67px;
    height: 60px;
    cursor: pointer;
    background: url({{ asset('img/webauth/btn_login.png') }}) no-repeat;
}

input.login:hover
{
    background: url({{ asset('img/webauth/btn_login_hover.png') }}) no-repeat;
}

input.login:active
{
    background: url({{ asset('img/webauth/btn_login_clicked.png') }}) no-repeat;
}

input.quit
{
    color: transparent;
    display: block;
    position: absolute;
    left: 312px;
    top: 149px;
    width: 67px;
    height: 20px;
    cursor: pointer;
    background: url({{ asset('img/webauth/btn_quit.png') }}) no-repeat;
}

input.quit:hover
{
    background: url({{ asset('img/webauth/btn_quit_hover.png') }}) no-repeat;
}

input.quit:active
{
    background: url({{ asset('img/webauth/btn_quit_clicked.png') }}) no-repeat;
}

input
{
    background-color: #000000;
    color: #c3c3c3;
    font-size: 12px;
    font-family: 'Arial Black';
    height: 16px;
    cursor: text;
    border: 0;
    background-color: transparent;
}

*
{
    ime-mode: disabled;
    padding: 0px 0px 0px 0px;
    border: 0px 0px 0px 0px;
    border-width: 0px 0px 0px 0px;
    margin: 0px 0px 0px 0px;
    white-space: nowrap;
}

body
{
    background-image: url({{ asset('img/webauth/backform.png') }});
}

div#message
{
    display: block;
    position: absolute;
    left: 0px;
    top: 0px;
}

input#id
{
    position: absolute;
    left: 113px;
    top: 69px;
    width: 177px;
}

input#pass
{
    position: absolute;
    left: 113px;
    top: 97px;
    width: 177px;
}

div#idsave_box
{
    position: absolute;
    left: 120px;
    top: 130px;
}

span#cv
{
    position: absolute;
    left: 0px;
    top: 155px;
    font-size: 11px;
    color: #c3c3c3;
}

input#idsave
{
    background-color: transparent;
    color: #c3c3c3;
    font-size: 13px;
    font-weight: bold;
    cursor: pointer;
}

label#idsave_label
{
    color: #c3c3c3;
    font-size: 12px;
    cursor: pointer;
}
</style>

</head>

<body scroll="no" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0"
    marginheight="0" marginwidth="0" style="overflow:hidden;cursor:default;"
    onload="CheckUsername()">

<script type="text/javascript">
<!--
function CheckUsername()
{
    // If the username is filled in, move to the password box.
    if(4 <= document.formlogin.id.value.length)
    {
        document.formlogin.pass.focus();
    }
    else
    {
        document.formlogin.id.focus();
    }
}
// -->
</script>

<form action="" method="POST" name="formlogin">

<input class="{{ $can_login ? 'login' : 'login_disabled'}}" type="submit" value="1" tabindex="4" name="login" height="60" width="67"/>

<input class="quit" type="submit" value="1" tabindex="5"
    name="quit" height="20" width="67"/>

<input id="id" type="text" tabindex="1" value="{{ $username }}" name="ID"
    maxlength="32" {{ $can_login ? '' : 'readonly' }}/>

<input id="pass" type="password" tabindex="2" value=""
    name="PASS" maxlength="32" {{ $can_login ? '' : 'readonly' }}/>

<div id="message"><span style="font-size:12px;color:{{ $can_login ? '#c3c3c3' : '#edb81e' }};font-weight:bold;"><br>&nbsp;{{ $message }}</span></div>

<div id="idsave_box">
    <input id="idsave" type="checkbox" tabindex="3" name="IDSAVE" maxlength="32"
        value="{{ $idsave ? 1 : 0 }}" {{ $idsave ? 'checked' : '' }} {{ $can_login ? '' : 'readonly' }}/>
    <label id="idsave_label" for="idsave"> Remember username</label>
</div>

<span id="cv">&nbsp;COMP_hack {{ $client_version }}</span>

<input type="hidden" name="cv" value="{{ $client_version }}">

</form>

<!-- web:ok -->

</body>
</html>
