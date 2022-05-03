<!DOCTYPE html>
<?php
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    $title = "Consulta de Vendas";
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
        require_once "index.php";
    ?>
    
    <div class="margin-top">
        <div class="container-fluid">
            <form method="post">
                <div class="form-group col-6">
                    <h3 style="font-weight: bold">Procurar Venda</h3>
                        <input type="text" name="procurar" class="form-control" size="50"
                        placeholder="Insira a consulta" value="<?php echo $procurar;?>">
                    <br>
                    
                    <div class="text-white">
                    <p>Ordenar e pesquisar por:</p>
                        <input type="radio" name="busca" value="1" class="form-check-input" <?php if ($busca == "1") echo "checked" ?>> <b>Id</b><br>
                        <input type="radio" name="busca" value="2" class="form-check-input" <?php if ($busca == "2") echo "checked" ?>> <b>Valor</b><br>
                        <input type="radio" name="busca" value="3" class="form-check-input" <?php if ($busca == "3") echo "checked" ?>> <b>Cliente</b><br>
                    <br>
                    </div>
                        <button type="submit" name="acao" id="acao" class="btn btn-outline-info">Buscar</button>
                    
                </div>
                <hr>
            </form>

            <table class="table table-striped" style="background-color: #FFF;">
                
            <tr><td><b>Id</b></td>
                <td><b>Valor total da venda</b></td>
                <td><b>Desconto</b></td>
                <td><b>Cliente</b></td>
                <td><b>Data da Venda</b></td>
                <td><b>Editar</b></td>
                <td><b>Excluir</b></td>
                <td><b>Recibo</b></td>
            </tr> 

        <?php
            $pdo = Conexao::getInstance();

            if($busca == 1){
                $consulta = $pdo->query("SELECT * FROM Venda, Cliente
                                        WHERE v_idVenda LIKE '$procurar%' 
                                        AND c_idCliente = v_c_idCliente
                                        ORDER BY v_idVenda");}

            else if($busca == 2){
                $consulta = $pdo->query("SELECT * FROM Venda, Cliente
                                        WHERE v_valor_total_venda LIKE '$procurar%' 
                                        AND c_idCliente = v_c_idCliente
                                        ORDER BY v_valor_total_venda");}

            else if($busca == 3){
                $consulta = $pdo->query("SELECT * FROM Venda, Cliente 
                                        WHERE c_nome LIKE '$procurar%'
                                        AND c_idCliente = v_c_idCliente
                                        ORDER BY c_nome");}

            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
        ?>
        <tr><td><?php echo $linha['v_idVenda'];?></td>
            <td><?php echo number_format ($linha['v_valor_total_venda'], 2, ',', '.');?></td>
            <td><?php echo number_format ($linha['v_desconto'], 2, ',', '.');?></td>
            <td><?php echo $linha['c_nome'];?></td>
            <td><?php echo $linha['iv_data_venda'];?></td>
            <td><a href='cadVenda.php?acao=editar&v_idVenda=<?php echo $linha['v_idVenda'];?>'> <img src="img/edit.png" style="width: 1.8vw;"></a></td>
            <td><?php echo " <a href=javascript:excluir('acaoVenda.php?acao=excluir&v_idVenda={$linha['v_idVenda']}')>";?><img src="img/delete.png" style="width: 1.5vw;"></a></td>
            <td><a href='reciboVenda.php?acao=listarVenda&v_idVenda=<?php echo $linha['v_idVenda'];?>'> <img src="img/cobrar.png" style="width: 1.8vw;"></a></td>
        </tr>

        <?php } ?>
            
            </table>

            <hr>
            <?php

            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>