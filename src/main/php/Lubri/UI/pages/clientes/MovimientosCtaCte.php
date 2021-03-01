<?php
namespace Lubri\UI\pages\clientes;

use Lubri\UI\utils\LubriUIUtils;

use Lubri\UI\service\UIServiceFactory;

use Lubri\UI\components\filter\model\UIMovimientoCajaCriteria;

use Lubri\UI\components\grid\model\MovimientoCajaGridModel;

use Lubri\UI\pages\LubriPage;

use Lubri\UI\utils\LubriUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los movimientos de la cuentaCorriente.
 *
 * @author Bernardo
 * @since 05-06-2014
 *
 */
class MovimientosCtaCte extends LubriPage{

	private $cuentaCorriente;

	public function __construct(){

		//buscamos la cuenta corriente dado el oid
		$oid = RastyUtils::getParamGET("oid");
		$ctacte = UIServiceFactory::getUICuentaCorrienteService()->get( $oid );

		$this->setCuentaCorriente($ctacte);

	}

	public function getTitle(){
		return $this->localize( "cuentaCorriente.movimientos.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

//		$menuOption = new MenuOption();
//		$menuOption->setLabel( $this->localize( "cliente.agregar") );
//		$menuOption->setPageName("ClienteAgregar");
//		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_over_48.png" );
//		$menuGroup->addMenuOption( $menuOption );


		return array($menuGroup);
	}

	public function getType(){

		return "MovimientosCtaCte";

	}

	public function getModelClazz(){
		return get_class( new MovimientoCajaGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIMovimientoCajaCriteria() );
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );

		//$xtpl->assign("agregar_label", $this->localize("cliente.agregar") );
	}

	public function getCuentaCorriente(){

		return $this->cuentaCorriente;
	}

	public function getLegend(){

		$nombre = $this->getCuentaCorriente()->getCliente();

		return LubriUIUtils::formatMessage( $this->localize("cuentaCorriente.movimientos.buscar"), array($nombre)) ;
	}


	public function setCuentaCorriente($cuentaCorriente)
	{
	    $this->cuentaCorriente = $cuentaCorriente;
	}
}
?>