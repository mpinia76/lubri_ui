<?php
namespace Lubri\UI\components\grid\formats;

use Lubri\UI\utils\LubriUIUtils;
use Rasty\Grid\entitygrid\model\GridValueFormat;

use Lubri\Core\model\Sucursal;
use Lubri\Core\model\Producto;
use Rasty\i18n\Locale;

/**
 * Formato para imprte
 *
 * @author Marcos
 * @since 12-03-2018
 *
 */

class GridImporteFormat extends  GridValueFormat{

	private $simbolo;

	public function __construct($simbolo=null){
		$this->simbolo = $simbolo;
	}

	public function format( $value, $item=null ){

		if( $value !=null )
			return  LubriUIUtils::formatMontoToView($value, $this->getSimbolo());
		else $value;
	}



	public function getSimbolo()
	{
	    return $this->simbolo;
	}

	public function setSimbolo($simbolo)
	{
	    $this->simbolo = $simbolo;
	}
}
