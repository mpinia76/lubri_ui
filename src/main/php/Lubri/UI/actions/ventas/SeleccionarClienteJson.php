<?php
namespace Lubri\UI\actions\ventas;

use Lubri\UI\components\filter\model\UIVentaCriteria;
use Lubri\UI\utils\LubriUIUtils;

use Lubri\UI\service\UIVentaService;

use Lubri\UI\service\UIServiceFactory;



use Rasty\actions\JsonAction;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;

use Rasty\app\RastyMapHelper;
use Rasty\factory\ComponentFactory;
use Rasty\factory\ComponentConfig;

use Rasty\utils\Logger;

/**
 *
 *
 * @author Marcos
 * @since 17/02/2021
 */
class SeleccionarClienteJson extends JsonAction{


	public function execute(){

		$rasty= RastyMapHelper::getInstance();

		try {



			$clienteId = RastyUtils::getParamPOST("clienteId");

            $cliente = UIServiceFactory::getUIClienteService()->get($clienteId);
			$criteria = new UIVentaCriteria();
			$criteria->setCliente($cliente);
            $criteria->addOrder("fecha", "DESC");
			$ventas = UIServiceFactory::getUIVentaService()->getList($criteria );

			$arrayVentas=array();
			foreach ($ventas as $venta){
			    if ($venta->getKm()){
                    $arrayVentas[]=array("id"=>$venta->getOid(),"value"=>$venta->__toString(), "patente"=>$venta->getPatente(), "marca"=>$venta->getMarca(), "km"=>$venta->getKm());
                }

            }


			$result["ventas"] = $arrayVentas;


		} catch (RastyException $e) {

			$result["error"] = $e->getMessage();
		}

		return $result;

	}

}
?>
