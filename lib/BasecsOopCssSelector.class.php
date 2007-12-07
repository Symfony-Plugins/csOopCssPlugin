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
  protected $_selector         = null,
            $_errors           = array(),
            $_styles           = array();
            
  public function __construct()
  {
    $args = func_get_args();
    $this->_selector = ($args[0] != null) ? $args[0] : null;
  }
  
  public function setSelector($value='')
  {
    $this->_selector = $value;
  }
  
  public function getSelector()
  {
    return $this->_selector;
  }
  
  public function addStyle()
  {
    $args = func_get_args();
    if(is_string($args[0]))
    {
      if(isset($args[0]) && isset($args[1]) && $args[0] != null && $args[1] != null)
      {
        $style = new csOopCssStyle($args[0], $args[1]);
        $this->_styles[$args[0]] = $style; 
        return true;
      }
      else
      {
        $this->_errors[] = "Property and Value must be Strings!";
        return false;
      }
    }
    elseif(get_class($args[0]) == 'csOopCssStyle')
    {
      $this->_styles[$args[0]->getProperty()] = $args[0];
      return true;
    }
    else
    {
      return false;
    }
  }
  
  public function addStyles($styles = array())
  {
    foreach($styles as $s)
    {
      $this->addStyle($s);
    }
  }
  
  public function removeStyle($property = '')
  {
    if(isset($this->_styles[$property]))
    {
      unset($this->_styles[$property]);
    }
  }
  
  public function getStyles()
  {
    return $this->_styles;
  }
  
  public function toArray()
  {
    $styles = array();
    
    foreach($this->_styles as $s)
    {
      $styles = array_merge($styles, $s->toArray());
    }
    
    return array($this->_selector => $styles);
  }
  
  public function __toString()
  {
    if($this->_selector != null)
    {
      $out = $this->_selector." {\n";
      $out .= $this->stylesToString();
      $out .= "}";
      return $out;
    }
    else
    {
      return '';
    }
  }
  
  public function stylesToString()
  {
    $out = '';
    foreach($this->_styles as $s)
    {
      $out .= $s."\n";
    }
    return $out;
  }
  
  public function getError()
  {
    return $this->error;
  }
}
?>