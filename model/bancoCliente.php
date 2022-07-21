<?php

require_once("init.php");

class BancoCliente
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

    public function setCliente($seq, $fantasia, $razao, $documento, $ie, $email, $Repitaemail, $telefone, $celular, $endereco, $CEP, $bairro, $complemento, $cidade, $estado, $pais, $contato)
    {
        session_start();
        $usuario = $_SESSION['usuarioId'];

        $sql = $this->mysqli->query("select max(id) as maior from cd_cliente");
        $row = mysqli_fetch_array($sql);
        $seq = $row['maior'] + 1;

        $sql2 = "INSERT INTO cd_cliente(Id, Nomefantasia, Razaosocial, Cnpjcpf, Inscestadual, Email, Emailvalida, Telefone, Celular, Endereco, Cep, Bairro, Complemento, Cidade, Idestado, Idpais, Iddistribuidor, NomeContato)
                      VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->mysqli->prepare($sql2);
        $stmt->bind_param("isssissiisssssiiss", $seq, $fantasia, $razao, $documento, $ie, $email, $Repitaemail, $telefone, $celular, $endereco, $CEP, $bairro, $complemento, $cidade, $estado, $pais, $usuario, $contato);

        if ($stmt->execute() == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function getCliente()
    {
        $mascara = $_SESSION['usuarioMascara'];
        $result = $this->mysqli->query("SELECT cd_cliente.Id, Nomefantasia, Razaosocial, Cnpjcpf, Inscestadual, Email, Emailvalida, Telefone, Celular, 
                                               Endereco, Cep, Bairro, Complemento, Cidade, Idestado, cd_estado.Sigla, cd_cliente.Idpais  
                                          FROM cd_cliente
                                          LEFT OUTER join cd_estado on (cd_cliente.Idestado = cd_estado.Id)
                                          LEFT OUTER join cd_usuario on (cd_cliente.Iddistribuidor = cd_usuario.Id)
                                         WHERE coalesce(cd_usuario.mascara, '') like '$mascara%' ");
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $row;
        }
        return $array;
    }

    public function getClienteId($seq)
    {
        $mascara = $_SESSION['usuarioMascara'];
        $result = $this->mysqli->query("SELECT cd_cliente.Id, Nomefantasia, Razaosocial, Cnpjcpf, Inscestadual, cd_cliente.Email, Emailvalida, cd_cliente.Telefone, Celular, 
                                               Endereco, Cep, Bairro, Complemento, Cidade, Idestado, cd_estado.Sigla, cd_estado.Nome as Estado, cd_cliente.Idpais, cd_pais.Nome as Pais, NomeContato 
                                          FROM cd_cliente
                                          LEFT OUTER join cd_estado on (cd_cliente.Idestado = cd_estado.Id)
										  LEFT OUTER join cd_pais on (cd_cliente.Idpais = cd_pais.Id)
                                          LEFT OUTER join cd_usuario on (cd_cliente.Iddistribuidor = cd_usuario.Id)
                                          WHERE coalesce(cd_usuario.mascara, '') like '$mascara%'
                                            AND cd_cliente.Id = '$seq'");
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $row;
        }
        return $array;
    }

    public function deleteCliente($id)
    {
        if ($this->mysqli->query("DELETE FROM cd_cliente WHERE Id = '" . $id . "';") == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function setPaginacao($totalItens = -1)
    {
        try {
            if ($totalItens > -1) {
                $this->total = $totalItens;
                //$this->total = $this->mysqli->query("SELECT COUNT(*) conta FROM cd_entrega")->fetch_object()->conta;
            } else {
                //Total de itens na tabela
                $this->total = $this->mysqli->query("SELECT COUNT(*) conta FROM cd_cliente")->fetch_object()->conta;
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
            '<li class="page-item"><a class="page-link" href="?page=' . ($this->page - 1) . '"><img src="../../public/svgs/left-arrow-cinza.png" width="16px"></a></li>';

        $nextlink = ($this->page < $this->pages) ?
            '<li class="page-item"><a class="page-link" href="?page=' . ($this->page + 1) . '"><img src="../../public/svgs/right-arrow-cinza.png" width="16px"></a></li>' :
            '<li class="page-item"><a class="page-link" href="?page=' . ($this->page + 1) . '"><img src="../../public/svgs/right-arrow-cinza.png" width="16px"></a></li>';

        $iniLista = '<nav aria-label="navegacao">
                        <ul class="pagination pagination-lg float-right">	';

        $links .= $iniLista;

        $links .= $prevlink;

        if ($total_pages >= 1 && $current_page <= $total_pages) {

            ($current_page == 1) ?
                $links .= "<li class=\"page-item active\"><a class=\"page-link\" href=\"{$url}?page=1\">1</a></li>" :
                $links .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}?page=1\">1</a></li>";

            $i = max(2, $current_page - 5);

            if ($i > 2)
                $links .= "<li class=\"page-item\"><a class=\"page-link\" href=\"\">...</a></li>";

            for (; $i < min($current_page + 6, $total_pages); $i++) {
                ($current_page == $i) ?
                    $links .= "<li class=\"page-item active\"><a class=\"page-link\" href=\"{$url}?page={$i}\">{$i}</a></li>" :
                    $links .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}?page={$i}\">{$i}</a></li>";
            }
            if ($i != $total_pages)
                $links .= "<li class=\"page-item\"><a class=\"page-link\" href=\"\">...</a></li>";

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

    public function pesquisaCliente($fantasia, $estado)
    {
        $mascara = $_SESSION['usuarioMascara'];

        $totalItens = 0;

        $filtro = " FROM cd_cliente
        LEFT OUTER join cd_estado on (cd_cliente.Idestado = cd_estado.Id) 
        LEFT OUTER join cd_usuario on (cd_cliente.Iddistribuidor = cd_usuario.Id)
        WHERE coalesce(cd_cliente.Nomefantasia, '') like '%$fantasia%'
          AND coalesce(cd_estado.Nome, '') like '%$estado%' 
          AND coalesce(cd_usuario.mascara, '') like '$mascara%'";

        $sqlConta = "SELECT COUNT(*) conta " . $filtro;

        $sqlConsulta = "SELECT cd_cliente.Id, Nomefantasia, Razaosocial, Cnpjcpf, Inscestadual, cd_cliente.Email, Emailvalida, cd_cliente.Telefone, Celular, 
                               Endereco, Cep, Bairro, Complemento, Cidade, Idestado, cd_estado.Sigla, cd_estado.Nome, cd_cliente.Idpais, cd_usuario.Nome as Vendedor 
                       "
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
    
    public function updateCliente($seq, $fantasia, $razao, $documento, $ie, $email, $Repitaemail, $telefone, $celular, $endereco, $CEP, $bairro, $complemento, $cidade, $estado, $pais, $contato)
    {
        $stmt = $this->mysqli->prepare("UPDATE cd_cliente SET Nomefantasia = ?, Razaosocial =?, Cnpjcpf =?, Inscestadual =?, Email=?, Emailvalida = ?, Telefone =?, Celular =?, Endereco =?, Cep =?, Bairro =?, Complemento =?, Cidade =?, Idestado =?, Idpais =?, NomeContato =? WHERE Id = ?");
        $stmt->bind_param("sssissiisssssiisi", $fantasia, $razao, $documento, $ie, $email, $Repitaemail, $telefone, $celular, $endereco, $CEP, $bairro, $complemento, $cidade, $estado, $pais, $contato, $seq);

        if ($stmt->execute() == TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
