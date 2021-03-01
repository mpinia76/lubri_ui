<?php
namespace Lubri\UI\components\grid\formats;

use Lubri\UI\utils\LubriUIUtils;


use Lubri\Core\model\Producto;
use Rasty\i18n\Locale;
use Rasty\Grid\entitygrid\model\GridValueFormat;

/**
 * Formato para porcentaje
 *
 * @author Marcos
 * @since 10-07-2020
 *
 */

class GridPorcentajeFormat extends  GridValueFormat{

	public function __construct(){

	}

	public function format( $value, $item=null ){

		if( $value !=null )
			return  LubriUIUtils::formatPorcentajeToView($value);
		else $value;
	}


}
