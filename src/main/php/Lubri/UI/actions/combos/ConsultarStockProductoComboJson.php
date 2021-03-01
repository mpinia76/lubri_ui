<?php
namespace Lubri\UI\actions\combos;

use Lubri\UI\utils\LubriUIUtils;

use Lubri\UI\service\UIProductoService;

use Lubri\UI\service\UIServiceFactory;

use Lubri\Core\model\ProductoCombo;

use Lubri\UI\components\filter\model\UIProductoCriteria;

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
 * se agregar un producto de combo para la edición
 * en sesión.
 *
 * @author Marcos
 * @since 29/08/2019
 */
class ConsultarStockProductoComboJson extends JsonAction{


	public function execute(){

		$rasty= RastyMapHelper::getInstance();

		try {

			//creamos el producto de combo.
			$producto = new ProductoCombo();

			$productoCodigo = RastyUtils::getParamPOST("producto");
			$cantidad = RastyUtils::getParamPOST("cantidad");
			$precio = $value = str_replace(',', '.', RastyUtils::getParamPOST("precio"));

			/*$uiCriteria = new UIProductoCriteria();
			$uiCriteria->setCodigoExacto( $productoCodigo );*/

			$oProducto = UIServiceFactory::getUIProductoService()->get ($productoCodigo);

			$producto->setProducto($oProducto );
			$producto->setCantidad( $cantidad );
			$producto->setPrecioUnitario( $precio );





			$productos = LubriUIUtils::getProductosComboSession();

			$result["productos"] = $productos;

			$result["cantidad"] = $cantidad;



			foreach ($productos as $productojson) {
			//mismo producto y mismo precio
				if(( $producto->getProducto()->getOid() == $productojson["producto_oid"] )  ){
					$result["cantidad"] += $productojson["cantidad"];
				}

			}



			Logger::log("Actual ".$oProducto->getStock()." vender ".$result['cantidad']);

			$hayStock = ($oProducto->getStock()<$result["cantidad"])?'NO':'SI';
			$result["hayStock"] = $hayStock;

		} catch (RastyException $e) {

			$result["error"] = $e->getMessage();
		}

		return $result;

	}

}
?>
