<!DOCTYPE html>
<?php
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    $title = "Consulta de Cliente";
    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
    $busca = isset($_POST['busca']) ? $_POST['busca'] : 1;
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="shortcut icon" href="img/pilha-de-livros.png">

    <script>
        function excluir(url){
            if (confirm("Deseja excluir o item?"))
                location.href = url;
        }
    </script>
</head>
<body class="bg-black">
    <?php
        include_once "index.php";
    ?>
    <div class="margin-top">
        <div class="container-fluid">
            <form method="post">
                <div class="form-group col-6">
                    <h3 style="font-weight: bold">Procurar Cliente</h3>
                        <input type="text" name="procurar" class="form-control" size="50"
                        placeholder="Insira a consulta" value="<?php echo $procurar;?>">
                    <br>
                
                    <div class="text-white">
                    <p>Ordenar e pesquisar por:</p>
                        <input type="radio" name="busca" value="1" class="form-check-input" <?php if ($busca == "1") echo "checked" ?>> <b>Id</b><br>
                        <input type="radio" name="busca" value="2" class="form-check-input" <?php if ($busca == "2") echo "checked" ?>> <b>Nome</b><br>
                        <input type="radio" name="busca" value="3" class="form-check-input" <?php if ($busca == "3") echo "checked" ?>> <b>CPF</b><br>
                    <br>
                    </div>
                        <button type="submit" name="acao" id="acao" class="btn btn-outline-info">Buscar</button>
                    
                </div>
                <hr>
            </form>

            <table class="table table-striped" style="background-color: #FFF;">
            <tr><td><b>ID</b></td>
                <td><b>Nome</b></td>
                <td><b>CPF</b></td>
                <td><b>Data de Nascimento</b></td>
                <td><b>Editar</b></td>
                <td><b>Excluir</b></td>
            </tr> 

        <?php
            $pdo = Conexao::getInstance();

            if($busca == 1){
                $consulta = $pdo->query("SELECT * FROM Cliente
                                        WHERE c_idCliente LIKE '$procurar%' 
                                        ORDER BY c_idCliente");}

            else if($busca == 2){
                $consulta = $pdo->query("SELECT * FROM Cliente
                                        WHERE c_nome LIKE '$procurar%' 
                                        ORDER BY c_nome");}

            else if($busca == 3){
                $consulta = $pdo->query("SELECT * FROM Cliente 
                                        WHERE c_cpf LIKE '$procurar%'
                                        ORDER BY c_cpf");}
        
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
        ?>
        <tr><td><?php echo $linha['c_idCliente'];?></td>
            <td><?php echo $linha['c_nome'];?></td>
            <td><?php echo $linha['c_cpf'];?></td>
            <td><?php echo $linha['c_dt_nascimento'];?></td>
            <td><a href='cadCliente.php?acao=editar&c_idCliente=<?php echo $linha['c_idCliente'];?>'> <img src="img/edit.png" style="width: 1.8vw;"></a></td>
            <td><?php echo " <a href=javascript:excluir('acaoCliente.php?acao=excluir&c_idCliente={$linha['c_idCliente']}')>";?><img src="img/delete.png" style="width: 1.5vw;"></a></td>
        </tr>

        <?php } ?>
            
            </table>
        </div>
    </div>
    <script src="bootstrap/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>