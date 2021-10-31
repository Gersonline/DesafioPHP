<?php
include('conexao.php');
session_start();
$_SESSION['cl'] = "c";


if(isset($_POST['view'])){
    /*$arquivo = $_POST['file'];

    header("content-type: application/pdf");
    @readfile('arquivos/'.$arquivo);*/
    header("Location:index.php?log=S");

} else if(isset($_POST['delete'])){
    $arquivo = $_POST['file'];

    $std_id = $_SESSION['usuario'];
    $doc_id = $_POST['delete'];
    
    $query = "delete from STUDENT_DOC 
    where doc_id = {$doc_id} 
    and std_id = {$std_id}";

    $stid = oci_parse($Oracle, $query);
    ociExecute($stid);

    oci_commit($Oracle);

    //fecha a conexão atual
    oci_close($Oracle);


    $stid = oci_parse($Oracle, $query);
    ociExecute($stid);

    oci_commit($Oracle);

    //fecha a conexão atual
    oci_close($Oracle);

    unlink('arquivos/'.$arquivo);
    header("Location:index.php?log=S");

    
}else if(isset($_POST['homolog'])){

    $std_id = $_SESSION['usuario'];
    $doc_id = $_POST['homolog'];
    if($_POST['sts'] == 'HM'){
        $sts = 'NH';
    }else{
        $sts = 'HM';
    }
    
    $query = "UPDATE STUDENT_DOC 
    set doc_sts = '{$sts}'
    where doc_id = {$doc_id} 
    and std_id = {$std_id}";

    $stid = oci_parse($Oracle, $query);
    ociExecute($stid);

    oci_commit($Oracle);

    //fecha a conexão atual
    oci_close($Oracle);


    $stid = oci_parse($Oracle, $query);
    ociExecute($stid);

    oci_commit($Oracle);

    //fecha a conexão atual
    oci_close($Oracle);
    
    header("Location:index.php?log=S");
}

$std_id = $_SESSION['usuario'];
//bloco da consulta SQL
$query = "select sd.DOC_ID, sd.DOC_NAME, 
           sd.DOC_TYPE, sd.DOC_HR, 
           sd.DOC_STS, sd.STD_ID, 
           TO_CHAR(sd.DOC_DATE_INC, 'DD/MM/YYYY, HH24:MI:SS' ) as DOC_DATE_INC 
          from STUDENT_DOC sd
           where sd.STD_ID = '{$std_id}'
          ORDER BY 
          DOC_DATE_INC desc";

$stid = oci_parse($Oracle, $query);
OCIExecute($stid);

//Abaixo conta a quantidade de linhas retornada da consulta.
$nrows = oci_fetch_all($stid, $results);

OCIExecute($stid);

?>
    <section>
          <div class="container mb-5">
            <div class="row">     
<?php
if ($nrows >= 1){
    while($row = oci_fetch_assoc($stid))
    {

        if($row['DOC_STS'] == 'HM'){
            $hm="success";
            $sts="Homologado";
        }else{ 
            $hm="warning";
            $sts="Não Homologado";
        }

        ?>
        <div class="col-sm-4 mb-2" >
            <div class="card border-<?php echo $hm ?>">
                <iframe src="arquivos\<?php echo $row['DOC_NAME']?>" scrolling="no" id="framearqv" style="overflow-y hidden; width:100%; height:200px;" frameborder="0"></iframe>
                <div class="card-body" style="min-height:240px;">

                        <h5 class="card-title text-<?php echo $hm ?>"><?php echo $row['DOC_NAME']."<br>"?></h5>
                        <p class="card-text text-start">
                            <?php echo
                                "Tipo de Atividade: ".  $row['DOC_TYPE']."<br>
                                Quantidade de Horas: ".  $row['DOC_HR']."<br>
                                Status: ".  $sts."<br>
                                Data de Inclusão: ". $row['DOC_DATE_INC']?>
                            </p>
                    <form action="list_doc_cards.php"  method="post" enctype="multipart/form-data">
                        <input style="display:none" type="text" id="file" name="file" value="<?php echo $row['DOC_NAME']?>" class="btn btn-success"></input>
                        <label  type="" name="" title="Excluir" class="btn btn-outline-danger bi bi-trash">
                            <input  style="display:none" type="submit" id="delete" name="delete"  value="<?php echo $row['DOC_ID']?>" class=""></input>
                        </label>
                        <label  type="" name="" title="Abrir" class="btn btn-outline-warning bi bi-file-pdf">Abrir
                            <input  style="display:none" type="submit" id="view" name="view" value="view" onclick="window.open('<?php echo'arquivos/'. $row['DOC_NAME']?>');" class="btn btn-success"></input>
                        </label>
                        <input style="display:none" type="text" id="sts" name="sts" value="<?php echo $row['DOC_STS']?>" class="btn btn-success"></input>
                        <?php if($row['DOC_STS'] == 'HM'){?>
                            <label  type="" name="" title="Desomologação" class="btn btn-outline-danger bi bi-file-earmark-excel">
                                <input  style="display:none" type="submit" id="delete" name="homolog"  value="<?php echo $row['DOC_ID']?>" class=""></input>
                            </label>
                        <?php }else{ ?>
                            <label  type="" name="" title="Homologar" class="btn btn-outline-success bi bi-file-check">
                                <input  style="display:none" type="submit" id="delete" name="homolog"  value="<?php echo $row['DOC_ID']?>" class=""></input>
                            </label>
                        <?php }?>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
}else{
    ?>
        <tr>
        <td style="text-align: center;"colspan="3" ><h5 class="card-title text-danger"><b><?php echo "Nenhum registro encontrado"?></b></h5></td>
        </tr>
        <?php
}?>
<?php
oci_free_statement($stid);

//fecha a conexão atual
oci_close($Oracle);

$query;exit;

?>