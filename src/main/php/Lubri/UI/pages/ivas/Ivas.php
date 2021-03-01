<?php
namespace Lubri\UI\pages\ivas;

use Lubri\UI\service\UIServiceFactory;

use Lubri\UI\components\filter\model\UIIvaCriteria;

use Lubri\UI\components\grid\model\IvaGridModel;

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
 * @since 05-03-2018
 *
 */
class Ivas extends LubriPage{


	public function __construct(){

	}

	public function getTitle(){
		return $this->localize( "iva.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "iva.agregar") );
		$menuOption->setPageName("IvaAgregar");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_over_48.png" );
		$menuGroup->addMenuOption( $menuOption );


		return array($menuGroup);
	}

	public function getType(){

		return "Ivas";

	}

	public function getModelClazz(){
		return get_class( new IvaGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIIvaCriteria() );
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );

		$xtpl->assign("agregar_label", $this->localize("iva.agregar") );
	}


}
?>
