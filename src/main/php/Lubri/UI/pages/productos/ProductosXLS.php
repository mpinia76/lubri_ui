<?php
namespace Lubri\UI\pages\productos;

use Lubri\UI\pages\LubriPage;




use Lubri\UI\utils\LubriUIUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;
use Rasty\utils\LinkBuilder;



use Rasty\security\RastySecurityContext;

class ProductosXLS extends LubriPage{



	public function __construct(){



	}

	public function getTitle(){
		return date('YmdHis').'_'.precios;
	}



	protected function parseXTemplate(XTemplate $xtpl){

		$title = $this->localize("admin_home.title");
		$subtitle = $this->localize("admin_home.subtitle");
		$xtpl->assign("app_title", $title );

	}




	public function getType(){

		return "ProductosXLS";

	}



}
?>
