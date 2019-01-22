<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="$inc/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="$inc/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="$inc/css/util.css">
    <link rel="stylesheet" type="text/css" href="$inc/css/mainLogin.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
          integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form" method="post" action="/Administrador/Authenticate">
					<span class="login100-form-title p-b-26">
						Administrador
					</span>
                <span class="login100-form-title p-b-48">
					</span>

                <div class="wrap-input100">
                    <input class="input100" type="text" name="usuario">
                    <span class="focus-input100" data-placeholder="Nome de Usuário" autocomplete="off"></span>
                </div>

                <div class="wrap-input100">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
                    <input class="input100" type="password" name="senha">
                    <span class="focus-input100" data-placeholder="Senha" autocomplete="off"></span>
                </div>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>


<!--===============================================================================================-->
<script src="$inc/js/jquery.min.js"></script>
<!--===============================================================================================-->
<script src="$inc/js/mainLogin.js"></script>

</body>
</html>