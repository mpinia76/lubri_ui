<?php
namespace Lubri\UI\pages\conceptoGastos;

use Lubri\UI\service\UIServiceFactory;

use Lubri\UI\components\filter\model\UIConceptoGastoCriteria;

use Lubri\UI\components\grid\model\ConceptoGastoGridModel;

use Lubri\UI\pages\LubriPage;

use Lubri\UI\utils\LubriUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los movimientos de banco.
 *
 * @author Marcos
 * @since 12-03-2018
 *
 */
class ConceptoGastos extends LubriPage{


	public function __construct(){

	}

	public function getTitle(){
		return $this->localize( "conceptoGasto.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "conceptoGasto.agregar") );
		$menuOption->setPageName("ConceptoGastoAgregar");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_over_48.png" );
		$menuGroup->addMenuOption( $menuOption );


		return array($menuGroup);
	}

	public function getType(){

		return "ConceptoGastos";

	}

	public function getModelClazz(){
		return get_class( new ConceptoGastoGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIConceptoGastoCriteria() );
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );

		$xtpl->assign("agregar_label", $this->localize("conceptoGasto.agregar") );
	}


}
?>
