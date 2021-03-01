<?php

namespace Lubri\UI\components\form\gasto;

use Lubri\UI\service\finder\ConceptoGastoFinder;

use Lubri\UI\components\filter\model\UIConceptoGastoCriteria;

use Lubri\UI\components\filter\model\UICategoriaGastoCriteria;

use Lubri\UI\service\finder\CategoriaGastoFinder;



use Lubri\UI\utils\LubriUIUtils;

use Lubri\UI\service\UIServiceFactory;

use Lubri\Core\model\EstadoGasto;

use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;


use Lubri\Core\model\Gasto;

use Rasty\utils\LinkBuilder;

/**
 * Formulario para gasto

 * @author Marcos
 * @since 12/03/2018
 */
class GastoForm extends Form{



	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;


	/**
	 *
	 * @var Gasto
	 */
	private $gasto;


	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");

		$this->addProperty("fecha");
		$this->addProperty("fechaVencimiento");
		$this->addProperty("concepto");
		$this->addProperty("monto");
		$this->addProperty("observaciones");


		$this->setBackToOnSuccess("GastoPagar");
		$this->setBackToOnCancel("Gastos");

	}

	public function getOid(){

		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}


	public function getType(){

		return "GastoForm";

	}

	public function fillEntity($entity){

		parent::fillEntity($entity);


	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);


		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );

		$xtpl->assign("lbl_fecha", $this->localize("gasto.fecha") );
		$xtpl->assign("lbl_fechaVencimiento", $this->localize("gasto.fechaVencimiento") );
		$xtpl->assign("lbl_concepto", $this->localize("gasto.concepto") );
		$xtpl->assign("lbl_monto", $this->localize("gasto.monto") );
		$xtpl->assign("lbl_observaciones", $this->localize("gasto.observaciones") );


	}


	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}

	public function getConceptos(){

		$conceptos = UIServiceFactory::getUIConceptoGastoService()->getList( new UIConceptoGastoCriteria() );

		return $conceptos;

	}

	public function getConceptoGastoFinderClazz(){

		return get_class( new ConceptoGastoFinder() );

	}





	public function getLinkCancel(){
		$params = array();

		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}



	public function getGasto()
	{
	    return $this->gasto;
	}

	public function setGasto($gasto)
	{
	    $this->gasto = $gasto;
	}
}
?>
