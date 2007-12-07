<?php

/*
 * This file is part of the csOopCss package.
 * (c) 2007-2008 Josh R Reynolds <reynoldsj@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
/**
 * Base Symfony OOP CSS Class
 *
 * @package   csOopCss
 * @author    Josh R Reynolds <reynoldsj@gmail.com>
 * 
 * @version   SVN: $Id:
 **/
class BasecsOopCss
{
  protected $_title            = 'style',
            $_selectors        = array();
  
  public function __construct($title = 'style')
  {
    $this->_title = $title;
  }
  
  public function getTitle()
  {
    return $this->_title;
  }
  
  public function addSelector()
  {
    $args = func_get_args();
    if(is_string($args[0]))
    {
      $selector = new csOopCssSelector($args[0]);
      $this->_selectors[$args[0]] = $selector;
      return true;
    }
    if(is_array($args[0]))
    {
      $selector = new csOopCssSelector(implode(', ', $args[0]));
      foreach($args[0] as $s)
      {
        $this->_selectors[$args[0]] = $selector;
      }
    }
    elseif(get_class($args[0]) == 'csOopCssSelector')
    {
      $this->_selectors[$args[0]->getSelector()] = $args[0];
      return true;
    }
    else
    {
      return false;
    }
  }
  
  public function addSelectors($selectors = array())
  {
    foreach($selectors as $s)
    {
      $this->addSelector($s);
    }
  }
  
  public function getSelector($selector = '')
  {
    if(isset($this->_selectors[$selector]))
    {
      return $this->_selectors[$selector];
    }
    else
    {
      return null;
    }
  }
  
  public function hasSelector($selector = '')
  {
    if(isset($this->_selectors[$selector]))
    {
      return true;
    }
    else
    {
      return false;
    }
  }
  
  public function removeSelector($selector = '')
  {
    if(isset($this->_selectors[$selector]))
    {
      unset($this->_selectors[$selector]);
    }
  }
  
  public function __toString()
  {
    $this->_compressSelectors();
    return implode("\n\n", $this->_selectors);
  }
  
  protected function _compressSelectors()
  {
    $selectors = array();
    $catalog = array();
    foreach($this->_selectors as $s)
    {
      $key = array_search($s->stylesToString(), $catalog);
      if(is_string($key))
      {
        $old_key = $key;
        $key .= ", ".$s->getSelector();
        $s->setSelector($key);
        $selectors[$key] = $s;
        unset($selectors[$old_key]);
      }
      else
      {
        $selectors[$s->getSelector()] = $s;
        $catalog[$s->getSelector()] = $s->stylesToString();
      }
    }
    $this->_selectors = $selectors;
  }
}
?>