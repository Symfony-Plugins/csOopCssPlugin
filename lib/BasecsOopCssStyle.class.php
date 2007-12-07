<?php

/*
 * This file is part of the csOopCss package.
 * (c) 2007-2008 Josh R Reynolds <reynoldsj@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
/**
 * Base Symfony OOP CSS Style Class
 *
 * @package   csOopCss
 * @author    Josh R Reynolds <reynoldsj@gmail.com>
 * 
 * @version   SVN: $Id:
 **/
class BasecsOopCssStyle
{
  protected $property         = '',
            $value            = '';
  
  public function __construct()
  {
    $args = func_get_args();
    $this->property = ($args[0] != null) ? $args[0] : '';
    $this->value = ($args[1] != null) ? $args[1] : '';
  }
  
  public function setProperty($property='')
  {
    $this->property = $property;
  }
  
  public function setValue($value='')
  {
    $this->value = $value;
  }
  
  public function getProperty()
  {
    return $this->property;
  }
  
  public function getValue()
  {
    return $this->value;
  }
  
  public function toArray()
  {
    return array($property => $value);
  }
  
  public function __toString()
  {
    return ($property != '') ? $property.': '.$value.';': '';
  }
}
?>