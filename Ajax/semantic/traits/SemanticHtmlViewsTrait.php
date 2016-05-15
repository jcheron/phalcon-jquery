<?php

namespace Ajax\semantic\traits;

use Ajax\semantic\html\views\HtmlCard;

trait SemanticHtmlViewsTrait {

	public abstract function addHtmlComponent($htmlComponent);

	/**
	 *
	 * @param string $identifier
	 */
	public function htmlCard($identifier) {
		return $this->addHtmlComponent(new HtmlCard($identifier));
	}
}