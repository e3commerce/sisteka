<?php App::uses('AppHelper', 'View/Helper'); 

class BrainmeHelper extends AppHelper 
{ 
    public $helpers = array('Html', 'Form', 'Js');

    public function montarLinkCanal($venda_id)
    {
        $VENDA = ClassRegistry::init('Venda');
        $VENDA->recursive = -1;
        $dadosVenda = $VENDA->findById($venda_id);

        $CANAL = ClassRegistry::init('Canal');
        $CANAL->recursive = -1;
        $listaCanais = $CANAL->find('list',array('fields'=>array('id','nome')));

        $linkCanal = $this->getLinkCanal($venda_id);
        if(!(strpos($linkCanal,'http') === false)) //Retorno do Link Correto
        {
            $retorno = $this->Html->link($listaCanais[$dadosVenda['Venda']['canal_id']], $linkCanal, array('target'=>'_blank', 'class' => 'btn-info btn-sm'));
        }else{ // Caso o Canal não esteja Mapeado
            $retorno = $listaCanais[$dadosVenda['Venda']['canal_id']];
        }

        return $retorno;
    }

    public function getLinkCanal($venda_id)
    {
        $VENDA = ClassRegistry::init('Venda');
        $VENDA->recursive = -1;
        $dadosVenda = $VENDA->findById($venda_id);

        $CANAL = ClassRegistry::init('Canal');
        $CANAL->recursive = -1;
        $listaCanais = $CANAL->find('list',array('fields'=>array('id','nome')));

        if(in_array($dadosVenda['Venda']['canal_id'],array(2,12,13))) { // MERCADO LIVRE
            $retorno = 'https://myaccount.mercadolivre.com.br/sales/vop?&orderId='.$dadosVenda['Venda']['id_venda'];
        }else if(in_array($dadosVenda['Venda']['canal_id'],array(6,25))) { // B2W
            $retorno = 'https://www.b2wmarketplace.com.br/#/pedidos/detalhes/'.$dadosVenda['Venda']['id_venda'];
        }else if(in_array($dadosVenda['Venda']['canal_id'],array(7,23))) { // DAFITI
            $retorno = 'https://sellercenter.com.br/order/index/order-detail/filteredStatus/1/id/'.$dadosVenda['Venda']['id_venda'];
        }else if(in_array($dadosVenda['Venda']['canal_id'],array(15,29))) { // WALMART
            $retorno = 'https://stargate.wmxp.com.br/orders/'.(explode('-',$dadosVenda['Venda']['id_venda'])[0]).'?seller_order_id='.(explode('-',$dadosVenda['Venda']['id_venda'])[0]).'-lojadagravida';
        }else if(in_array($dadosVenda['Venda']['canal_id'],array(16,27))) { // MAGAZINE LUIZA
            $retorno = 'https://marketplace-admin.luizalabs.com/pedidos?order_id='.(explode('-',$dadosVenda['Venda']['id_venda'])[1]);
        }else if(in_array($dadosVenda['Venda']['canal_id'],array(3,22))) { // CNOVA
            $retorno = 'https://lojista.ehub.com.br/adm-seller/order/jsp/ordersDetail.jsp?orderId='.$dadosVenda['Venda']['id_venda'];
        }else{ // NÃO MAPEADO
            $retorno = $listaCanais[$dadosVenda['Venda']['canal_id']];
        }

        return $retorno;
    }

    public function apenasNumeros($string = null)
    {   
        if($string != null)
            return preg_replace("/[^0-9]/", "", $string);
        else
            return 'A String não pode ser nula.';
    }

    public function dia_semana($valor)
    {
        switch ($valor) {
            case 0: return 'Dom'; break;
            case 1: return 'Seg'; break;
            case 2: return 'Ter'; break;
            case 3: return 'Qua'; break;
            case 4: return 'Qui'; break;
            case 5: return 'Sex'; break;
            case 6: return 'Sab'; break;

        }
    }

    public function deleta_registro($config)
    {

        // if ($config['userData_id'] == 29) {
            

echo "<b id='".$config['id_element']."'>";
echo $this->Form->create('Ajaxes');
$this->Js->get('#'.$config['id_element']);
echo $this->Js->submit('DELETAR PERMANENTE', array(
'update' => '#'.$config['id_element'],
'url' => array('controller'=>'ajaxes','action' => 'deleta_registro', $config['model'], $config['id_model']),
// 'before' => $this->Js->effect('fadeOut'),
// 'complete' => $this->Js->effect('fadeIn'),
'class' => 'btn-sm btn-danger',
'style' => 'cursor:pointer; padding: 3px; float: left; margin:3px;'
)
);
echo $this->Js->writeBuffer(array('inline' => 'true'));
echo $this->Form->end();

echo "</b>";



    // }
    }

    public function editar_dados_integracommerce($config)
    {
        echo substr($config['abertura'], 0, -1).' id="'.$config['id_element'].'_edicao" style="display:none;">';

        echo "<span style='color:#ccc; padding:10px; background-color:#eee; display:block; border-radius:5px;'>";
            echo $this->Form->create('Integra');

                echo '<a class="pull-right" onClick="toggledisplay('."'".$config['id_element'].'_edicao'."'".')"><i class="fa fa-times"></i></a>';

                echo $this->Form->input('id', array('type' => 'hidden', 'value' => $config['id_database']));
                echo $this->Form->input('id_element', array('type' => 'hidden', 'value' => $config['id_element'].'_edicao'));

                echo $this->Form->$config['tipo']('dado', array('class' => 'form-control campo', 'label' => false, 'value' => $config['value']));


                $this->Js->get('#'.$config['id_element']);

                echo $this->Js->submit('Finalizar', array(
                    'update' => '#'.$config['id_element'], 
                    'url' => array(
                        'controller' => 'integracommerce', 
                        'action' => 'admin_'.$config['action'], 
                    ), 
                    'before' => $this->Js->effect('fadeOut'),
                    'complete' => $this->Js->effect('fadeIn'),
                    'class' => 'btn btn-success btn-xs',
                    )
                );

                echo $this->Js->writeBuffer(array('inline' => 'true'));

            echo $this->Form->end();      

        echo "</span>";

        echo $config['fechamento'];
    }

     public function editar_dados_brainmestore($config)
    {
        echo substr($config['abertura'], 0, -1).' id="'.$config['id_element'].'_edicao" style="display:none;">';
        echo "<span style='color:#ccc; padding:10px; background-color:#eee; display:block; border-radius:5px;'>";
        echo $this->Form->create('Brainmestore');
        echo '<a class="pull-right" onClick="toggledisplay('."'".$config['id_element'].'_edicao'."'".')"><i class="fa fa-times"></i></a>';
        echo $this->Form->$config['tipo']('dado', array('class' => 'form-control campo', 'label' => false, 'value' => $config['value']));
        echo $this->Form->input('id_element', array('type' => 'hidden', 'value' => $config['id_element'].'_edicao'));
        $this->Js->get('#'.$config['id_element']);
        echo $this->Js->submit('Finalizar', array(
            'update' => '#'.$config['id_element'], 
            'url' => array('controller' => 'brainmestore', 'action' => 'admin_edita_geral', $config['url'], $config['id_model'], $config['coluna']),
            'before' => $this->Js->effect('fadeOut'),
            'complete' => $this->Js->effect('fadeIn'),
            'class' => 'btn btn-success btn-xs',
            )
        );
        echo $this->Js->writeBuffer(array('inline' => 'true'));
        echo $this->Form->end();         
        echo "</span>";
        echo $config['fechamento'];
    }

    public function edita_dados_ajax($config)
    {
        echo substr($config['abertura'], 0, -1).' id="'.$config['id_element'].'_edicao" style="display:none;">';
        echo "<span style='color:#ccc; padding:10px; background-color:#eee; display:block; border-radius:5px;'>";
        echo $this->Form->create('Ajaxes');
        echo '<a class="pull-right" onClick="toggledisplay('."'".$config['id_element'].'_edicao'."'".')"><i class="fa fa-times"></i></a>';
        echo $this->Form->$config['tipo']('dado', array('class' => 'form-control campo', 'label' => false, 'value' => $config['value']));
        echo $this->Form->input('id_element', array('type' => 'hidden', 'value' => $config['id_element'].'_edicao'));
        $this->Js->get('#'.$config['id_element']);
        echo $this->Js->submit('Finalizar', array(
            'update' => '#'.$config['id_element'], 
            'url' => array('controller' => 'ajaxes', 'action' => 'admin_edita_info', $config['model'], $config['id_model'], $config['coluna']),
            // 'before' => $this->Js->effect('fadeOut'),
            // 'complete' => $this->Js->effect('fadeIn'),
            'class' => 'btn btn-success btn-xs',
            )
        );
        echo $this->Js->writeBuffer(array('inline' => 'true'));
        echo $this->Form->end();         
        echo "</span>";
        echo $config['fechamento'];
    }

    public function ativo_link($valor,$link)
    {
        if(($valor == 1) || ($valor == 'success') || ($valor == 'sucesso') || ($valor == 201) || ($valor == 200))
        {
            echo '<a href="'.$link.'" target="_blank" style="curos:pointer; color:black;"><img src="http://192.168.1.24/central/img/check-1.png" alt="check" width=""></a>';
        }else{
            echo $this->Html->image('check-0.png', array('alt' => 'check'));
        }
    }

    public function ativo($valor)
    {
        if($valor == 1)
        {
            // echo $this->Html->image('check-1.png', array('alt' => 'check'));
            echo '<span class="badge badge-success"><i class="fa fa-check"></i></span>';
        }else{
            // echo $this->Html->image('check-0.png', array('alt' => 'check'));
            // echo '<i class="fa fa-square-o"></i>';
            echo '<span class="badge badge-danger"><i class="fa fa-close"></i></span>';
        }
    }

    function TrataDadosJadlog($string)
    {
        $string = strtoupper(preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/", "/(:)/"),explode(" ","a A e E i I o O u U n N -"),$string));
        $string = str_replace(',', ' ', $string);
        return $string;
    }


    function randomico_hermes()
    {
        return rand(1,5);
    }

    function LimitarTexto($texto, $limite, $quebra = true)
    {
        $tamanho = strlen($texto);
        if ($tamanho <= $limite) 
        {
            $novo_texto = $texto;
        } else {
            if ($quebra == true) 
            {
                $novo_texto = trim(substr($texto, 0, $limite)).' [...]';
            } else {
                $ultimo_espaco = strrpos(substr($texto, 0, $limite), ' ');
                $novo_texto = trim(substr($texto, 0, $ultimo_espaco)).' [...]';
            }
        }
        return $novo_texto;
    }


    function data($data)
    {
        $var = explode('-', $data);
        $novadata = $var[2] . '/' . $var[1] . '/' . $var[0];
        return $novadata;
    }

    function dataHoraWhats($data)
    {
        $explode1 = explode(' ', $data);
        $data = $explode1[0];

        if($data == date('Y-m-d'))
        {
            $novadata = ('Hoje');
        }else if($data == date('Y-m-d', strtotime(date('Y-m-d'). ' - 1 days'))){
            $novadata = ('Ontem');
        }else{
            $explode2 = explode('-', $data);
            $novadata = $explode2[2] . '/' . $explode2[1] . '/' . $explode2[0];
        }

        $hora = $explode1[1];
        $resultado = $novadata.' às '.$hora;
        return $resultado;
    }

    function dataHoraWhatsGmt($dado)
    {
        $explode = explode('T', $dado);
       
        $data = $explode[0];
        $hora = $explode[1];

        if($data == date('Y-m-d'))
        {
            $novadata = ('Hoje');
        }else if($data == date('Y-m-d', strtotime(date('Y-m-d'). ' - 1 days'))){
            $novadata = ('Ontem');
        }else{
            $explode2 = explode('-', $data);
            $novadata = $explode2[2] . '/' . $explode2[1] . '/' . $explode2[0];
        }

        $explode = explode('.',$hora);
        $hora = $explode[0];

        $resultado = $novadata.' às '.$hora;
        return $resultado;
    }

    function datatime($data)
    {
        $explode1 = explode(' ', $data);
        $data = $explode1[0];
        $hora = $explode1[1];
        $explode2 = explode('-', $data);
        $novadata = $explode2[2] . '/' . $explode2[1] . '/' . $explode2[0];
        $resultado = $novadata.' às '.$hora;
        return $resultado;
    }

    function date_time_gmt($dado)
    {
        $explode = explode('T', $dado);
       
        $data = $explode[0];
        $hora = $explode[1];

        $explode = explode('-', $data);
        $data = $explode[2] . '/' . $explode[1] . '/' . $explode[0];

        $explode = explode('.',$hora);
        $hora = $explode[0];

        $resultado = $data.' às '.$hora;
        return $resultado;
    }


    function semana($data)
    {
        $datetime1 = new DateTime($data);
        $datetime2 = new DateTime(date('Y-m-d'));
        $interval = $datetime1->diff($datetime2);
        $diferenca = substr($interval->format('%R%a'), 1);

        $diferenca = intval($diferenca/7);

        return $diferenca;
    }


    function primeira_palavra($data)
    {
        $data=explode(" ", $data);
        return $data[0];
    }

    function preco_ponto_virgula($data)
    {
        $data = str_replace('.', ',', $data);

        $caio = explode(',', $data);

        if (isset($caio['1'])){
        	return $data;
        }else{
        	return $data.',00';
        }
    }

    function preco($preco)
    {
        $delimiters = array(",",".");
        $string = $preco;
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        $tipo =  is_numeric($launch[0]);
        if ($tipo == 1) 
        {
            if (isset($launch['1'])) 
            {
                 $novopreco = 'R$ '.$launch['0'].','.$launch['1'];
            }else {
                $novopreco = 'R$ '.$launch['0'].',00';
            }
        }else{ 
            $novopreco = $preco; 
        }
        
        return $novopreco;
    }

    function trata_texto($data)
    {
        $data = strtolower($data);
        $data = ucwords($data);  
        return $data;
    }

    function trata_texto_email($data)
    {
        $data = strtolower($data);
        return $data;
    }

    function trata_texto_estado($data)
    {
        $data = strtoupper($data);
        return $data;
    }

    function trata_texto_doc($data)
    {
        $data = str_replace('.', '', $data);
        $data = str_replace('-', '', $data);
        $data = str_replace('/', '', $data);
        $data = str_replace('*', '', $data);
        return $data;
    }

    function ml_cat($mlb)
    {
        switch ($mlb) 
        {
            case 'MLB40593':
                $cat = 'Berços e Móveis para Bebês > Kits para Berços';
                break;
            case 'MLB40592':
                $cat = 'Banho, Saúde e Higiene do Bebê > Kits de Higiene';
                break;
            case 'MLB40594':
                $cat = 'Berços e Móveis para Bebês > Almofadas';
                break;
            case 'MLB40566':
                $cat = 'Decoração e Lembranças de Bebê > Convites';
                break;
            case 'MLB6156':
                $cat = 'Bebês > Outros';
                break;
            case 'MLB8313':
                $cat = 'Decoração e Lembranças de Bebê > Outros';
                break;
            case 'MLB186352':
                $cat = 'Casa, Móveis e Decoração > Banheiros > Toalhas de Banho > Toalhas';
                break;
            case 'MLB186462':
                $cat = 'Decoração > Almofadas > Almofadas Decorativas';
                break;
            case 'MLB9483':
                $cat = 'Pelúcias e Afins > Animais > Ursos';
                break;
            case 'MLB4771':
                $cat = 'Decoração > Cortinas';
                break;
            default:
                $cat = $mlb;
                break;
        }
        return $cat;
    }

    function notificacao_forma_pagamento($id)
    {
        switch ($id)
        {
            case 1:
                $forma = 'Boleto Bancário';
                break;
            case 2:
                $forma = 'Cartão de Crédito';
                break;
            case 3:
                $forma = 'Débito Bancário';
                break;
            case 4:
                $forma = 'Depósito em Conta Bancária';
                break;
            case 5:
                $forma = 'Dinheiro em conta MP';
                break;
            default:
                $forma = $id;
                break;
        }
        return $forma;
    }

    function venda_status($id)
    {   
        $statuVenda = ClassRegistry::init('Statu');
        $statuAtual = $statuVenda->find('first',array('conditions'=>array('Statu.id'=>$id)));
        return $statuAtual['Statu']['descricao'];
    }

    function venda_lojistica($id)
    {   
        $lojistica = ClassRegistry::init('Lojistica');
        $lojistica->recursive = -1;
        $lojistica = $lojistica->find('first',array('conditions'=>array('Lojistica.id'=>$id)));
        return ucwords(strtolower($lojistica['Lojistica']['nome']));
    }
}