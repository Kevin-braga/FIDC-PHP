<?php 
session_start(); ?>
<!DOCTYPE html>
<html>
<meta charset="utf-8"/>   
<meta name="viewport" content="width=device-width, initial-scale=1.0">    
<link href="https://fonts.googleapis.com/css?family=Maven+Pro" rel="stylesheet">
<link rel="shortcut icon" href="../img/favicon.png">      
<link rel="stylesheet" type="text/css" href="style1.css">  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="jquery.mask.min.js"></script> 
    
<head> 
    <title>FRDFIDC</title>
</head>
<body> 
<div>
    <center><img src="../img/logo.png" id="logo" alt="FRDFIDC"></center>
</div>
<div class="loginform">
        <form  method="post" id="form" onsubmit="return documento(cpf.value) && valida() && nascimento()" action="../codes/php.php">
            <p>CPF [apenas números]</p>
            <input type="text" id="cpf" name="cpf" required maxlength="11" onkeypress="return isNumber(event)" placeholder="00000000000"/>
            <p>Data de nascimento</p> 
            <input type="text" id="date" name="date" maxlength="10" placeholder="DD/MM/AAAA" required />
            <br/><br/>
            <div id="send-button" class="send-button">
                <button><span>Avançar</span></button>
            </div>
        </form><center><b style="font-size:14px">©2017 FRDFIDC </b></center><br>
</div>
    <div class="error">
            <img src="../img/error.png"><p>CPF Inválido</p>
    </div>
    <div class="error">
            <img src="../img/error.png"><p>Dados não constam na base</p>
    </div> 
    <div class="error">
            <img src="../img/error.png"><p>Data de nascimento inválida</p>
    </div> 
    <div class="error">
            <img src="../img/error.png"><p>CPF deve ter 11 dígitos</p>
    </div> 
    <div class="error">
            <img src="../img/error.png"><p>Data deve ter 10 dígitos</p>
    </div>
<script>   
function valida(){ var a = document.getElementById("cpf").value; var b = document.getElementById("date").value; if (a.length < 11) { erro(3); return false; } else if (b.length < 10) { erro(4); return false; } return true;} function unfade(element) { var op = 0.01; element.style.display = 'block'; var timer = setInterval(function () { if (op >= 1){ clearInterval(timer); setTimeout(function(){ fade(element)},4000); } element.style.opacity = op; element.style.filter = 'alpha(opacity=' + op * 100 + ")"; op += op * 0.1; }, 10);} function fade(element) { var op = 1; var timer = setInterval(function () { if (op <= 0.1){ clearInterval(timer); element.style.display = 'none'; } element.style.opacity = op; element.style.filter = 'alpha(opacity=' + op * 100 + ")"; op -= op * 0.1; }, 50);} function isNumber(evt) { evt = (evt) ? evt : window.event; var charCode = (evt.which) ? evt.which : evt.keyCode; if (charCode > 31 && (charCode < 48 || charCode > 57)) { return false; } return true;} $(document).ready(function(){ $('#date').mask('00/00/0000');});function nascimento(){ var dob = document.forms["form"]["date"].value; var data = dob.split("/"); if (isNaN(Date.parse(data[2] + "-" + data[1] + "-" + data[0]))) { erro(2); return false; } return true;}function documento(c){ var i; s = c; var c = s.substr(0,9); var dv = s.substr(9,2); var d1 = 0; var v = false; for (i = 0; i < 9; i++){ d1 += c.charAt(i)*(10-i); } if (d1 == 0){ v = true; } d1 = 11 - (d1 % 11); if (d1 > 9) d1 = 0; if (dv.charAt(0) != d1){ v = true; } d1 *= 2; for (i = 0; i < 9; i++){ d1 += c.charAt(i)*(11-i); } d1 = 11 - (d1 % 11); if (d1 > 9) d1 = 0; if (dv.charAt(1) != d1){ v = true; } if (!v) { return true; } else { return erro(0); }} function erro(e){ unfade(document.getElementsByClassName('error')[e]); return false;} 
</script>
</body>
<?php 
if (isset($_SESSION['error'])){
    echo '<script>erro(1);</script>';} 
session_destroy();
?>
</html>
