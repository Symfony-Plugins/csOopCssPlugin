<?php 
require_once(dirname(__FILE__).'/../../../test/bootstrap/unit.php');
require_once(dirname(__FILE__).'/../lib/csOopCss.class.php');
require_once(dirname(__FILE__).'/../lib/csOopCssSelector.class.php');
require_once(dirname(__FILE__).'/../lib/csOopCssStyle.class.php');

$t = new lime_test(7, new lime_output_color());
$t->diag('csOopCss');

$oop_css = new csOopCss('test');

$t->is($oop_css->getTitle(), 'test', 'returns the title');
$t->is($oop_css->getSelectors(), array(), 'initializes the selectors array');

$oop_css->addSelector('div#test');

$t->is((string) $oop_css, "div#test {\n}", 'adds a new selector, outputs the lone element stylesheet');

$oop_css->removeSelector('div#test');

$t->is((string) $oop_css, "", 'removes selectors by selector name');

$selector = new Selector('div#test');

$t->is((string) $selector, "div#test {\n}", 'creates selectors from selector name, outputs empty selector');

$oop_css->addSelector($selector);

$t->is((string) $selector, (string) $css_object->getSelector('div#test'), 'adds existing selectors');

$oop_css->getSelector('div#test')->addStyle('font-weight', 'bold');

$t->is((string) $oop_css, "div#test {\nfont-weight: bold;\n}", "adds new styles, outputs");

$oop_css->getSelector('div#test')->removeStyle('font-weight');

$t->is($css_object->getSelector('div#test'), "div#test {\n}", 'removes styles by property');

$style = new csOopCssStyle('font-weight', 'bold');

$oop_css->getSelector('div#test')->addStyle($style);

$t->is((string) $oop_css, "div#test {\nfont-weight: bold;\n}", "adds existing styles, outputs");
?>