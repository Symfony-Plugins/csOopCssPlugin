<?php

/*
 * This file is part of the csOopCss package.
 * (c) 2007-2008 Josh R Reynolds <reynoldsj@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
/**
 * Base Symfony OOP CSS Selector Class
 *
 * @package   csOopCssSelector
 * @author    Josh R Reynolds <reynoldsj@gmail.com>
 * 
 * @version   SVN: $Id:
 **/
class BasecsOopCssSelector
{
  protected $selector         = null,
            $errors           = array(),
            $styles           = array();
            
  public function __construct()
  {
    $args = func_get_args();
    $this->selector = $selector;
  }
  
  public function getSelector()
  {
    return $this->selector;
  }
  
  public function addStyle()
  {
    $args = func_get_args();
    switch(get_class_name($args[0]))
    {
      case 'csOopCssStyle':
        $this->styles[$args[0]->getProperty()] = $args[0];
        break;
      case 'String':
        if(isset($args[0]) && isset($args[1]) && $args[0] != null && $args[1] != null)
        {
          $style = new csOopCssStyle($args[0], $args[1]);
          $styles[$a]
          return true;
        }
        else
        {
          $this->error = "Property and Value must be Strings!";
          return false;
        }
        break;
    }
    
  }
  
  public function removeStyle($property = '')
  {
    if(isset($this->styles[$property]))
    {
      unset($this->styles[$property]);
    }
  }
  
  public function getStyles()
  {
    return $this->styles;
  }
  
  public function __toString()
  {
    $out = $selector." {\n";
    foreach($styles as $s)
    {
      $out .= $s."\n";
    }
    $out .= "}";
    return $out;
  }
  
  public function getError()
  {
    return $this->error;
  }
}
?>