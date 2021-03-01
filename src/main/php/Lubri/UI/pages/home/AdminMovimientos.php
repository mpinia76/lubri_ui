<?php
namespace Lubri\UI\pages\home;

use Datetime;
use Lubri\UI\pages\LubriPage;

use Lubri\UI\components\filter\model\UIEmpleadoCriteria;

use Lubri\UI\service\UIServiceFactory;

use Lubri\UI\components\filter\model\UIVentaCriteria;

use Lubri\UI\utils\LubriUIUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;
use Rasty\utils\LinkBuilder;

use Lubri\Core\model\Empleado;

use Rasty\Grid\filter\model\UICriteria;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuActionOption;

use Rasty\security\RastySecurityContext;

class AdminMovimientos extends LubriPage{



	public function __construct(){


		/*if( LubriUIUtils::isCajaSelected() ){
			$caja = UIServiceFactory::getUICajaService()->get(LubriUIUtils::getCaja()->getOid());
			$this->setCaja( $caja );
		}*/

		/*$this->setCajaChica( UIServiceFactory::getUICuentaService()->getCajaChica() );

		$this->setCuentaBapro( UIServiceFactory::getUIBancoService()->getCuentaBAPRO() );*/
	}

	public function getTitle(){
		return $this->localize( "admin_home.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

		return array($menuGroup);
	}

	protected function parseMenuUser(XTemplate $xtpl){

		$user = RastySecurityContext::getUser();
		$xtpl->assign("user", $user->getName() );

		$this->parseMenuExit($xtpl);

	}

	protected function parseXTemplate(XTemplate $xtpl){

		$title = $this->localize("admin_home.title");
		$subtitle = $this->localize("admin_home.subtitle");
		$xtpl->assign("app_title", $title );
		//$xtpl->assign("app_subtitle", $subtitle );

		$this->parseMenuUser($xtpl);



		$this->parseLinks($xtpl);

		$this->parseSaldos($xtpl);


	}

	public function parseLinks( XTemplate $xtpl){

		$xtpl->assign("menu_admin", $this->localize("menu.admin") );




		$xtpl->assign("menu_pedidos", $this->localize("menu.pedidos") );
		$xtpl->assign("linkPedidos", $this->getLinkPedidos() );
		$xtpl->assign("total_pedidosPendientes", UIServiceFactory::getUIPedidoService()->getTotalPendientes() );
		$xtpl->assign("menu_pedidos_agregar", $this->localize("menu.pedidos.agregar") );
		$xtpl->assign("linkPedidoAgregar", $this->getLinkPedidoAgregar() );



		$xtpl->assign("menu_gastos", $this->localize("menu.gastos") );
		$xtpl->assign("linkGastos", $this->getLinkGastos() );
		$xtpl->assign("menu_gastos_agregar", $this->localize("menu.gastos.agregar") );
		$xtpl->assign("linkGastoAgregar", $this->getLinkGastoAgregar() );


		$xtpl->assign("menu_ventasProductos", $this->localize("menu.ventasProductos") );


		$xtpl->assign("menu_cuentas", $this->localize("menu.cuentas") );

		$xtpl->assign("menu_caja", $this->localize("menu.caja") );
		$xtpl->assign("menu_cajaTarjeta", $this->localize("menu.cajaTarjeta") );
		$xtpl->assign("menu_cajaCtaCte", $this->localize("menu.cajaCtaCte") );

	}



	public function parseSaldos(XTemplate $xtpl){




			$xtpl->assign("saldo_caja", LubriUIUtils::formatMontoToView( UIServiceFactory::getUIMovimientoCajaService()->getTotalesDia(new Datetime())) );
			$xtpl->assign("saldo_ventas", LubriUIUtils::formatMontoToView( UIServiceFactory::getUIMovimientoVentaService()->getTotalesDia(new Datetime())) );

			$criteria = new UIVentaCriteria();
			$criteria->setFecha(new Datetime());
			$xtpl->assign("saldo_ganancias", LubriUIUtils::formatMontoToView( UIServiceFactory::getUIVentaService()->getGanancias($criteria)) );


			$xtpl->assign("saldo_gastos", LubriUIUtils::formatMontoToView( UIServiceFactory::getUIMovimientoGastoService()->getTotalesDia(new Datetime())) );
			$xtpl->assign("saldo_pedidos", LubriUIUtils::formatMontoToView( UIServiceFactory::getUIMovimientoPedidoService()->getTotalesDia(new Datetime())) );
			$xtpl->assign("saldo_cajaTarjeta", LubriUIUtils::formatMontoToView( UIServiceFactory::getUIMovimientoCajaService()->getTotalesTarjetasDia(new Datetime())) );
			$xtpl->assign("saldo_cajaCtaCte", LubriUIUtils::formatMontoToView( UIServiceFactory::getUIMovimientoCajaService()->getTotalesCtasCtesDia(new Datetime())) );

			$xtpl->assign("linkMovimientosCaja", $this->getLinkMovimientosCaja());
			$xtpl->assign("linkMovimientosCajaTarjeta", $this->getLinkMovimientosCajaTarjeta());
			$xtpl->assign("linkMovimientosCajaCtaCte", $this->getLinkMovimientosCajaCtaCte());
			$xtpl->assign("linkMovimientosVentas", $this->getLinkMovimientosVenta());
			$xtpl->assign("linkMovimientosGastos", $this->getLinkMovimientosGasto());
			$xtpl->assign("linkMovimientosPedidos", $this->getLinkMovimientosPedido());



	}


	public function parseMenuExit( XTemplate $xtpl){

		$menuOption = new MenuActionOption();
		$menuOption->setLabel( $this->localize( "menu.logout") );
		$menuOption->setIconClass( "icon-exit" );
		$menuOption->setActionName( "Logout");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/logout.png" );

		$this->parseMenuOption($xtpl, $menuOption, "main.menuOptionExit");

	}

	public function parseMenuAdmin( XTemplate $xtpl){

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.admin_home") );
		//$menuOption->setIconClass( "icon-exit" );
		$menuOption->setPageName( "AdminHome");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/empleado_home_48.png" );

		$this->parseMenuOption($xtpl, $menuOption, "main.menuOptionAdmin");

	}
	public function parseMenuProfile( XTemplate $xtpl, $user){

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.profile") );
		$menuOption->setIconClass( "icon-cog" );
		$menuOption->setPageName( "UserProfile");
		$menuOption->addParam("oid",$user->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/profile.png" );
		$this->parseMenuOption($xtpl, $menuOption, "main.menuOptionProfile");

	}

	public function parseMenuOption( XTemplate $xtpl, MenuOption $menuOption, $blockName){
		$xtpl->assign("label", $menuOption->getLabel() );
		$xtpl->assign("onclick", $menuOption->getOnclick());
		$img = $menuOption->getImageSource();
		if(!empty($img)){
			$xtpl->assign("src", $img );
			$xtpl->parse("$blockName.image");
		}
		$xtpl->assign("iconClass", $menuOption->getIconClass());

		$xtpl->parse("$blockName");
	}




	public function getType(){

		return "AdminMovimientos";

	}



}
?>
