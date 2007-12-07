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
  protected $title            = 'style',
            $selectors        = array();
  
  public function __construct($title = 'style')
  {
    $this->title = $title;
  }
  
  public function getTitle()
  {
    return $this->title;
  }
  
  public function addSelector()
  {
    $args = func_get_args();
    switch(get_class_name($args[0]))
    {
      case 'csOopCssSelector':
        $this->selectors[$args[0]->getSelector()] = $args[0];
        break;
      case 'String':
        $selector = new csOopCssSelector($args[0]);
        $this->selectors[$args[0]] = $selector;
        break;
    }
  }
  
  public function getSelector($selector = '')
  {
    if(isset($this->selectors[$selector]))
    {
      return $this->selectors[$selector];
    }
    else
    {
      return false;
    }
  }
  
  public function removeSelector($selector = '')
  {
    if(isset($this->selectors[$selector]))
    {
      unset($this->selectors[$selector]);
    }
  }
  
  public function __toString()
  {
    return implode("\n\n", $this->selectors);
  }
}
?>