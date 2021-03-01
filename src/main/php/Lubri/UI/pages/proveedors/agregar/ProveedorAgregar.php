<?php
namespace Lubri\UI\pages\proveedors\agregar;

use Lubri\UI\pages\LubriPage;

use Rasty\utils\XTemplate;
use Lubri\Core\model\Proveedor;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class ProveedorAgregar extends LubriPage{

	/**
	 * proveedor a agregar.
	 * @var Proveedor
	 */
	private $proveedor;


	public function __construct(){

		//inicializamos el proveedor.
		$proveedor = new Proveedor();

		//$proveedor->setNombre("Bernardo");
		//$proveedor->setEmail("ber@mail.com");
		$this->setProveedor($proveedor);


	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("Proveedors");
		$menuGroup->addMenuOption( $menuOption );


		return array($menuGroup);
	}

	public function getTitle(){
		return $this->localize( "proveedor.agregar.title" );
	}

	public function getType(){

		return "ProveedorAgregar";

	}

	protected function parseXTemplate(XTemplate $xtpl){
		$proveedorForm = $this->getComponentById("proveedorForm");
		$proveedorForm->fillFromSaved( $this->getProveedor() );

	}


	public function getProveedor()
	{
	    return $this->proveedor;
	}

	public function setProveedor($proveedor)
	{
	    $this->proveedor = $proveedor;
	}



	public function getMsgError(){
		return "";
	}
}
?>
