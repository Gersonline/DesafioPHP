<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8">    
    <link rel="stylesheet" href="css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body>
    <p color="navy">EM PARCERIA COM MUNDO JIX</p><br>
        <div class="site-branding" align="center">
        <a href="https://www.mundojix.com/" target="_blank" class="custom-logo-link" rel="home"><img width="110" height="31" src="https://app.mundojix.com/static/media/logo.9f569191.png" class="custom-logo" title="MundoJix">
        </a>
    </div>
    <section class="">
        <div style="height:49em;" class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-grey">Entrar</h3>
                    <div class="box">
                        <form action="login.php" method="POST">
                            <div class="field">
                                <div class="control">
                                    <input name="usuario" name="text" class="input is-large" placeholder="Seu RA" autofocus="">
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input name="senha" class="input is-large" type="password" placeholder="Sua senha">
                                </div>
                            </div>
                            <button type="submit" class="button is-block is-link is-large is-fullwidth">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      
    </section>
    <footer>
          <div  class="footer navbar-fixed-bottom bg-dark p-3">
              <div class="row">
                  <div class="col-sm-12 text-white text-center">
                    <p class="mb-0"> Powered By: Gerson Lima</p>
                  </div>
              </div>
          </div>
      </footer>
</body>

</html>
	