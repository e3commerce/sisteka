<?php App::uses('AppHelper', 'View/Helper'); 

class BrainmeHelper extends AppHelper 
{ 
    public $helpers = array('Html', 'Form', 'Js');

    


    

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

    


   

    


    function data($data)
    {
        $var = explode('-', $data);
        $novadata = $var[2] . '/' . $var[1] . '/' . $var[0];
        return $novadata;
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

    

   


   
}