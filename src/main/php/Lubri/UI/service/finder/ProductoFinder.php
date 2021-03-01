<?php
namespace Lubri\UI\service\finder;

use Lubri\UI\components\filter\model\UIProductoCriteria;
use Lubri\UI\components\filter\model\UIPackCriteria;

use Lubri\UI\service\UIServiceFactory;

use Rasty\Forms\finder\model\IAutocompleteFinder;
/**
 *
 * Finder para productos.
 *
 * @author Marcos
 * @since 02/03/2018
 */
class ProductoFinder implements  IAutocompleteFinder {


	public function __construct() {}

	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::findEntitiesByText()
	 */
	public function findEntitiesByText( $text, $parent=null ){

		$uiCriteria = new UIProductoCriteria();
		$uiCriteria->setNombreOTipoOMarca( $text );
		//$uiCriteria->setTipoProducto( $text );
		$uiCriteria->setRowPerPage( 10 );
		return UIServiceFactory::getUIProductoService()->getList($uiCriteria);
	}

	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::findEntityByCode()
	 */
	function findEntityByCode( $code, $parent=null ){


		$oProducto = UIServiceFactory::getUIProductoService()->get( $code );
		$oProducto->setCantidad(1);
		return $oProducto;
	}

	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getAttributes()
	 */
	public function getAttributes(){
		return array("oid","nombre", "tipoProducto", "marcaProducto");
	}

	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getAttributesCallback()
	 */
	public function getAttributesCallback(){
		return array("oid", "nombre", "precioLista", "stock", "precioEfectivo", "cantidad", "costo");
	}

	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getEntityCode()
	 */
	function getEntityCode( $entity ){
		if( !empty( $entity)  )

		return $entity->getOid();
	}

	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getEntityLabel()
	 */
	function getEntityLabel( $entity ){
		if( !empty( $entity)  )
		return $entity->__toString();
	}

	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getEntityFieldCode()
	 */
	function getEntityFieldCode( $entity ){
		return "oid";
	}

	/**
	 * mensaje para cuando no hay resultados.
	 * @var string
	 */
	function getEmptyResultLabel(){
		return null;
	}

	/**
	 * label para agregar una nueva entity
	 * @var string
	 */
	function getAddEntityLabel(){
		return null;
	}

	/**
	 * función javascript a ejecutar para agregar una nueva entity.
	 * si esta property es definida se muestra el link cuando
	 * no hay resultados
	 * @var string
	 */
	function getOnclickAdd(){
		return "";
	}
}
?>
