<?php
namespace Lubri\UI\actions\ventas;

use Lubri\UI\utils\LubriUIUtils;
use Lubri\Core\utils\LubriUtils;

use Lubri\UI\service\UIServiceFactory;
use Lubri\Core\model\Venta;
use Lubri\Core\model\DetalleVenta;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se cobra una venta en efectivo
 *
 * @author Marcos
 * @since 21/06/2019
 */
class AgregarProductoVenta extends Action{


	public function execute(){

		$forward = new Forward();


		//tomamos la venta
		$ventaOid = RastyUtils::getParamGET("ventaOid");
		$forward->addParam( "ventaOid", $ventaOid );
		try {


			//la recuperamos la venta.
			$venta = UIServiceFactory::getUIVentaService()->get( $ventaOid );





			$detalles = LubriUIUtils::getDetallesVentaSession();



			$total=0;
			$costo=0;
			foreach ($detalles as $detallejson) {
				$detalle = new DetalleVenta();

				$detalle->setCantidad( $detallejson["cantidad"] );
				$detalle->setPrecioUnitario( $detallejson["precioUnitario"] );
				$detalle->setCosto( $detallejson["costo"] );
				$detalle->setStockActualizado( $detallejson["stockActualizado"] );
				$detalle->setProducto( UIServiceFactory::getUIProductoService()->get($detallejson["producto_oid"]) );

				$venta->addDetalle( $detalle );
				$total += $detallejson["cantidad"]*$detallejson["precioUnitario"];
				$costo += $detallejson["cantidad"]*$detallejson["costo"];
			}
			$monto = $venta->getMonto();
			$montoDebe = $venta->getMontoDebe();
			$venta->setMonto($monto+$total);
			$venta->setMontoDebe($montoDebe+$total);

			//print_r($venta);

			$user = RastySecurityContext::getUser();
			$user = LubriUtils::getUserByUsername($user->getUsername());

			$cuenta = LubriUtils::getCuentaUnica();

			UIServiceFactory::getUIVentaService()->agregarProducto($venta,$cuenta,$user);

			$forward->setPageName( "Ventas" );


		} catch (RastyException $e) {

			$forward->setPageName( "VentaAgregarProducto" );
			$forward->addError( Locale::localize($e->getMessage())  );

		}

		return $forward;

	}

}
?>
