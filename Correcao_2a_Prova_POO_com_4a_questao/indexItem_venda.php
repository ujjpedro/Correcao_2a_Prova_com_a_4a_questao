<!DOCTYPE html>
<?php
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    $title = "Relacionamento Item e Venda";
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
                    <h3 style="font-weight: bold">Procurar Item e venda</h3>
                        <input type="text" name="procurar" class="form-control" size="50"
                        placeholder="Insira a consulta" value="<?php echo $procurar;?>">
                    <br>
                
                    <div class="text-white">
                    <p>Ordenar e pesquisar por:</p>
                        <input type="radio" name="busca" value="1" class="form-check-input" <?php if ($busca == "1") echo "checked" ?>> <b>Venda</b><br>
                        <input type="radio" name="busca" value="2" class="form-check-input" <?php if ($busca == "2") echo "checked" ?>> <b>Livro</b><br>
                    <br>
                    </div>
                        <button type="submit" name="acao" id="acao" class="btn btn-outline-info">Buscar</button>
                    
                </div>
                <hr>
            </form>

            <table class="table table-striped" style="background-color: #FFF;">
            <tr><td><b>Id venda</b></td>
                <td><b>Livro</b></td>
                <td><b>Quantidade</b></td>
                <td><b>Valor total</b></td>
                <td><b>Editar</b></td>
                <td><b>Excluir</b></td>
            </tr> 

        <?php
            $pdo = Conexao::getInstance();

            if($busca == 1){
                $consulta = $pdo->query("SELECT * FROM Venda, Livro, Item_venda
                                        WHERE v_idVenda LIKE '$procurar%'
                                        AND iv_v_idVenda = v_idVenda
                                        AND iv_l_idLivro = l_idLivro
                                        ORDER BY v_idVenda");}

            else if($busca == 2){
                $consulta = $pdo->query("SELECT * FROM Venda, Livro, Item_venda
                                        WHERE l_titulo LIKE '$procurar%'
                                        AND iv_v_idVenda = v_idVenda
                                        AND iv_l_idLivro = l_idLivro
                                        ORDER BY l_titulo");}
        
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
        ?>
        <tr><td><?php echo $linha['v_idVenda'];?></td>
            <td><?php echo $linha['l_titulo'];?></td>
            <td><?php echo $linha['iv_quantidade'];?></td>
            <td><?php echo number_format ($linha['iv_valor_total_item'], 2, ',', '.');?></td>
            <td><a href='cadItem_venda.php?acao=editar&iv_v_idVenda=<?php echo $linha['iv_v_idVenda'];?>&iv_l_idLivro=<?php echo $linha['iv_l_idLivro'];?>'> <img src="img/edit.png" style="width: 1.8vw;"></a></td>
            <td><?php echo " <a href=javascript:excluir('acaoItem_venda.php?acao=excluir&iv_v_idVenda={$linha['iv_v_idVenda']}&iv_l_idLivro={$linha['iv_l_idLivro']}')>";?><img src="img/delete.png" style="width: 1.5vw;"></a></td>
        </tr>

        <?php } ?>
            
            </table>
        </div>
    </div>
    <script src="bootstrap/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>