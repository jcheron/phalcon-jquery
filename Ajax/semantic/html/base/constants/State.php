<?php

namespace Ajax\semantic\html\base\constants;

use Ajax\common\BaseEnum;

abstract class State extends BaseEnum {
	const ACTIVE="active", DISABLED="disabled", ERROR="error", FOCUS="focus", LOADING="loading", NEGATIVE="negative", POSITIVE="positive", SUCCESS="success", WARNING="warning";
}