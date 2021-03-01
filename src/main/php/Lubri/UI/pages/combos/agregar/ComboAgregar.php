<?php
namespace Lubri\UI\pages\combos\agregar;

use Lubri\Core\utils\LubriUtils;
use Lubri\UI\utils\LubriUIUtils;

use Lubri\UI\pages\LubriPage;

use Rasty\utils\XTemplate;
use Lubri\Core\model\Combo;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class ComboAgregar extends LubriPage{

	/**
	 * combo a agregar.
	 * @var Combo
	 */
	private $combo;


	public function __construct(){

		//inicializamos el combo.
		$combo = new Combo();

		$combo->setFecha( new \Datetime() );

		//$combo->setCliente( LubriUtils::getClienteDefault() );

		$this->setCombo($combo);


	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario
		//y utilizando permisos

		$menuGroup = new MenuGroup();

//		$menuOption = new MenuOption();
//		$menuOption->setLabel( $this->localize( "form.volver") );
//		$menuOption->setPageName("Combos");
//		$menuGroup->addMenuOption( $menuOption );
//

		return array($menuGroup);
	}

	public function getTitle(){
		return $this->localize( "combo.agregar.title" );
	}

	public function getType(){

		return "ComboAgregar";

	}

	protected function parseXTemplate(XTemplate $xtpl){

		LubriUIUtils::setProductosComboSession( array() );
		$comboForm = $this->getComponentById("comboForm");
		$comboForm->fillFromSaved( $this->getCombo() );
	}


	public function getCombo()
	{
	    return $this->combo;
	}

	public function setCombo($combo)
	{
	    $this->combo = $combo;
	}



	public function getMsgError(){
		return "";
	}
}
?>
