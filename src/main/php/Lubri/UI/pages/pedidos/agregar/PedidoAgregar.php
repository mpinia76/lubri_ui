<?php
namespace Lubri\UI\pages\pedidos\agregar;

use Lubri\Core\utils\LubriUtils;
use Lubri\UI\utils\LubriUIUtils;

use Lubri\UI\pages\LubriPage;

use Rasty\utils\XTemplate;
use Lubri\Core\model\Pedido;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Page para agregar un pedido
 *
 * @author Marcos
 * @since 10-07-2020
 *
 */
class PedidoAgregar extends LubriPage{

	/**
	 * pedido a agregar.
	 * @var Pedido
	 */
	private $pedido;


	public function __construct(){

		//inicializamos el pedido.
		$pedido = new Pedido();

		$pedido->setFechaHora( new \Datetime() );
		$pedido->setProveedor( LubriUtils::getProveedorDefault() );

		$this->setPedido($pedido);


	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

//		$menuOption = new MenuOption();
//		$menuOption->setLabel( $this->localize( "form.volver") );
//		$menuOption->setPageName("Pedidos");
//		$menuGroup->addMenuOption( $menuOption );
//

		return array($menuGroup);
	}

	public function getTitle(){
		return $this->localize( "pedido.agregar.title" );
	}

	public function getType(){

		return "PedidoAgregar";

	}

	protected function parseXTemplate(XTemplate $xtpl){

		LubriUIUtils::setDetallesPedidoSession( array() );
	}


	public function getPedido()
	{
	    return $this->pedido;
	}

	public function setPedido($pedido)
	{
	    $this->pedido = $pedido;
	}



	public function getMsgError(){
		return "";
	}
}
?>
