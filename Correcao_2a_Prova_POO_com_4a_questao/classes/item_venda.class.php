
<?php
    class Item_venda {
        private $iv_v_idVenda;
        private $iv_l_idLivro;
        private $iv_quantidade;
        private $iv_valor_total_item;

        public function __construct($idV, $idL, $quant, $total) {
            $this->setIdV($idV);
            $this->setIdL($idL);
            $this->setQuant($quant);
            $this->setTotal($total);
           
        }

        public function getIdV() {return $this->iv_v_idVenda;}

        public function getIdL() {return $this->iv_l_idLivro;}

        public function getQuant() {return $this->iv_quantidade;}

        public function getTotal() {return $this->iv_valor_total_item;}


        public function setIdL($idL) {
                return $this->iv_l_idLivro = $idL;
            }

        public function setIdV($idV) {
                return $this->iv_v_idVenda = $idV;
            }

        public function setQuant($quant) {
                return $this->iv_quantidade = $quant;
            }

        public function setTotal($total) {
                return $this->iv_valor_total_item = $total;
            }

 
            public function inserir() {
                $pdo = Conexao::getInstance();
                $stmt = $pdo->prepare('INSERT INTO `recuperacaoav01`.`Item_venda` (`iv_v_idVenda`, `iv_l_idLivro`, `iv_quantidade`, `iv_valor_total_item`) VALUES (:iv_v_idVenda, :iv_l_idLivro, :iv_quantidade, :iv_valor_total_item)');
                $stmt->bindValue(':iv_v_idVenda', $this->getIdV());
                $stmt->bindValue(':iv_l_idLivro', $this->getIdL());
                $stmt->bindValue(':iv_quantidade', $this->getQuant());
                $stmt->bindValue(':iv_valor_total_item', $this->getTotal());
                return $stmt->execute();
            
        }

        // public function editar($iv_v_idVenda, $iv_l_idLivro) {
        //     $pdo = Conexao::getInstance();
        //     $stmt = $pdo->prepare("UPDATE `Livro_Autor` SET `la_l_idLivro` = :la_l_idLivro, `la_a_idAutor` = :la_a_idAutor WHERE (`la_l_idLivro` = ':la_l_idLivro') and (`la_a_idAutor` = ':la_l_idLivro')");
        //     $stmt->bindValue(':la_l_idLivro', $this->setIdL($this->la_l_idLivro), PDO::PARAM_INT);
        //     $stmt->bindValue(':la_a_idAutor', $this->setIdA($this->la_a_idAutor), PDO::PARAM_STR);
        //     return $stmt->execute();
        // }

        public function excluir($iv_v_idVenda, $iv_l_idLivro){
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM Item_venda WHERE (iv_v_idVenda = :iv_v_idVenda) AND (iv_l_idLivro = :iv_l_idLivro)');
            $stmt->bindValue(':iv_v_idVenda', $iv_v_idVenda);
            $stmt->bindValue(':iv_l_idLivro', $iv_l_idLivro);
            return $stmt->execute();
        }

        // public function buscar($id){
        //     require_once("conf/Conexao.php");

        //     $conexao = Conexao::getInstance();

        //     $query = 'SELECT * FROM Cliente';
        //     if($id > 0){
        //         $query .= ' WHERE c_idCliente = :Id';
        //         $stmt->bindParam(':Id', $id);
        //     }
        //         $stmt = $conexao->prepare($query);
        //         if($stmt->execute())
        //             return $stmt->fetchAll();
        
        //         return false;

        // }

        // public function adcionarItem($iv_quantidade, $iv_valor_total_item){
        //     $pdo = Conexao::getInstance();
        //     $stmt = $pdo->prepare("UPDATE `livro` SET `iv_quantidade` = :iv_quantidade, iv_valor_total_item = :iv_valor_total_item WHERE (`a_idAutor` = :a_idAutor);");
        //     $stmt->bindValue(':iv_quantidade', $this->setNome($this->iv_quantidade), PDO::PARAM_STR);
        //     $stmt->bindValue(':a_sobrenome', $this->setSobrenome($this->a_sobrenome), PDO::PARAM_STR);
        //     return $stmt->execute();

        // }
    }

    ?>