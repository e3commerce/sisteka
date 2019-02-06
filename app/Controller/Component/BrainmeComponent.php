<?php

class BrainmeComponent extends Component 
{
	public function __construct(){}

	

	public function diasUteis($dias)
	{
		$data = date('Y-m-d');

		// pr('- Dados Iniciais:');
		// pr('Data Inicial: '.$data);
		// pr('Dias Adicionais: '.$dias);

		//Finais de Semana
		// $arrDia[0] = 'Domingo';
		// $arrDia[1] = 'Segunda';
		// $arrDia[2] = 'Terça';
		// $arrDia[3] = 'Quarta';
		// $arrDia[4] = 'Quinta';
		// $arrDia[5] = 'Sexta';
		// $arrDia[6] = 'Sábado';

		// pr('- Dados de Verificação:');
		$contadorAdd = 1;
		$i = 1;
		while ($i <= $dias) 
		{ 
			$dataFinal = date('Y-m-d', strtotime('+'.$contadorAdd.' days', strtotime($data)));
			$dataVerificacao = new DateTime($dataFinal);
			$dia = $dataVerificacao->format('w');
			// pr('Data: '.$dataFinal.' - Somar +'.$contadorAdd.': '.$dia.' ('.$arrDia[$dia].')');

			if(!in_array($dia,array(0,6))){ $i++; }
			$contadorAdd++;
		}

		// pr($dataFinal);
		// pr($arrDia[$dia]);
		// exit;
		return trim(ltrim(rtrim($dataFinal)));
	}
}