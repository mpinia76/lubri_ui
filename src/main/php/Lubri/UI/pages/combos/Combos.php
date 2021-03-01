<?php
namespace Lubri\UI\pages\combos;

use Lubri\UI\pages\LubriPage;

use Lubri\UI\components\filter\model\UIComboCriteria;

use Lubri\UI\components\grid\model\ComboGridModel;

use Lubri\UI\service\UIComboService;

use Lubri\UI\utils\LubriUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Lubri\Core\model\Combo;
use Lubri\Core\criteria\ComboCriteria;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los combos.
 *
 * @author Marcos
 * @since 28-08-2019
 *
 */
class Combos extends LubriPage{


	public function __construct(){

	}

	public function getTitle(){
		return $this->localize( "combos.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.combos.agregar") );
		$menuOption->setPageName("ComboAgregar");
		$menuOption->setIconClass( "icon-combos");
		$menuGroup->addMenuOption( $menuOption );


		return array($menuGroup);
	}

	public function getType(){

		return "Combos";

	}

	public function getModelClazz(){
		return get_class( new ComboGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIComboCriteria() );
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );

		$xtpl->assign("agregar_label", $this->localize("combo.agregar") );
	}

}
?>
