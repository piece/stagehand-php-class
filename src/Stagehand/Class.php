<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

/**
 * PHP version 5
 *
 * Copyright (c) 2009 KUMAKURA Yousuke <kumatch@users.sourceforge.net>,
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    sh-class
 * @copyright  2009 KUMAKURA Yousuke <kumatch@users.sourceforge.net>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License (revised)
 * @since      File available since Release 0.1.0
 */

// {{{ Stagehand_Class

/**
 * Stagehand_Class.
 *
 * @package    sh-class
 * @copyright  2009 KUMAKURA Yousuke <kumatch@users.sourceforge.net>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License (revised)
 * @version    Release: @package_version@
 * @since      Class available since Release 0.1.0
 */

class Stagehand_Class
{

    // {{{ properties

    /**#@+
     * @access public
     */

    /**#@-*/

    /**#@+
     * @access protected
     */

    /**#@-*/

    /**#@+
     * @access private
     */

    private $_name;
    private $_parentClass;
    private $_properties = array();
    private $_methods = array();

    /**#@-*/

    /**#@+
     * @access public
     */

    // }}}
    // {{{ __construct()

    /**
     * Sets this class name.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->_name = $name;
    }

    // }}}
    // {{{ getName()

    /**
     * Gets the class name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    // }}}
    // {{{ load()

    /**
     * Loads the class.
     *
     */
    public function load()
    {
        $format = "class %s%s
{
%s
%s
}
";

        $classContent = sprintf($format,
                                $this->_name,
                                $this->_getParentClassCode(),
                                $this->_getAllPropertiesCode(),
                                $this->_getAllMethodsCode()
                                );

        eval($classContent);
    }

    // }}}
    // {{{ addProperty()

    /**
     * Adds a property.
     *
     * @param Stagehand_Class_Property $property
     */
    public function addProperty($property)
    {
        array_push($this->_properties, $property);
    }

    // }}}
    // {{{ addMethod()

    /**
     * Adds a method.
     *
     * @param Stagehand_Class_Method $method
     */
    public function addMethod($method)
    {
        array_push($this->_methods, $method);
    }

    // }}}
    // {{{ setParentClass()

    /**
     * Sets parent class.
     *
     * @param Stagehand_Class $class
     */
    public function setParentClass($class)
    {
        $this->_parentClass = $class;
    }

    /**#@-*/

    /**#@+
     * @access protected
     */

    /**#@-*/

    /**#@+
     * @access private
     */

    // }}}
    // {{{ _getAllPropertiesCode()

    /**
     * Gets all propertie's code.
     *
     * @return string
     */
    public function _getAllPropertiesCode()
    {
        $allPropertiesCode = null;
        foreach ($this->_properties as $property) {
            $allPropertiesCode .= "    " . $property->getPartialCode() . "\n";
        }

        return $allPropertiesCode;
    }

    // }}}
    // {{{ _getAllMethodsCode()

    /**
     * Gets all method's code.
     *
     * @return string
     */
    public function _getAllMethodsCode()
    {
        $allMethodsCode = null;
        foreach ($this->_methods as $method) {
            $allMethodsCode .= "    " . $method->getPartialCode() . "\n";
        }

        return $allMethodsCode;;
    }

    // }}}
    // {{{ _getParentClassCode()

    /**
     * Gets parent class code.
     *
     * @return string
     */
    public function _getParentClassCode()
    {
        $parentClassCode = null;
        if ($this->_parentClass) {
            $this->_parentClass->load();

            $parentClassCode = ' extends ' . $this->_parentClass->getName();
        }

        return $parentClassCode;
    }

    /**#@-*/

    // }}}
}

// }}}

/*
 * Local Variables:
 * mode: php
 * coding: iso-8859-1
 * tab-width: 4
 * c-basic-offset: 4
 * c-hanging-comment-ender-p: nil
 * indent-tabs-mode: nil
 * End:
 */
