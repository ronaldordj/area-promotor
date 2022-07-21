<?php
require_once("init.php");
class BancoUsuario
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

    public function setUsuario($seq, $nome, $email, $funcao, $telefone, $senha, $senhaValida, $ativo)
    {
        session_start();
        $usuario = $_SESSION['usuarioId'];
        $mascara = $_SESSION['usuarioMascara'];

        $sqlmask = $this->mysqli->query("select lpad(coalesce(max(SUBSTRING(cd_usuario.mascara, -3)), 0) + 1, 3, '0') as mascara
                                           from cd_usuario  
                                          where ((cd_usuario.CriadorId = '$usuario') or ((select coalesce(Mascara, '') FROM cd_usuario where id = '$usuario') = ''))");
        $rowmask = mysqli_fetch_array($sqlmask);
        if ($mascara > 0) {
            $novamask = $mascara . '.';
        } else {
            $novamask = '';
        }
        $novamask = $novamask . $rowmask['mascara'];


        $sqlusuario = $this->mysqli->query("select DistribuidorId
                                                   from cd_usuario  
                                                  where Id = $usuario");
        $rowusuario = mysqli_fetch_array($sqlusuario);
        $distribuidor = $rowusuario['DistribuidorId'];

        $sql = $this->mysqli->query("select max(Id) as maior from cd_usuario");
        $row = mysqli_fetch_array($sql);
        $seq = $row['maior'] + 1;

        $sql2 = "INSERT INTO cd_usuario(Id, Nome, Email, Funcao, Telefone, Senha, SenhaValida, Ativo, CriadorId, mascara, DistribuidorId)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql2);
        $stmt->bind_param("isssissiisi", $seq, $nome, $email, $funcao, $telefone, $senha, $senhaValida, $ativo, $usuario, $novamask, $distribuidor);


        if ($stmt->execute() == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function getUsuario()
    {
        $result = $this->mysqli->query("SELECT Id, Nome, Email, Funcao, Telefone, Senha, SenhaValida, Ativo, case Ativo when 1 then 'Ativo' else 'Inativo' end as Status FROM cd_usuario");
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $row;
        }
        return $array;
    }

    public function getUsuarioId($seq)
    {
        $result = $this->mysqli->query("SELECT Id, Nome, Email, Funcao, Telefone, Senha, SenhaValida, Ativo, case Ativo when 1 then 0 else 1 end as Inativo, Mascara FROM cd_usuario WHERE Id = '$seq'");
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $row;
        }
        return $array;
    }

    public function getConfigEmail($param)
    {
        $result = $this->mysqli->query("SELECT Id, smtp, porta, usuario, senha, seguranca, Idusuario
										FROM cf_emailenvio WHERE Idusuario = '$param'");
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $row;
        }
        return $array;
    }

    public function deleteUsuario($id)
    {
        if ($this->mysqli->query("DELETE FROM cd_usuario WHERE Id = '" . $id . "';") == TRUE) {
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
                $this->total = $this->mysqli->query("SELECT COUNT(*) conta FROM cd_usuario")->fetch_object()->conta;
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

    public function pesquisaUsuario($usuario, $email)
    {
        $mascara = $_SESSION['usuarioMascara'];

        $totalItens = 0;

        $filtro = "FROM cd_usuario 
        LEFT OUTER join cd_usuario criador on (cd_usuario.CriadorId = criador.Id)
         WHERE cd_usuario.Nome like '%$usuario%' 
         AND coalesce(cd_usuario.Email, '') like '%$email%'
         AND coalesce(cd_usuario.mascara, '') like '$mascara%' ";

         /*$filtro = "FROM cd_usuario 
         LEFT OUTER join cd_usuario criador on (cd_usuario.CriadorId = criador.Id)
          WHERE cd_usuario.mascara like '$mascara%'";*/

        $sqlConta = "SELECT COUNT(*) conta " . $filtro;

        $sqlConsulta = "SELECT cd_usuario.* 
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
    public function updateUsuario($seq, $nome, $email, $funcao, $telefone, $senha, $senhaValida, $ativo)
    {
        $stmt = $this->mysqli->prepare("UPDATE cd_usuario SET Nome = ?, Email =?, Funcao =?, Telefone =?, Senha=?, SenhaValida = ?, Ativo =?  WHERE Id = ?");
        $stmt->bind_param("sssissii", $nome, $email, $funcao, $telefone, $senha, $senhaValida, $ativo, $seq);
        if ($stmt->execute() == TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
