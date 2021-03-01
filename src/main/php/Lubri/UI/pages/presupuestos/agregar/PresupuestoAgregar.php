<?php
namespace Lubri\UI\pages\presupuestos\agregar;

use Lubri\Core\utils\LubriUtils;
use Lubri\UI\utils\LubriUIUtils;

use Lubri\UI\pages\LubriPage;

use Rasty\utils\XTemplate;
use Lubri\Core\model\Presupuesto;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class PresupuestoAgregar extends LubriPage{

	/**
	 * presupuesto a agregar.
	 * @var Presupuesto
	 */
	private $presupuesto;


	public function __construct(){

		//inicializamos el presupuesto.
		$presupuesto = new Presupuesto();

		$presupuesto->setFecha( new \Datetime() );

		$presupuesto->setCliente( LubriUtils::getClienteDefault() );

		$this->setPresupuesto($presupuesto);


	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

//		$menuOption = new MenuOption();
//		$menuOption->setLabel( $this->localize( "form.volver") );
//		$menuOption->setPageName("Presupuestos");
//		$menuGroup->addMenuOption( $menuOption );
//

		return array($menuGroup);
	}

	public function getTitle(){
		return $this->localize( "presupuesto.agregar.title" );
	}

	public function getType(){

		return "PresupuestoAgregar";

	}

	protected function parseXTemplate(XTemplate $xtpl){

		LubriUIUtils::setDetallesPresupuestoSession( array() );
	}


	public function getPresupuesto()
	{
	    return $this->presupuesto;
	}

	public function setPresupuesto($presupuesto)
	{
	    $this->presupuesto = $presupuesto;
	}



	public function getMsgError(){
		return "";
	}
}
?>
