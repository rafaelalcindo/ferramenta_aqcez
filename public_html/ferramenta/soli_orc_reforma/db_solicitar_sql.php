<?php

    require_once('../db_connection.php');

    class connection_solicitar{

        private $conexao;

        public function __construct(){
            $db_connection = new Db_connectio();
            $this->conexao = $db_connection->getConnection();
           // $this->conexao = new mysqli("localhost","root","","projeto_aqcez");
        }

        public function salvarSolicitacaoOrc($arraySoli){

        }

        public function getQuantSoli(){
            $sql_qnt_soli = sprintf("select count(*) as 'num_soli' from soli_orcamento");
            $resultadoQnt = $this->conexao->query($sql_qnt_soli);

            if($resultadoQnt){
                $row          = $resultadoQnt->fetch_assoc();
                $QntSoli      = (int) $row['num_soli'];
                return $QntSoli;
            }else{ return false; }
            
        }

        public function salvarSolicitacao($solicitacao){
            $resultado_query = gravarSolicitacao($this->conexao, $solicitacao);
            if($resultado_query){ return true; }else{ return false; }
        }

        public function getlistOrcamento(){
            $resuListOrc = getlistOrc($this->conexao);
            if($resuListOrc){ return $resuListOrc; }else{ return false; }
        }

        public function getEstado($estado){
            $resultadoEstado = getEstado($this->conexao ,$estado);
            if($resultadoEstado){ return $resultadoEstado; }else{ return false; }
        }

        public function getCidade($cidade){
            $resultadoCidade = getCidade($this->conexao, $cidade);
            if($resultadoCidade){ return $resultadoCidade; }else{ return false; }
        }

    }

    function gravarSolicitacao($conexao, $solicitar){
        date_default_timezone_set('America/Sao_Paulo');

        //echo $solicitar['tipo_reforma'];

        $data = date('Y-m-d');

        $sql_salvar_soli = sprintf("INSERT INTO soli_orcamento ( seg_soli_orc, precisa_soli_orc,  precisa_espe_soli_orc,path_foto_soli_orc, nece_soli_orc, nome_pessoa_soli_orc, nome_foto_soli_orc, emp_soli_orc, tel_soli_orc, cel_soli_orc, email_soli_orc,   estado_soli_orc, cidade_soli_orc, data_soli_orc, estru_soli_orc, area_soli_orc, quando_soli_orc, soli_tipo_reforma) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s','%s', '%s', '%s', '%s', '%s' ) ",
            $solicitar['seg'], $solicitar['pedido'], $solicitar['observ'], $solicitar['upload_path'], $solicitar['upload_name'], $solicitar['urgencia'], $solicitar['nome'], $solicitar['empresa'], $solicitar['telefone'], $solicitar['celular'], $solicitar['email'], $solicitar['estado'], $solicitar['cidade'], $data, $solicitar['estrutura'], $solicitar['area'], $solicitar['quando'], $solicitar['tipo_reforma'] );

        $resu_salv_soli = $conexao->query($sql_salvar_soli);
        if($resu_salv_soli){
            return true;
        }else{ return false; }

    }


    function getlistOrc($conexao){
        $sql_getListOrc = "select 
                            orc.seg_soli_orc as 'seg', orc.precisa_soli_orc as 'preci', orc.precisa_espe_soli_orc as 'especificacao', 
                            orc.nome_pessoa_soli_orc as 'necessidade', orc.nome_foto_soli_orc as 'nome', orc.emp_soli_orc as 'emp', 
                            orc.tel_soli_orc as 'telefone', orc.cel_soli_orc as 'celular', orc.email_soli_orc as 'email',
                            est.nome as 'estado', cid.nome as 'cidade', date_format(orc.data_soli_orc, '%d/%m/%Y') as 'soli_data'
                            from soli_orcamento orc, estado est, cidade cid
                            where
                            orc.estado_soli_orc = est.id and
                            orc.cidade_soli_orc = cid.id order by orc.id_soli_orc desc";

        $resu_salv_list_orc = $conexao->query($sql_getListOrc);
        if($resu_salv_list_orc){
            return $resu_salv_list_orc;
        }else{ return false; }
    }








  // Estado e cidade Ceparado
  
    function getEstado($conexao ,$estado){
        $sql_estado = sprintf("select nome from estado where id = '%u' ",$estado);
        $resu_estado = $conexao->query($sql_estado);
        if($resu_estado){
            return $resu_estado;
        }else{ return false; }
    }

    function getCidade($conexao, $cidade){
        $sql_cidade  = sprintf("select nome from cidade where id = '%u' ",$cidade);
        $resu_cidade = $conexao->query($sql_cidade);
        if($resu_cidade){
            return $resu_cidade;
        }else{ return false; }
    }
    
