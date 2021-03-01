<?php
namespace Lubri\UI\components\grid\model;

use Lubri\UI\components\grid\formats\GridImporteFormat;

use Lubri\UI\utils\LubriUIUtils;

use Lubri\UI\components\filter\model\UITipoDispositivoCriteria;

use Rasty\Grid\entitygrid\EntityGrid;
use Rasty\Grid\entitygrid\model\EntityGridModel;
use Rasty\Grid\entitygrid\model\GridModelBuilder;
use Rasty\Grid\filter\model\UICriteria;

use Lubri\Core\utils\LubriUtils;

use Lubri\UI\service\UIServiceFactory;
use Rasty\utils\RastyUtils;
use Rasty\utils\Logger;
use Rasty\security\RastySecurityContext;

use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuActionOption;
use Rasty\Menu\menu\model\MenuActionAjaxOption;

/**
 * Model para la grilla de tiposDispositivo.
 *
 * @author Marcos
 * @since 07/03/2018
 */
class TipoDispositivoGridModel extends EntityGridModel{

	public function __construct() {

        parent::__construct();
        $this->initModel();

    }

    public function getService(){

    	return UIServiceFactory::getUITipoDispositivoService();
    }

    public function getFilter(){

    	$filter = new UITipoDispositivoCriteria();
		return $filter;
    }

	protected function initModel() {

		$this->setHasCheckboxes( false );

		$column = GridModelBuilder::buildColumn( "oid", "tipoDispositivo.oid", 20, EntityGrid::TEXT_ALIGN_RIGHT );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "nombre", "tipoDispositivo.nombre", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );




	}

	public function getDefaultFilterField() {
        return "nombre";
    }

	public function getDefaultOrderField(){
		return "nombre";
	}


    /**
	 * opciones de menú dado el item
	 * @param unknown_type $item
	 */
	public function getMenuGroups( $item ){

		$group = new MenuGroup();
		$group->setLabel("grupo");
		$options = array();

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.tiposDispositivo.modificar") );
		$menuOption->setPageName( "TipoDispositivoModificar" );
		$menuOption->addParam("oid",$item->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/editar_32.png" );
		$options[] = $menuOption ;






		$menuOption = new MenuActionAjaxOption();
		$menuOption->setLabel( $this->localize( "menu.tipoDispositivo.eliminar") );
		$menuOption->setActionName( "EliminarTipoDispositivo" );
		$menuOption->setConfirmMessage( $this->localize( "tipoDispositivo.eliminar.confirm.msg") );
		$menuOption->setConfirmTitle( $this->localize( "tipoDispositivo.eliminar.confirm.title") );
		$menuOption->setOnSuccessCallback( "eliminarCallback" );
		$menuOption->addParam("tipoDispositivoOid",$item->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/eliminar_32.png" );
		$options[] = $menuOption ;

		$group->setMenuOptions( $options );

		return array( $group );

	}

}
?>
