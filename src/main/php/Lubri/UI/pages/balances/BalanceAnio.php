<?php
namespace Lubri\UI\pages\balances;

use Lubri\UI\pages\LubriPage;

use Lubri\UI\components\filter\model\UIProductoCriteria;



use Lubri\UI\service\UIVentaService;

use Lubri\UI\utils\LubriUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Lubri\Core\model\Caja;
use Lubri\Core\criteria\VentaCriteria;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar las balances.
 *
 * @author Marcos
 * @since 09/10/2019
 *
 */
class BalanceAnio extends LubriPage{



	public function __construct(){

	}

	public function getTitle(){
		return $this->localize("balanceAnio.title") ;
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();




		return array($menuGroup);
	}

	public function getType(){

		return "BalanceAnio";

	}


	public function getUicriteriaClazz(){
		return get_class( new UIProductoCriteria() );
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );


	}



}
?>
