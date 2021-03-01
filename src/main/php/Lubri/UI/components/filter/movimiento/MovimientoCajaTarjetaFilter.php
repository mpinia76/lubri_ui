<?php

namespace Lubri\UI\components\filter\movimiento;


use Lubri\UI\service\UIServiceFactory;

use Lubri\UI\utils\LubriUIUtils;

use Lubri\UI\components\grid\model\MovimientoCajaTarjetaGridModel;

use Lubri\UI\components\filter\model\UIMovimientoCajaCriteria;
use Lubri\UI\components\filter\model\UITarjetaCriteria;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Filtro para buscar movimientos de Caja
 *
 * @author Marcos
 * @since 07-04-2018
 */
class MovimientoCajaTarjetaFilter extends Filter{



	public function getType(){

		return "MovimientoCajaTarjetaFilter";
	}

	public function __construct(){

		parent::__construct();

		$this->setGridModelClazz( get_class( new MovimientoCajaTarjetaGridModel() ));

		$this->setUicriteriaClazz( get_class( new UIMovimientoCajaCriteria()) );


		$this->addProperty("fechaDesde");
		$this->addProperty("fechaHasta");
		//$this->addProperty("cuentas");
	}


	public function fillEntity($entity){

		parent::fillEntity($entity);


		$tarjetas = UIServiceFactory::getUITarjetaService()->getList( new UITarjetaCriteria() );
		$arrayTarjetas = array();
		foreach ($tarjetas as $tarjeta) {
			$arrayTarjetas[] = $tarjeta->getOid();;
		}



		$entity->setCuentas( $arrayTarjetas );

	}

	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el banco con bapro
		//$this->fillInput("cuenta", UIServiceFactory::getUIBancoService()->getCajaBAPRO() );

		parent::parseXTemplate($xtpl);





		$xtpl->assign("lbl_fechaDesde",  $this->localize( "criteria.fechaDesde" ) );
		$xtpl->assign("lbl_fechaHasta",  $this->localize( "criteria.fechaHasta" ) );


	}




}
?>
