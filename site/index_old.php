<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="charset" content="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Meu Portifólio</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="estilo.css">
    
    <title>Tela Inicial</title>
</head>
<link rel="stylesheet" type="text/css" href="estilo.css">
<body>
		<div class="container-fluid">
			<div class="row">
				<input type="checkbox" id="bt_menu">
    			<label for="bt_menu">&#9776;</label>				
		</div>
	</body>
<body>
    <input type="checkbox" id="bt_menu">
    <label for="bt_menu">&#9776;</label>


    <nav class="menu">
        <ul>
            <li><a href="javascript:MudaView('MinhasInformacoes.html');">Gerson P. Lima</a></li>
            <!--<li><a href="javascript:MudaView('QuemSou.html');">Quem Sou</a></li>-->
            <li><a href="javascript:MudaView('Contato.html');">Contato</a></li>
        
            <li><a href="#">Contato</a></li>
            <?php if (isset($_REQUEST['log']) == "S"){?>
                <li>
                    <div id="divfoto">
                    <li><img style="width:100px; height: 100px" src="images/EUjpg.jpg"></li>
                    </div>
                </li>
                <li>
                    <div id="divlogout">
                        <u><font><a style="border:0;" href="doLogout.php">logout</a></font></u>
                    </div>
                </li>
            <?php }?>
        </ul>
    </nav>
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