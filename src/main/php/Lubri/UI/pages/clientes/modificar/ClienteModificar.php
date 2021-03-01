<?php
namespace Lubri\UI\pages\clientes\modificar;

use Lubri\UI\pages\LubriPage;

use Lubri\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Lubri\Core\model\Cliente;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class ClienteModificar extends LubriPage{

	/**
	 * cliente a modificar.
	 * @var Cliente
	 */
	private $cliente;


	public function __construct(){

		//inicializamos el cliente.
		$cliente = new Cliente();
		$this->setCliente($cliente);

	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		return array($menuGroup);
	}

	public function setClienteOid($oid){

		//a partir del id buscamos el cliente a modificar.
		$cliente = UIServiceFactory::getUIClienteService()->get($oid);

		$this->setCliente($cliente);

	}

	public function getTitle(){
		return $this->localize( "cliente.modificar.title" );
	}

	public function getType(){

		return "ClienteModificar";

	}

	protected function parseXTemplate(XTemplate $xtpl){

	}

	public function getCliente(){

	    return $this->cliente;
	}

	public function setCliente($cliente)
	{
	    $this->cliente = $cliente;
	}
}
?>
