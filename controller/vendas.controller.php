<?php

class ControllerVendas {

    static public function ctrListarVendas($item, $valor){
    
        $tabela = "vendas";

		$resposta = VendasModel::mdlListarVendas($tabela, $item, $valor);

		return $resposta; 

    }


}
   