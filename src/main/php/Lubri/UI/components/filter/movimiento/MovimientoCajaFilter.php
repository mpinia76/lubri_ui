<?php

namespace Lubri\UI\components\filter\movimiento;

use Lubri\UI\service\UIServiceFactory;

use Lubri\UI\utils\LubriUIUtils;

use Lubri\UI\components\grid\model\MovimientoCajaGridModel;

use Lubri\UI\components\filter\model\UIMovimientoCajaCriteria;

use Lubri\UI\components\filter\model\UIMovimientoCriteria;

use Lubri\UI\components\grid\model\MovimientoGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Filtro para buscar movimientos de Caja
 *
 * @author Marcos
 * @since 14-03-2018
 */
class MovimientoCajaFilter extends MovimientoFilter{


	public function getType(){

		return "MovimientoCajaFilter";
	}


	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		//$this->fillInput("cuenta", LubriUIUtils::getCaja() );

		parent::parseXTemplate($xtpl);

		$xtpl->assign("lbl_saldo",  $this->localize( "cuenta.saldo" ) );


	}

}
?>
