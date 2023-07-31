<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('style/loginAdmin.css')}}">
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <div id="imagem">
            <a href="/"><img src="https://scaap.esteio.rs.gov.br/scaap/img/SCAAP%20preto.png" id="scaap2" alt="SCAAP"></a>
        </div>
        <h2>Login</h2>
        <form action="" method="post">
          @csrf
            <div class="input-box">
                <input type="text" name="cpf" id="cpf" placeholder="Cpf" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" id="password" placeholder="Senha" required>
            </div>
            <div style="magin-top:20px;" class="input-box button">
                <input type="Submit" value="Entrar">
            </div>
        </form>
    </div>
</body>
</html>
