<?php
namespace Lubri\UI\actions\ventas;

use Lubri\UI\utils\LubriUIUtils;
use Lubri\Core\utils\LubriUtils;

use Lubri\UI\service\UIServiceFactory;
use Lubri\Core\model\Venta;

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
 * @since 13/03/2018
 */
class CobrarVentaEfectivo extends Action{


	public function execute(){

		$forward = new Forward();


		//tomamos la venta
		$ventaOid = RastyUtils::getParamGET("ventaOid");
		$forward->addParam( "ventaOid", $ventaOid );
		try {


			//la recuperamos la venta.
			$venta = UIServiceFactory::getUIVentaService()->get( $ventaOid );
			//$monto = RastyUtils::getParamGET("monto");
			$monto = $value = str_replace(',', '.', RastyUtils::getParamGET("monto"));
			$montoActualizado = $value = str_replace(',', '.', RastyUtils::getParamGET("montoActualizado"));
			//$venta->setMonto($monto);

			$cuenta = LubriUtils::getCuentaUnica();


			$user = RastySecurityContext::getUser();
			$user = LubriUtils::getUserByUsername($user->getUsername());

			UIServiceFactory::getUIVentaService()->cobrar($venta, $cuenta, $user, $monto, $montoActualizado);

			$forward->setPageName( "Ventas" );


		} catch (RastyException $e) {

			$forward->setPageName( "VentaCobrar" );
			$forward->addError( Locale::localize($e->getMessage())  );

		}

		return $forward;

	}

}
?>
