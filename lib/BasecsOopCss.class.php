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
    return implode("\n\n", $this->_selectors);
  }
}
?>