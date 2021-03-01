<?php
namespace Lubri\UI\actions\presupuestos;

use Lubri\UI\utils\LubriUIUtils;

use Lubri\UI\service\UIServiceFactory;
use Lubri\Core\model\Presupuesto;
use Lubri\Core\utils\LubriUtils;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se anula una presupuesto
 *
 * @author Marcos
 * @since 29/03/2019
 */
class AnularPresupuesto extends Action{


	public function execute(){

		$forward = new Forward();


		//tomamos la presupuesto
		$presupuestoOid = RastyUtils::getParamPOST("presupuestoOid");
		$forward->addParam( "presupuestoOid", $presupuestoOid );
		try {

			//la recuperamos la presupuesto.
			$presupuesto = UIServiceFactory::getUIPresupuestoService()->get( $presupuestoOid );

			$user = RastySecurityContext::getUser();
			$user = LubriUtils::getUserByUsername($user->getUsername());

			UIServiceFactory::getUIPresupuestoService()->anular($presupuesto, $user);

			$forward->setPageName( "Presupuestos" );


		} catch (RastyException $e) {

			$forward->setPageName( "PresupuestoAnular" );
			$forward->addError( Locale::localize($e->getMessage())  );

		}

		return $forward;

	}

}
?>
