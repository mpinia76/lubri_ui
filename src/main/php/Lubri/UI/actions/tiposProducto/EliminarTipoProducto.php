<?php
namespace Lubri\UI\actions\tiposProducto;

use Lubri\UI\utils\LubriUIUtils;

use Lubri\UI\service\UIServiceFactory;
use Lubri\Core\model\TipoProducto;
use Lubri\Core\utils\LubriUtils;

use Rasty\actions\JsonAction;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se eliminar un tipo de documento
 *
 * @author Marcos
 * @since 05/03/2018
 */
class EliminarTipoProducto extends JsonAction{


	public function execute(){

		try {

			$tipoProductoOid = RastyUtils::getParamGET("tipoProductoOid");

			//obtenemos la tipoProducto
			$tipoProducto = UIServiceFactory::getUITipoProductoService()->get($tipoProductoOid);

			UIServiceFactory::getUITipoProductoService()->delete($tipoProducto);

			$result["info"] = Locale::localize("tipoProducto.borrar.success")  ;

		} catch (RastyException $e) {

			$result["error"] = Locale::localize($e->getMessage())  ;

		}

		return $result;

	}
}
?>
