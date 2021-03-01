<?php

namespace Lubri\UI\layouts;

use Rasty\Layout\layout\Rasty\Layout;

use Rasty\utils\XTemplate;


class LubriLoginMetroLayout extends LubriMetroLayout{

	public function getXTemplate($file_template=null){
		return parent::getXTemplate( dirname(__DIR__) . "/layouts/LubriLoginMetroLayout.htm" );
	}

	public function getType(){

		return "LubriLoginMetroLayout";

	}

}
?>
