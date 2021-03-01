<?php
namespace Lubri\UI\actions\combos;

use Lubri\UI\utils\LubriUIUtils;

use Lubri\UI\service\UIProductoService;

use Lubri\UI\service\UIServiceFactory;

use Lubri\Core\model\ProductoCombo;

use Rasty\actions\JsonAction;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;

use Rasty\app\RastyMapHelper;
use Rasty\factory\ComponentFactory;
use Rasty\factory\ComponentConfig;

/**
 * se borra un producto de combo para la edición
 * en sesión.
 *
 * @author Marcos
 * @since 29/08/2019
 */
class BorrarProductoComboJson extends JsonAction{


	public function execute(){

		$rasty= RastyMapHelper::getInstance();

		try {

			//indice del producto a eliminar.
			$index = RastyUtils::getParamPOST("index");
			if(empty($index))
				$index = 0;
			//eliminamos el producto dado el índice
			LubriUIUtils::borrarProductoComboSession($index);

			$productos = LubriUIUtils::getProductosComboSession();
			$result["productos"] = $productos;

			$result["importe"] = 0;
			foreach ($productos as $productojson) {
				$result["importe"] += $productojson["subtotal"];
			}



		} catch (RastyException $e) {

			$result["error"] = $e->getMessage();
		}

		return $result;

	}

}
?>
