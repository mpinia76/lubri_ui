<?php

namespace Lubri\UI\components\filter\movimiento;

use Lubri\UI\service\finder\UserFinder;
use Lubri\UI\service\UIServiceFactory;

use Lubri\UI\utils\LubriUIUtils;

use Lubri\UI\components\grid\model\MovimientoGastoGridModel;

use Lubri\UI\components\filter\model\UIMovimientoGastoCriteria;


use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Filtro para buscar movimientos de Gasto
 *
 * @author Marcos
 * @since 07-04-2018
 */
class MovimientoGastoFilter extends Filter{



	public function getType(){

		return "MovimientoGastoFilter";
	}

	public function __construct(){

		parent::__construct();

		$this->setGridModelClazz( get_class( new MovimientoGastoGridModel() ));

		$this->setUicriteriaClazz( get_class( new UIMovimientoGastoCriteria()) );


		$this->addProperty("fechaDesde");
		$this->addProperty("fechaHasta");
		$this->addProperty("user");
	}

	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el banco con bapro
		//$this->fillInput("cuenta", UIServiceFactory::getUIBancoService()->getCajaBAPRO() );

		parent::parseXTemplate($xtpl);

		$xtpl->assign("lbl_fechaDesde",  $this->localize( "criteria.fechaDesde" ) );
		$xtpl->assign("lbl_fechaHasta",  $this->localize( "criteria.fechaHasta" ) );
		$xtpl->assign("lbl_usuario",  $this->localize( "login.username" ) );

	}

	public function getUserFinderClazz(){

		return get_class( new UserFinder() );

	}

	public function getUsers(){

		$users = UIServiceFactory::getUIUserService()->getUsers();
		//$users = array();
		return $users;

	}


}
?>
