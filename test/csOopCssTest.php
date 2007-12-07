<?php
Mock::generate('sfContext');

class csOopCssTest extends UnitTestCase
{
  private $context;
  private $routing;
  
  public function SetUp()
  {
    $this->context = new MockSfContext($this);
    $this->oop_css = new csOopCss('test');
  }
  
  public function test_basic()
  {
    $this->assertEqual('test', $this->oop_css->getTitle());
    $this->assertEqual(array(), $this->oop_css->getSelectors());
  }
  
  public function test_add_selector_new()
  {
    $this->oop_css->addSelector('div#test');
    $compare = "div#test {\n}";
    $this->assertEqual($compare, (string) $this->oop_css);
  }
  
  public function test_add_selector_existing()
  {
    $selector = new Selector('div#test');
    $this->oop_test->addSelector($selector);
    $compare = "div#test {\n}";
    $this->assertEqual($compare, (string) $this->oop_css);
  }
  
  public function test_add_style_new()
  {
    $this->oop_css->addSelector('div#test');
    $this->oop_css->getSelector('div#test')->addStyle('font-weight', 'bold');
    $compare = "div#test {\nfont-weight: bold;\n}";
    $this->assertEqual($compare, (string) $this->oop_css);
  }
  
  public function test_add_style_existing()
  {
    $this->oop_css->addSelector('div#test');
    $style = new csOopCssStyle('font-weight', 'bold');
    $this->oop_css->getSelector('div#test')->addStyle($style);
    $compare = "div#test {\nfont-weight: bold;\n}";
    $this->assertEqual($compare, (string) $this->oop_css);
    
  }
}
?>