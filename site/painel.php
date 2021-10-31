<?php

include('conexao.php');
include('verifica_login.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $arquivo = $_FILES['file'];
    if (file_exists('arquivos/'.$arquivo['name'])) {
        ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'O arquivo com o nome  <?php echo $arquivo['name'] ?> já existe.',
                    text: 'Insira um arquivo com outro nome.',
                    showCancelButton: true,
                    showConfirmButton: false,
                    cancelButtonColor: '#d33',
                    cancelButtonText: `OK`
                })
                header("Location:index.php?log=S");
            </script>
        <?php 
    } else {
        $arquivoNovo = explode('.',$arquivo['name']);
        $namearqv = $arquivo['name'];
        $std_id = $_SESSION['usuario'];
        $tip_doc = $_POST['tipDoc'];
        
        $query = "INSERT INTO STUDENT_DOC(
            DOC_ID,
            DOC_NAME,
            DOC_TYPE,
            DOC_DATE_INC,
            DOC_HR,
            DOC_STS,
            STD_ID
        )values(
        (select nvl(max(DOC_ID),0)+1 
            from STUDENT_DOC
            where STD_ID = '{$std_id}'),
        '{$namearqv}',
        '{$tip_doc}',
        sysdate,
        40,
        'NM',
        '{$std_id}'
        )";

        if($arquivoNovo[sizeof($arquivoNovo)-1] != 'pdf'){
            ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Formato Inválido.',
                    text: 'São permitidos apenas arquivos no formato PDF.',
                    showCancelButton: true,
                    showConfirmButton: false,
                    cancelButtonColor: '#d33',
                    cancelButtonText: `OK`
                })
                header("Location:index.php?log=S");
            </script>
            <?php 
        }else{
            $stid = oci_parse($Oracle, $query);
            ociExecute($stid);

            oci_commit($Oracle);

            //fecha a conexão atual
            oci_close($Oracle);

        
            move_uploaded_file($arquivo['tmp_name'],'arquivos/'.$arquivo['name']);
            //echo('Upload efetuado com sucesso!');
            header("Location:index.php?log=S");
        }
    
    }
}

?>
<head>
    <style type="text/css">
        #frame-spec{
            overflow-y: hidden;
        }
        body {
            font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif; 
        }
    </style>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
</head>
      <section>
          <div class="container mb-5">
                <div class="col-sm-12 text-dark text-center my-3">
                    <h1>Arquivos</h1>
                </div>
                
                <section>
                    <div style="padding:20px;border: 1px solid; border-color:silver;" class="btn-lg" role="group" aria-label="Basic example">
                    <div  style="padding-right: 98%;" title="Layout">
                        <label  id="altbtnCard" type="" name="" class="btn btn-success"><b></b>
                            <i class="bi-grid-3x3-gap"></i>
                        </label>
                        <label  id="altbtnList" type="" name="" class="btn btn-success"><b></b>
                            <i class="bi-card-list"></i>
                        </label>
                    </div>
                        <form id="target" action="index.php?log=S" method="post" enctype="multipart/form-data">
                            <h5 class="card-title text-warning">Tipo de documento:</h5>
                            <div style="width:50%;padding:0px;" class="input-group mb-3">
                                <input id="tipDoc" name="tipDoc" type="text"  class="form-control" style="width:300px;" aria-label="Small" placeholder="Exemplo: Atividades Complementares de Python" aria-describedby="basic-addon1"  >
                                    <div class="input-group-prepend">
                                        <label  id="lblChoose" type="" name="" class="btn btn-success disabled"><b>Escolher...</b>
                                            <input style="display:none" type="file" id="file" name="file" class="btn btn-success"></input>
                                        </label>
                                    </div>
                            </div>
                        </form>
                    </div>
                </section>
                <div class="container mb-5">
                    <div class="row">
                        <div style="height:58vh;" class="container">
                                <span id="conteudo"></span>
                        </div>
                    </div>
                </div>   
            </div>
        </section>
          </div>
      </section>
    
  </body>
<body>
<script>
	$(document).ready(function(){
		<?php if ($_SESSION['cl'] == "c"){?>
        $('#altbtnList').show();
        $('#altbtnCard').hide();
        $.post('list_doc_cards.php', function(retorna){
            $("#conteudo").html(retorna);	
        });
        <?php }else{?>
            $('#altbtnList').hide();
            $('#altbtnCard').show();
            $.post('list_docs.php', function(retorna){
                $("#conteudo").html(retorna);	
            });
        <?php }?>

        $( "#altbtnList" ).click(function() {
            $('#altbtnList').hide();
            $('#altbtnCard').show();
            $.post('list_docs.php', function(retorna){
			    $("#conteudo").html(retorna);	
		    });
        });
        $( "#altbtnCard" ).click(function() {
            $('#altbtnCard').hide();
            $('#altbtnList').show();
            $.post('list_doc_cards.php', function(retorna){
                $("#conteudo").html(retorna);	
            });
        });

        $('#tipDoc').keyup(function() {
            if($("#tipDoc").val().length >= 3){
                $('#lblChoose').removeClass('disabled')
            }if($("#tipDoc").val().length < 3){
                $("#lblChoose").attr('class', 'btn btn-success disabled');
            }
        });

/*        $('#tipDoc').keyup(function() {
            if($("#tipDoc").val().length >= 3){
                $("#lblChoose").toggleClass('btn btn-success');
            }if($("#tipDoc").val().length < 3){
                $("#lblChoose").toggleClass('btn btn-success disabled');
            }else{
                $("#lblChoose").toggleClass('btn btn-success disabled');
            }
        });*/

        $('#file').change(function() {
            $('#target').submit();
            $('#file').reset();
        });
	});

   
</script>
</body>