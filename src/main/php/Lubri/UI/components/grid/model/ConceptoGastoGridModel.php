<?php
namespace Lubri\UI\components\grid\model;

use Lubri\UI\components\grid\formats\GridImporteFormat;

use Lubri\UI\utils\LubriUIUtils;

use Lubri\UI\components\filter\model\UIConceptoGastoCriteria;

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
 * Model para la grilla de conceptoGastos.
 *
 * @author Marcos
 * @since 09/03/2018
 */
class ConceptoGastoGridModel extends EntityGridModel{

	public function __construct() {

        parent::__construct();
        $this->initModel();

    }

    public function getService(){

    	return UIServiceFactory::getUIConceptoGastoService();
    }

    public function getFilter(){

    	$filter = new UIConceptoGastoCriteria();
		return $filter;
    }

	protected function initModel() {

		$this->setHasCheckboxes( false );

		$column = GridModelBuilder::buildColumn( "oid", "conceptoGasto.oid", 20, EntityGrid::TEXT_ALIGN_RIGHT );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "nombre", "conceptoGasto.nombre", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
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
		$menuOption->setLabel( $this->localize( "menu.conceptoGastos.modificar") );
		$menuOption->setPageName( "ConceptoGastoModificar" );
		$menuOption->addParam("oid",$item->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/editar_32.png" );
		$options[] = $menuOption ;






		$menuOption = new MenuActionAjaxOption();
		$menuOption->setLabel( $this->localize( "menu.conceptoGasto.eliminar") );
		$menuOption->setActionName( "EliminarConceptoGasto" );
		$menuOption->setConfirmMessage( $this->localize( "conceptoGasto.eliminar.confirm.msg") );
		$menuOption->setConfirmTitle( $this->localize( "conceptoGasto.eliminar.confirm.title") );
		$menuOption->setOnSuccessCallback( "eliminarCallback" );
		$menuOption->addParam("conceptoGastoOid",$item->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/eliminar_32.png" );
		$options[] = $menuOption ;

		$group->setMenuOptions( $options );

		return array( $group );

	}

}
?>
