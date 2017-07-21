<?php
global $navigation_args;
$navigation_args = array(
	'options' => array (
		'expand' => true,
		'expand_breakpoint' => 'l'
	),
	'classes' => array(
		'wrapper' => 'cb dn db-js center ma4 ma0-l toggler',
		'button' => 'bn bg-transparent ttu f6 pointer pa2 bw1 b--solid b--black center',
    'items' => array(
			'caret' => 'dib ml1 v-mid w-0 h-0 bw2 bb-0 b--solid bt--black bl--transparent br--transparent',
			'current' => 'underline',
			'level' => array(
				0 => array (
					'list' => 'list ma2 pa0 z-999 bg-white',
					'element' => 'pa2 pa0-l pr4-l',
					'element_link' => 'dib link black underline-hover'
				),
				1 => array(
					'list' => 'list ma2 ph2 bg-white bw0 bw1-l b--solid b--black',
					'element' => 'pa2 ph0-l pv2-l',
					'element_link' => 'dib link black underline-hover'
				)
			)
		)
	)
);

?>
