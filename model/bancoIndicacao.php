<?php



require_once("init.php");



class BancoIndicacao

{



    protected $mysqli;

    public $total;

    public $limit = 100;

    public $pages;

    public $page;

    public $start;

    public $offset = 0;

    public $end;



    public function __construct()

    {

        $this->conexao();

    }



    private function conexao()

    {

        $this->mysqli = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO);



        if ($this->mysqli->connect_error) {

            die("Connection failed: " . $this->mysqli->connect_error);

        }

    }

    public function setIndicacao($id, $data, $razao, $fantasia, $contato, $documento, $telefone, $celular, $email, $site, $tipo, $modalidade, $integracao, $idrevenda, $status, $idpromotor) {       


        $sql = "INSERT INTO mi_indicacao (Idindicacao, Datacriacao, Razaosocial, Nomefantasia, Nomecontato, Cnpjcpf, Telefone, Celular, Email, Site, Tipoproduto, Modalidadeproduto, Integracaoproduto, Idrevenda, Status, Idpromotor)
                                  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->mysqli->prepare($sql); 
        $stmt->bind_param("issssssssssssisi", $id, $data, $razao, $fantasia, $contato, $documento, $telefone, $celular, $email, $site, $tipo, $modalidade, $integracao, $idrevenda, $status, $idpromotor);
        
        if ($stmt->execute() == TRUE) {

            return true;

        } else {

            return false;

        }

    }  

    public function setAcompanhamento($idindicacao, $dataindicacao) { 
        
        $seq = 1;

        $sql = "INSERT INTO mi_acompanhamento (Idindicacao, Dataindicacao) VALUES (?,?)";
        $stmt = $this->mysqli->prepare($sql); 
        $stmt->bind_param("is", $idindicacao, $dataindicacao);
        
        if ($stmt->execute() == TRUE) {

            return true;

        } else {

            return false;

        }
    } 

    public function getIndicacao($idindicacao)

    {

        //$promotor = $_SESSION['usuarioId'];        

        $result = $this->mysqli->query("SELECT ind.Idindicacao, ind.Datacriacao, ind.Razaosocial, ind.Nomefantasia, ind.Nomecontato, ind.Cnpjcpf, ind.Telefone, ind.Celular, ind.Email, ind.Site,
                                               ind.Tipoproduto, ind.Modalidadeproduto, ind.Integracaoproduto, ind.Idrevenda, ind.Status, ind.Idpromotor
                                        FROM mi_indicacao ind                                        
                                        WHERE ind.Idindicacao = $idindicacao
                                     ");

        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

            $array[] = $row;

        }

        return $array;

    }

    public function getAcompanhamento($idindicacao)

    {

        //$promotor = $_SESSION['usuarioId'];        

        $result = $this->mysqli->query("SELECT aco.Idindicacao, aco.Dataindicacao, aco.Datacontato, aco.Flapresentacao, aco.Dataproposta, aco.Flfechado, aco.Flinteresse, aco.Motivointeresse,
                                               aco.Dataapresentacao, aco.Flinteresseapr, aco.Motivoapresentacao, aco.Motivofechado, ind.Razaosocial, ind.Nomefantasia, ind.Nomecontato, ind.Cnpjcpf, 
                                               ind.Telefone, ind.Celular, ind.Email, ind.Site, ind.Tipoproduto, ind.Modalidadeproduto, ind.Integracaoproduto, ind.Idrevenda, ind.Status, ind.Idpromotor
                                        FROM mi_acompanhamento aco
                                        JOIN mi_indicacao ind ON (ind.Idindicacao = aco.Idindicacao)                                        
                                        WHERE aco.Idindicacao = $idindicacao
                                     ");

        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

            $array[] = $row;

        }

        return $array;

    }

    public function getPromotor($idpromotor)

    {

        $result = $this->mysqli->query("SELECT p.Id, p.Nome, p.Email, p.Telefone
                                        FROM mi_promotor p
                                     ");

        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

            $array[] = $row;

        }

        return $array;

    }

    public function getEmailEnvia($tipo)    {

        $result = $this->mysqli->query("SELECT * FROM mi_emailenvio WHERE Ativo = 1 AND Tipo = '$tipo'");

        $row = $result->fetch_array(MYSQLI_ASSOC);

        return $row;    

    }


    public function getEmailRecebe($tipo)

    {

        $result = $this->mysqli->query("SELECT Email FROM mi_emailrecebe WHERE Ativo = 1 AND Tipo = '$tipo'");

        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

            $array[] = $row;

        }

        return $array;

    }
    
    public function updtAcompanhamento($id, $datacontato, $flapresentacao, $dataproposta, $flfechado, $flinteresse, $motivointeresse, $dataapresentacao, $flinteresseapr, $motivoapresentacao, $motivofechado)

    {

        $stmt = $this->mysqli->prepare("UPDATE mi_acompanhamento SET 
                                         Datacontato = ?,
                                         Flapresentacao = ?, 
                                         Dataproposta = ?,
                                         Flfechado = ?,
                                         Flinteresse = ?,
                                         Motivointeresse = ?,
                                         Dataapresentacao = ?,
                                         Flinteresseapr = ?,
                                         Motivoapresentacao = ?,
                                         Motivofechado = ?   
                                        WHERE Idindicacao = ?");

        $stmt->bind_param("ssssssssssi", $datacontato, $flapresentacao, $dataproposta, $flfechado, $flinteresse, $motivointeresse, $dataapresentacao, $flinteresseapr, $motivoapresentacao, $motivofechado, $id);



        if ($stmt->execute() == TRUE) {

            return true;

        } else {

            return false;

        }

    }

    

    // public function getAtivacao($idativacao)

    // {

    //     $mascara = $_SESSION['usuarioMascara'];

    //     $result = $this->mysqli->query("SELECT atv.Id as Idativacao, atv.Idcliente, atv.Idusuario, atv.Status, atv.Statusemail, atv.Datacriacao, atv.Dataatualizacao, 
    //                                            cli.Id as Idcliente, cli.Nomefantasia, cli.Razaosocial, cli.Cnpjcpf, cli.Email, cli.Telefone, cli.Celular, cli.Endereco,
    //                                            cli.Cep, cli.Bairro, cli.Complemento, cli.Cidade, cli.Idestado, cli.Idpais, cli.Iddistribuidor, cli.Ativo, cli.NomeContato
    //                                     FROM mi_ativacao atv
    //                                     JOIN mi_ativacao_produto atp ON (atp.Idativacao = atv.Id)
    //                                     JOIN mi_produto p ON (p.Id = atp.Idproduto)
    //                                     JOIN mi_produto_modalidade pm ON (pm.Id = atp.Idmodalidade)
    //                                     JOIN cd_cliente cli ON (cli.Id = atv.Idcliente)
    //                                     JOIN cd_usuario usu ON (usu.Id = atv.Idusuario)
    //                                     WHERE atv.Id = $idativacao
    //                                     AND coalesce(usu.mascara, '') like '$mascara%'
    //                                       ");

    //     while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //         $array[] = $row;

    //     }

    //     return $array;

    // }

    // public function getAtivacaoProduto($idativacao)

    // {

    //     // $mascara = $_SESSION['usuarioMascara'];

    //     $result = $this->mysqli->query("SELECT atp.Id, p.Descricao as produto, pm.Descricao as modalidade, atp.Chave, p.PDF, p.Id as Idproduto, pm.Id as Idmodalidade 
    //                                     FROM mi_ativacao_produto atp
    //                                     JOIN mi_produto p ON (p.Id = atp.Idproduto)
    //                                     JOIN mi_produto_modalidade pm ON (pm.Id = atp.Idmodalidade)
    //                                     WHERE atp.Idativacao = $idativacao
    //                                 ");

    //     while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //         $array[] = $row;

    //     }

    //     return $array;

    // }

    // public function getClienteAtivacao($idativacao)

    // {       

    //     $result = $this->mysqli->query("SELECT cli.*, est.Nome as Estado, pai.Nome as Pais
    //                                     FROM mi_ativacao atv
    //                                     JOIN cd_cliente cli ON (cli.Id = atv.Idcliente)
    //                                     JOIN cd_estado est ON (est.Id = cli.Idestado)
    //                                     JOIN cd_pais pai ON (pai.Id = cli.Idpais)
    //                                     WHERE atv.Id = $idativacao
    //                                 ");

    //     while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //         $array[] = $row;

    //     }

    //     return $array;

    // }

    // public function getEmail($tipo)    {

    //     $result = $this->mysqli->query("SELECT * FROM mi_emailenvio WHERE Ativo = 1 AND Tipo = '$tipo'");

    //     $row = $result->fetch_array(MYSQLI_ASSOC);

    //     return $row;    

    // }

    // public function getEmailRecebe($tipo)

    // {

    //     $result = $this->mysqli->query("SELECT Email FROM mi_emailrecebe WHERE Ativo = 1 AND Tipo = '$tipo'");

    //     while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //         $array[] = $row;

    //     }

    //     return $array;

    // }

    // public function getUsuario($idativacao)    {

    //     $result = $this->mysqli->query("SELECT usu.Nome as Usuario, dis.Distribuidor, dis.Cidade, dis.UF, usu.Email
    //                                     FROM mi_ativacao atv
    //                                     JOIN cd_usuario usu ON (usu.Id = atv.Idusuario)
    //                                     JOIN cd_distribuidor dis ON (dis.Id = usu.DistribuidorId)                                        
    //                                     WHERE atv.Id = $idativacao");

    //     while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //         $array[] = $row;

    //     }

    //     return $array;  

    // }

    // public function cancelaAtivacao($id)

    // {

    //     $stmt = $this->mysqli->prepare("UPDATE mi_ativacao SET Status = 4, Dataatualizacao = Now() WHERE Id = ?");

    //     $stmt->bind_param("i", $id);


    //     if ($stmt->execute() == TRUE) {

    //         return true;

    //     } else {

    //         return false;

    //     }

    // }

    // public function reenviaEmail($id)

    // {

    //     $stmt = $this->mysqli->prepare("UPDATE mi_ativacao SET Statusemail = 1 WHERE Id = ?");

    //     $stmt->bind_param("i", $id);


    //     if ($stmt->execute() == TRUE) {

    //         return true;

    //     } else {

    //         return false;

    //     }

    // }

    public function pesquisaClienteIndicacao($cliente, $data, $status)

    {

        //$mascara = $_SESSION['usuarioMascara'];

        $totalItens = 0;

        if (empty($status)) {

            $status = -1;

        }

        if (empty($data)) {

            $data = -1;

        }



        $filtro = " FROM mi_indicacao
                                      
                                            JOIN mi_promotor ON (mi_promotor.Id = mi_indicacao.Idpromotor)

                                            WHERE coalesce(mi_indicacao.Razaosocial, '') like '%$cliente%'                                               

                                               AND ((mi_indicacao.Datacriacao = '$data') or ('$data' = '-1'))

                                               AND ((mi_indicacao.Status = '$status') or ('$status' = '-1'))

                                            ORDER BY mi_indicacao.Idindicacao desc";



        $sqlConta = "SELECT COUNT(*) conta " . $filtro;



        $sqlConsulta = "SELECT 
                                mi_indicacao.Idindicacao, mi_indicacao.Datacriacao, mi_indicacao.Razaosocial, mi_indicacao.Tipoproduto, mi_indicacao.Modalidadeproduto, mi_indicacao.Integracaoproduto, 
                            
                                CASE mi_indicacao.Status WHEN 1 THEN 'Contato com o cliente realizado' WHEN 2 THEN 'Implantação Agendada' WHEN 3 THEN 'Implantação Finalizada' WHEN 4 THEN 'Solicitação Cancelada' else 'Indicação Recebida' END AS StatusDescricao,
                                mi_promotor.Id as Idpromotor, mi_promotor.Nome as Promotor"

                                                   . $filtro

                                                   . " LIMIT $this->limit OFFSET $this->offset ";



        $totalItens = $this->mysqli->query($sqlConta)->fetch_object()->conta;

        

        $this->setPaginacao($totalItens);



        $result = $this->mysqli->query($sqlConsulta);



        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

            $array[] = $row;

        }





        return $array;

    }

    // public function updtAtivacao($id, $idcliente, $idusuario, $status, $statusemail)

    // {

    //     $stmt = $this->mysqli->prepare("UPDATE mi_ativacao SET IdCliente = ? WHERE Id = ?");

    //     $stmt->bind_param("ii", $idcliente, $id);


    //     if ($stmt->execute() == TRUE) {

    //         return true;

    //     } else {

    //         return false;

    //     }

    // }

    // public function updtAtivacaoProduto($id, $idativacao, $idproduto, $idmodalidade, $chave)

    // {

    //     $stmt = $this->mysqli->prepare("UPDATE mi_ativacao_produto SET Idproduto = ?, Idmodalidade = ?, Chave = ? WHERE Id = ?");

    //     $stmt->bind_param("iisi", $idproduto, $idmodalidade, $chave, $id);


    //     if ($stmt->execute() == TRUE) {

    //         return true;

    //     } else {

    //         return false;

    //     }

    // }





    // public function updateStatusEmailEntrega($id, $status)

    // {

    //     $stmt = $this->mysqli->prepare("update cd_entrega

    //                                        set StatusEmail = ?

    //                                     where Id = ?");

    //     $stmt->bind_param("ii", $status, $id);



    //     if ($stmt->execute() == TRUE) {

    //         return true;

    //     } else {

    //         return false;

    //     }

    // }



    // public function pesquisaClienteEnvioEmail($codigo)

    // {

    //     $result = $this->mysqli->query("SELECT ent.Email as destinatario, ent.Nomefantasia as contato, ent.Razaosocial as cliente, ent.status, ent.IdOrcamento as pedido, ent.ResponsavelEntrega as responsavel		

    //                                     FROM cd_entrega ent                                        

    //                                     WHERE ent.Id = $codigo");

    //     while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //         $array[] = $row;

    //     }

    //     return $array;                                 

    // }



    // public function pesquisaClienteDados($codigo)

    // {

    //     $result = $this->mysqli->query("SELECT ent.*, pai.Nome as pais, est.Nome as estado, usu.Nome as usuario, dis.Distribuidor as distribuidor, dis.Cidade as distcidade, dis.UF as distestado

    //                                     FROM cd_entrega ent 

    //                                     LEFT OUTER JOIN cd_pais pai ON (pai.Id = ent.IdPais)

    //                                     LEFT OUTER JOIN cd_estado est ON (est.Id = ent.IdEstado)

    //                                     LEFT OUTER JOIN cd_usuario usu ON (usu.Id = ent.IdUsuario)

    //                                     LEFT OUTER JOIN cd_distribuidor dis ON (dis.Id = usu.DistribuidorId)                                        

    //                                     WHERE ent.Id = $codigo");

    //     while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //         $array[] = $row;

    //     }

    //     return $array;                                 

    // }



    // public function pesquisaItensEntrega($codigo)

    // {

    //     $result = $this->mysqli->query("SELECT pd.Descricao as produto, pc.Descricao as condicao, ei.Qtde

    //                                     FROM al_produto pd

    //                                     LEFT OUTER JOIN cd_entrega_item ei ON (ei.ProdutoId = pd.Id)

    //                                     LEFT OUTER JOIN al_prodcondicao pc ON (pc.Id = ei.Condicao)

    //                                     WHERE ei.EntregaId = $codigo");

    //     while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //         $array[] = $row;

    //     }

    //     return $array;                                 

    // }

    

    // public function getEntrega()

    // {

    //     $mascara = $_SESSION['usuarioMascara'];

    //     $result = $this->mysqli->query("SELECT cd_entrega.Id, IdCliente, Nomefantasia, Razaosocial, Cnpjcpf, Inscestadual, cd_entrega.Email, Emailvalida, 

    //                                            cd_entrega.Telefone, Celular, Endereco, Cep, Bairro, Complemento, Cidade, IdEstado, cd_entrega.IdPais,

    //                                            IdOrcamento, ResponsavelEntrega, Observacao, Status, StatusEmail, DataCriacao, cd_usuario.Nome as Vendedor 

    //                                       FROM cd_entrega

    //                                       LEFT OUTER join cd_estado on (cd_entrega.IdEstado = cd_estado.Id)

    //                                       LEFT OUTER join cd_usuario on (cd_entrega.IdUsuario = cd_usuario.Id)

    //                                      WHERE coalesce(cd_usuario.mascara, '') like '$mascara%' 

    //                                       ");

    //     while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //         $array[] = $row;

    //     }

    //     return $array;

    // }



    // public function getEntregaId($seq)

    // {

    //     //  $mascara = $_SESSION['usuarioMascara'];

    //     $result = $this->mysqli->query("SELECT cd_entrega.Id, IdCliente, IdUsuario, Nomefantasia, Razaosocial, Cnpjcpf, Inscestadual, cd_entrega.Email, Emailvalida, 

    //                                            cd_entrega.Telefone, Celular, Endereco, Cep, Bairro, Complemento, Cidade, IdEstado, cd_estado.Nome as Estado, 

    //                                            cd_entrega.IdPais, cd_pais.nome as Pais,

    //                                            IdOrcamento, ResponsavelEntrega, Observacao, Status, StatusEmail, DataCriacao, cd_usuario.Nome as Vendedor 

    //                                       FROM cd_entrega

    //                                       LEFT OUTER join cd_estado on (cd_entrega.IdEstado = cd_estado.Id)

    //                                       LEFT OUTER join cd_usuario on (cd_entrega.IdUsuario = cd_usuario.Id)

    //                                       LEFT OUTER join cd_pais on (cd_entrega.IdPais = cd_pais.Id)

    //                                      WHERE cd_entrega.Id = '$seq' ");

    //     //AND coalesce(cd_usuario.mascara, '') like '$mascara%' ");

    //     while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //         $array[] = $row;

    //     }

    //     return $array;

    // }



    // public function getPergResp($EntregaId)

    // {

    //     $result = $this->mysqli->query("SELECT pf.Descricao as Pergunta, po.Descricao as Resposta

    //                                     FROM cd_resposta_formulario rf

    //                                     JOIN cd_pergunta_opcoes po ON (po.PerguntaOpcaoId = rf.PerguntaOpcaoId)

    //                                     JOIN cd_pergunta_formulario pf ON (pf.PerguntaId = po.PerguntaId)

    //                                     WHERE rf.EntregaId = '$EntregaId'");

    //                     while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //                         $array[] = $row;

    //                     }

    //                     return $array;

    // }



    // public function deleteEntrega($id)

    // {

    //     if ($this->mysqli->query("DELETE FROM cd_entrega_item WHERE EntregaId = '" . $id . "';") == TRUE) {

    //         if ($this->mysqli->query("DELETE FROM cd_entrega WHERE Id = '" . $id . "';") == TRUE) {

    //             return true;

    //         } else {

    //             return false;

    //         }

    //     } else {

    //         return false;

    //     }

    // }





    public function setPaginacao($totalItens = -1)

    {

        try {

            //Total de itens na tabela

            if ($totalItens > -1) {

                $this->total = $totalItens;

                //$this->total = $this->mysqli->query("SELECT COUNT(*) conta FROM mi_ativacao")->fetch_object()->conta;

            } else {

                $this->total = $this->mysqli->query("SELECT COUNT(*) conta FROM mi_ativacao")->fetch_object()->conta;

            }



            //Itens listados por pagina

            $this->limit = 10;

            //total de paginas

            $this->pages = ceil($this->total / $this->limit);

            // pagina atual

            $this->page = min($this->pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(

                'options' => array(

                    'default'   => 1,

                    'min_range' => 1,

                ),

            )));

            // offset da query

            $this->offset = ($this->page - 1)  * $this->limit;

            // informacao para o usuario

            $this->start = $this->offset + 1;

            $this->end = min(($this->offset + $this->limit), $this->total);



            /*

            // link de voltar

            $prevlink = ($this->page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($this->page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';



            // link de avancar

            $nextlink = ($this->page < $this->pages) ? '<a href="?page=' . ($this->page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $this->pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';



            // informacoes das paginas

            echo '<div id="paging"><p>', $prevlink, ' Page ', $this->page, ' of ', $this->pages, ' pages, displaying ', $this->start, '-', $this->end, ' of ', $this->total, ' results ', $nextlink, ' </p></div>';

            */

        } catch (Exception $e) {

            echo '<p>', $e->getMessage(), '</p>';

        }

    }



    function getPaginationLinks($current_page, $total_pages, $url)

    {

        $links = "";

        

        if ($total_pages == 1) {

            return $links;

        }



        $prevlink = ($this->page > 1) ?

            '<li class="page-item"><a class="page-link" href="?page=' . ($this->page - 1) . '"><img src="../../public/svgs/left-arrow-cinza.png" width="16px"></a></li>' :

            // '<a href="?page=' . ($this->page - 1) . '" title="Previous page">&lsaquo;</a>' :

            '<li class="page-item"><a class="page-link" href="?page=' . ($this->page - 1) . '"><img src="../../public/svgs/left-arrow-cinza.png" width="16px"></a></li>';

        //'<span class="disabled">&lsaquo;</span>';



        $nextlink = ($this->page < $this->pages) ?

            '<li class="page-item"><a class="page-link" href="?page=' . ($this->page + 1) . '"><img src="../../public/svgs/right-arrow-cinza.png" width="16px"></a></li>' :

            //'<a href="?page=' . ($this->page + 1) . '" title="Next page">&rsaquo;</a> ' :

            '<li class="page-item"><a class="page-link" href="?page=' . ($this->page + 1) . '"><img src="../../public/svgs/right-arrow-cinza.png" width="16px"></a></li>';

        //'<span class="disabled">&rsaquo;</span>';



        $iniLista = '<nav aria-label="navegacao">

                        <ul class="pagination pagination-lg float-right">	';



        $links .= $iniLista;



        $links .= $prevlink;



        if ($total_pages >= 1 && $current_page <= $total_pages) {



            //$links .= "<a class='page-link' href=\"{$url}?page=1\">1</a>";

            ($current_page == 1) ?

                $links .= "<li class=\"page-item active\"><a class=\"page-link\" href=\"{$url}?page=1\">1</a></li>" :

                $links .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}?page=1\">1</a></li>";



            $i = max(2, $current_page - 5);



            if ($i > 2) //$links .= " ... ";

                $links .= "<li class=\"page-item\"><a class=\"page-link\" href=\"\">...</a></li>";



            for (; $i < min($current_page + 6, $total_pages); $i++) { //$links .= "<a href=\"{$url}?page={$i}\">{$i}</a>";

                ($current_page == $i) ?

                    $links .= "<li class=\"page-item active\"><a class=\"page-link\" href=\"{$url}?page={$i}\">{$i}</a></li>" :

                    $links .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}?page={$i}\">{$i}</a></li>";

            }

            if ($i != $total_pages) //$links .= " ... ";

                $links .= "<li class=\"page-item\"><a class=\"page-link\" href=\"\">...</a></li>";



            //$links .= "<a href=\"{$url}?page={$total_pages}\">{$total_pages}</a>";

            ($current_page == $total_pages) ?

                $links .= "<li class=\"page-item active\"><a class=\"page-link\" href=\"{$url}?page={$total_pages}\">{$total_pages}</a></li>" :

                $links .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}?page={$total_pages}\">{$total_pages}</a></li>";

        }



        $links .= $nextlink;



        $fimLista = '</ul>

                </nav>';



        $links .= $fimLista;



        return $links;

    }





    // public function pesquisaClienteEntregaVisualizar($cliente, $data, $status)

    // {

    //     $mascara = $_SESSION['usuarioMascara'];

    //     if ($status > -1) {

    //         $result = $this->mysqli->query("SELECT cd_entrega.Id, IdCliente, Nomefantasia, Razaosocial, Cnpjcpf, Inscestadual, cd_entrega.Email, Emailvalida, 

	// 											   cd_entrega.Telefone, Celular, Endereco, Cep, Bairro, Complemento, Cidade, IdEstado, IdPais,

	// 											   IdOrcamento, ResponsavelEntrega, Observacao, Status, StatusEmail, DataCriacao, cd_usuario.Nome as Vendedor,

	// 											   cd_estado.Nome as Estado, cd_pais.nome as Pais, cd_entrega_item.ProdutoId, cd_entrega_item.Condicao, cd_entrega_item.Qtde,

	// 											   al_produto.Id as Idproduto, al_produto.Descricao as Produto, al_prodmodelo.Descricao as Modelo, al_prodcondicao.Descricao as Condicao	

	// 										  FROM cd_entrega

	// 										  LEFT OUTER join cd_estado on (cd_entrega.IdEstado = cd_estado.Id)

	// 										  LEFT OUTER join cd_usuario on (cd_entrega.IdUsuario = cd_usuario.Id)

	// 										  LEFT OUTER join cd_pais on (cd_entrega.Idpais = cd_pais.Id)

	// 										  LEFT OUTER join cd_entrega_item on (cd_entrega.Id = cd_entrega_item.EntregaId)                                              

    //                                           LEFT OUTER JOIN al_produto on (ei.ProdutoId = al_produto.Id)

	// 										  LEFT OUTER join al_prodmodelo on (al_produto.Idmodelo = al_prodmodelo.Id)

	// 										  LEFT OUTER join al_prodcondicao on (cd_entrega_item.Condicao = al_prodcondicao.Id)

    //                                           WHERE coalesce(Nomefantasia, '') like '%$cliente%'

    //                                             AND coalesce(cd_usuario.mascara, '') like '$mascara%' 

    //                                             AND StatusEmail = $status");

    //         while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //             $array[] = $row;

    //         }

    //         return $array;

    //     } else 

    //     if (empty($data)) {

    //         $result = $this->mysqli->query("SELECT cd_entrega.Id, IdCliente, Nomefantasia, Razaosocial, Cnpjcpf, Inscestadual, cd_entrega.Email, Emailvalida, 

	// 											   cd_entrega.Telefone, Celular, Endereco, Cep, Bairro, Complemento, Cidade, IdEstado, IdPais,

	// 											   IdOrcamento, ResponsavelEntrega, Observacao, Status, StatusEmail, DataCriacao, cd_usuario.Nome as Vendedor,

	// 											   cd_estado.Nome as Estado, cd_pais.nome as Pais, cd_entrega_item.ProdutoId, cd_entrega_item.Condicao, cd_entrega_item.Qtde,

	// 											   al_produto.Id as Idproduto, al_produto.Descricao as Produto, al_prodmodelo.Descricao as Modelo, al_prodcondicao.Descricao as Condicao	

	// 										  FROM cd_entrega

	// 										  LEFT OUTER join cd_estado on (cd_entrega.IdEstado = cd_estado.Id)

	// 										  LEFT OUTER join cd_usuario on (cd_entrega.IdUsuario = cd_usuario.Id)

	// 										  LEFT OUTER join cd_pais on (cd_entrega.Idpais = cd_pais.Id)

	// 										  LEFT OUTER join cd_entrega_item on (cd_entrega.Id = cd_entrega_item.EntregaId)                                              

    //                                           LEFT OUTER JOIN al_produto on (ei.ProdutoId = al_produto.Id)

	// 										  LEFT OUTER join al_prodmodelo on (al_produto.Idmodelo = al_prodmodelo.Id)

	// 										  LEFT OUTER join al_prodcondicao on (cd_entrega_item.Condicao = al_prodcondicao.Id)

    //                                           WHERE coalesce(Nomefantasia, '') like '%$cliente%'

    //                                             AND coalesce(cd_usuario.mascara, '') like '$mascara%' ");

    //         while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //             $array[] = $row;

    //         }

    //         return $array;

    //     } else {

    //         $result = $this->mysqli->query("SELECT cd_entrega.Id, IdCliente, Nomefantasia, Razaosocial, Cnpjcpf, Inscestadual, cd_entrega.Email, Emailvalida, 

	// 											   cd_entrega.Telefone, Celular, Endereco, Cep, Bairro, Complemento, Cidade, IdEstado, IdPais,

	// 											   IdOrcamento, ResponsavelEntrega, Observacao, Status, StatusEmail, DataCriacao, cd_usuario.Nome as Vendedor,

	// 											   cd_estado.Nome as Estado, cd_pais.nome as Pais, cd_entrega_item.ProdutoId, cd_entrega_item.Condicao, cd_entrega_item.Qtde,

	// 											   al_produto.Id as Idproduto, al_produto.Descricao as Produto, al_prodmodelo.Descricao as Modelo, al_prodcondicao.Descricao as Condicao	

	// 										  FROM cd_entrega

	// 										  LEFT OUTER join cd_estado on (cd_entrega.IdEstado = cd_estado.Id)

	// 										  LEFT OUTER join cd_usuario on (cd_entrega.IdUsuario = cd_usuario.Id)

	// 										  LEFT OUTER join cd_pais on (cd_entrega.Idpais = cd_pais.Id)

	// 										  LEFT OUTER join cd_entrega_item on (cd_entrega.Id = cd_entrega_item.EntregaId)

	// 										  LEFT OUTER JOIN al_produto on (cd_entrega_item.ProdutoId = al_produto.Id)

	// 										  LEFT OUTER join al_prodmodelo on (al_produto.Idmodelo = al_prodmodelo.Id)

	// 										  LEFT OUTER join al_prodcondicao on (cd_entrega_item.Condicao = al_prodcondicao.Id)

    //                                           WHERE DataCriacao = '$data'

    //                                             AND coalesce(cd_usuario.mascara, '') like '$mascara%' ");

    //         while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //             $array[] = $row;

    //         }

    //         return $array;

    //     }

    // }    



    



    // public function updateEntrega($seq, $idcliente, $fantasia, $razao, $documento, $ie, $email, $Repitaemail, $telefone, $celular, $endereco, $CEP, $bairro, $complemento, $cidade, $estado, $pais, $idorcamento, $responsavel, $observacao, $status, $statusemail)

    // {

    //     $stmt = $this->mysqli->prepare("UPDATE cd_entrega SET IdCliente = ?, Nomefantasia = ?, Razaosocial =?, Cnpjcpf =?, Inscestadual =?, Email=?, Emailvalida = ?, 

    //                                                           Telefone = ?, Celular =?, Endereco =?, Cep =?, Bairro =?, Complemento =?, Cidade =?, Idestado =?, Idpais =?,

    //                                                           IdOrcamento = ?, ResponsavelEntrega = ?, Observacao = ?, Status = ?, StatusEmail = ? 

    //                                                           WHERE Id = ?");

    //     $stmt->bind_param("isssissiisssssiiissiii", $idcliente, $fantasia, $razao, $documento, $ie, $email, $Repitaemail, $telefone, $celular, $endereco, $CEP, $bairro, $complemento, $cidade, $estado, $pais, $idorcamento, $responsavel, $observacao, $status, $statusemail, $seq);



    //     if ($stmt->execute() == TRUE) {

    //         return true;

    //     } else {

    //         return false;

    //     }

    // }





    // public function updateEntregaEmailEnviado($EntregaId)

    // {

    //     $stmt = $this->mysqli->prepare("UPDATE cd_entrega 

    //                                        SET StatusEmail = 1

    //                                      WHERE Id = ?");

    //     $stmt->bind_param("i", $EntregaId);



    //     if ($stmt->execute() == TRUE) {

    //         return true;

    //     } else {

    //         return false;

    //     }

    // }





    // /* Itens */

    // public function getEntregaItem($ent)

    // {

    //     $result = $this->mysqli->query("SELECT ei.ItemId, ei.EntregaId, ei.ProdutoId, ei.Condicao, ei.Qtde,

    //                                            pr.Descricao, cond.Descricao as descCondicao

    //                                       FROM cd_entrega_item ei

    //                                       LEFT OUTER JOIN al_produto pr on (ei.ProdutoId = pr.Id)

    //                                       LEFT OUTER JOIN al_prodcondicao cond on (ei.Condicao = cond.Id)

    //                                      WHERE ei.ItemId = '$ent'");

    //     $array = null;

    //     while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //         $array[] = $row;

    //     }

    //     return $array;

    // }



    // public function getEntregaItens($ent)

    // {

    //     $result = $this->mysqli->query("SELECT ei.ItemId, ei.EntregaId, ei.ProdutoId, ei.Condicao, ei.Qtde,

    //                                            pr.Descricao, cond.Descricao as descCondicao

    //                                       FROM cd_entrega_item ei

    //                                       LEFT OUTER JOIN al_produto pr on (ei.ProdutoId = pr.Id)

    //                                       LEFT OUTER JOIN al_prodcondicao cond on (ei.Condicao = cond.Id)

    //                                      WHERE ei.EntregaId = '$ent'");

    //     $array = null;

    //     while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //         $array[] = $row;

    //     }

    //     return $array;

    // }



    // /*public function getEntregaItensManuais($ent)

    // {

    //     session_start();

    //     $idioma = $_SESSION['idiomaId'];



    //     $result = $this->mysqli->query("SELECT ei.ItemId, ei.EntregaId, ei.ProdutoId, ei.Condicao, ei.Qtde,

    //                                            pr.Descricao, cond.Descricao as descCondicao, man.Manual

    //                                       FROM cd_entrega_item ei

    //                                       LEFT OUTER JOIN al_produto pr on (ei.ProdutoId = pr.Id)                                          

    //                                       LEFT OUTER JOIN al_prodidioma idi on (ei.ProdutoId = idi.Id)

    //                                       LEFT OUTER JOIN al_prodcondicao cond on (ei.Condicao = cond.Id)

    //                                       LEFT OUTER JOIN al_prodmanual man on (idi.Idproduto = man.idproduto)

    //                                                                        and (idi.Ididioma = man.Ididioma)

    //                                      WHERE ei.EntregaId = '$ent'

    //                                        and man.Ididioma = $idioma");

    //     $array = null;

    //     while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //         $array[] = $row;

    //     }

    //     return $array;

    // }*/



    // public function getEntregaItensManuais($ent)

    // {

    //     /*session_start();

    //     $idioma = $_SESSION['idiomaId'];*/



    //     $result = $this->mysqli->query("SELECT man.post_name as Manual, man.guid as Link

    //                                     FROM cd_entrega_item ei

    //                                     LEFT OUTER JOIN al_produto pr on (ei.ProdutoId = pr.Id)                                          

    //                                     LEFT OUTER JOIN al_prodmanual man on (pr.Idproduto = man.idproduto)

    //                                     WHERE ei.EntregaId = '$ent'

    //                                     limit 1

    //                                     ");

    //     $array = null;

    //     while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //         $array[] = $row;

    //     }

    //     return $array;

    // }



    // public function getEntregaItensEspecificacao($ent)

    // {

    //     $result = $this->mysqli->query("SELECT esp.post_name as Especificacao

    //                                     FROM cd_entrega_item ei

    //                                     LEFT OUTER JOIN al_produto pr on (ei.ProdutoId = pr.Id)                                          

    //                                     LEFT OUTER JOIN al_prodespecificacao esp on (pr.Idproduto = esp.idproduto)

    //                                     WHERE ei.EntregaId = '$ent'");

    //     $array = null;

    //     while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //         $array[] = $row;

    //     }

    //     return $array;

    // }



    // public function getEntregaItensRequisitos($ent)

    // {

    //     $result = $this->mysqli->query("SELECT CONCAT(req.post_title,'.pdf') as Requisito

    //                                     FROM cd_entrega_item ei

    //                                     LEFT OUTER JOIN al_produto pr on (ei.ProdutoId = pr.Id)                                          

    //                                     LEFT OUTER JOIN al_prodrequisito req on (pr.Idproduto = req.idproduto)

    //                                     WHERE ei.EntregaId = '$ent'");

    //     $array = null;

    //     while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //         $array[] = $row;

    //     }

    //     return $array;

    // }



    // public function getEntregaItensCatalogo($ent)

    // {

    //     session_start();

    //     $idioma = $_SESSION['idiomaId'];



    //     $result = $this->mysqli->query("SELECT ei.ItemId, cat.Especificacao, cat.Catalago, cat.Requisitos

    //                                       FROM cd_entrega_item ei

    //                                       LEFT OUTER JOIN al_produto pr on (ei.ProdutoId = pr.Id)                                          

    //                                       LEFT OUTER JOIN al_prodcatalogo cat on (ei.ProdutoId = cat.Idproduto)

    //                                      WHERE ei.EntregaId = '$ent'

    //                                      and cat.Ididioma = $idioma");

    //     $array = null;

    //     while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //         $array[] = $row;

    //     }

    //     return $array;

    // }



    // public function setEntregaComItem($seq, $idcliente, $fantasia, $razao, $documento, $ie, $email, $Repitaemail, $telefone, $celular, $endereco, $CEP, $bairro, $complemento, $cidade, $estado, $pais, $idorcamento, $responsavel, $observacao, $status, $datacriacao, $statusemail, $usuario, $seq2, $entregaid, $produtoid, $condicao, $qtde)

    // {

    //     session_start();

    //     $usuario = $_SESSION['usuarioId'];

    //     $sql = $this->mysqli->query("select max(id) as maior from cd_entrega");

    //     $row = mysqli_fetch_array($sql);

    //     $seq = $row['maior'] + 1;

    //     $entregaid = $seq;



    //     $sql2 = "INSERT INTO cd_entrega(Id, IdCliente, Nomefantasia, Razaosocial, Cnpjcpf, Inscestadual, Email, Emailvalida, 

    //                                     Telefone, Celular, Endereco, Cep, Bairro, Complemento, Cidade, IdEstado, IdPais,

    //                                     IdOrcamento, ResponsavelEntrega, Observacao, Status, DataCriacao, StatusEmail, IdUsuario)

    //                   VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, Now(),?,?)";

    //     $stmt = $this->mysqli->prepare($sql2);

    //     $stmt->bind_param("iisssissiisssssiiissiii", $seq, $idcliente, $fantasia, $razao, $documento, $ie, $email, $Repitaemail, $telefone, $celular, $endereco, $CEP, $bairro, $complemento, $cidade, $estado, $pais, $idorcamento, $responsavel, $observacao, $status/*, $datacriacao*/, $statusemail, $usuario);



    //     if ($stmt->execute() == true) {

    //         if ($this->setEntregaItem($seq2, $entregaid, $produtoid, $condicao, $qtde)) {

    //             return $entregaid;

    //         } else {

    //             return 0;

    //         }

    //     } else {

    //         return 0;

    //     }

    // }



    // public function setEntregaItem($seq, $entregaid, $produtoid, $condicao, $qtde)

    // {



    //     $sql = $this->mysqli->query("select max(ItemId) as maior from cd_entrega_item");

    //     $row = mysqli_fetch_array($sql);

    //     $seq = $row['maior'] + 1;



    //     $sql2 = "INSERT INTO cd_entrega_item(ItemId, EntregaId, ProdutoId, Condicao, Qtde)

    //                   VALUES (?,?,?,?,?)";

    //     $stmt = $this->mysqli->prepare($sql2);

    //     $stmt->bind_param("iiiid", $seq, $entregaid, $produtoid, $condicao, $qtde);



    //     if ($stmt->execute() == TRUE) {

    //         return true;

    //     } else {

    //         return false;

    //     }

    // }



    // public function updateEntregaItem($seq, $entregaid, $produtoid, $condicao, $qtde)

    // {

    //     $stmt = $this->mysqli->prepare("UPDATE cd_entrega_item SET EntregaId = ?, ProdutoId = ?, Condicao = ?, Qtde = ?

    //                                      WHERE ItemId = ?");

    //     $stmt->bind_param("iiidi",  $entregaid, $produtoid, $condicao, $qtde, $seq);



    //     if ($stmt->execute() == TRUE) {

    //         return true;

    //     } else {

    //         return false;

    //     }

    // }



    // public function deleteEntregaItem($id)

    // {

    //     if ($this->mysqli->query("DELETE FROM cd_entrega_item WHERE ItemId = '" . $id . "';") == TRUE) {

    //         return true;

    //     } else {

    //         return false;

    //     }

    // }



    // public function cancelaEntrega($id)

    // {

    //     $stmt = $this->mysqli->prepare("UPDATE cd_entrega 

    //                                        SET Status = 2

    //                                      WHERE Id = ?");

    //     $stmt->bind_param("i", $id);



    //     if ($stmt->execute() == TRUE) {

    //         return true;

    //     } else {

    //         return false;

    //     }

    // }
    
    // public function getObsFormulario($codigo)    {

    //     $result = $this->mysqli->query("SELECT ObservacoesFormulario FROM cd_entrega WHERE Id = '$codigo'");

    //     $row = $result->fetch_array(MYSQLI_ASSOC);

    //     return $row;    

    // }

    

    // public function getPessoaContato($idcliente)    {

    //     $result = $this->mysqli->query("SELECT NomeContato FROM cd_cliente WHERE Id = '$idcliente'");

    //     $row = $result->fetch_array(MYSQLI_ASSOC);

    //     return $row;    

    // }

   

    // public function getEmail($tipo)    {

    //     $result = $this->mysqli->query("SELECT * FROM cd_emailenvio WHERE Ativo = 1 AND Tipo = '$tipo'");

    //     $row = $result->fetch_array(MYSQLI_ASSOC);

    //     return $row;    

    // }



    // public function getEmailRecebe($tipo)

    // {

    //     $result = $this->mysqli->query("SELECT Email FROM cd_emailrecebe WHERE Ativo = 1 AND Tipo = '$tipo'");

		

    //     $array = null;

    //     while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //         $array[] = $row;

    //     }

    //     return $array;

    // }

    // public function getStatus($codigo)    {

    //     $result = $this->mysqli->query("SELECT StatusEmail FROM cd_entrega WHERE Id = '$codigo'");

    //     $row = $result->fetch_array(MYSQLI_ASSOC);

    //     return $row;    

    // }

    

    // public function getPerguntas()

    // {

    //     $result = $this->mysqli->query("

    //         SELECT pf.PerguntaId, pf.Descricao 

    //           FROM cd_pergunta_formulario pf

    //          WHERE Ativo = 1

    //     ");

    //     while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

    //         $array[] = $row;

    //     }

    //     return $array;

    // }

    

}

