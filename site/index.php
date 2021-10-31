<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="myStyle.css" rel="stylesheet">
    <title>MundoJIX</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-light bg-gradient-bar">
            <div class="container-fluid">
              <ul class="nav">  
                <?php if (isset($_REQUEST['log']) == "S"){
                  session_start();
                  ?>
                    <img class="rounded-circle mr-3" src="https://source.unsplash.com/50x50/?store" alt="">
                    <a class="navbar-brand text-white text-start " href="index.php?log=S"><b><?php echo $_SESSION['std_name'] ?></b></a>
                <?php }else{?>
                  <img style="width:50px;height:50px;" class="rounded-circle mr-3" src="https://admin.mundojix.com/storage/company/profile/75/756611429101." alt="Grupo Tiradentes">
                  <a class="navbar-brand text-white text-start " target="_blank" href="https://www.grupotiradentes.com"><b>Grupo Tiradentes</b></a>
                <?php }?>
              </ul>
              <ul class="nav">
                <?php if (isset($_REQUEST['log']) == "S"){?>
                    <li class="nav-item">
                      <a href="doLogout.php" class="nav-link text-white" href="#">logout</a>
                    </li>
                <?php }?>
              </ul>
            </div>
          </nav>
      </header>
</body>
<body>
    <div align="center">
        <?php
        if (isset($_REQUEST['log'])){
            $Tela = "painel.php";
        }else{
            $Tela = "Menu.php";
        }

            include $Tela;
        ?>
    </div>
</body>
</html>