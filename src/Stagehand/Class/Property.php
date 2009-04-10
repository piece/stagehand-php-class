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

// {{{ Stagehand_Class_Property

/**
 * Stagehand_Class_Property.
 *
 * @package    sh-class
 * @copyright  2009 KUMAKURA Yousuke <kumatch@users.sourceforge.net>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License (revised)
 * @version    Release: @package_version@
 * @since      Class available since Release 0.1.0
 */

class Stagehand_Class_Property
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
    private $_value;
    private $_visibility;

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
    public function __construct($name, $value = null)
    {
        $this->_name = $name;
        $this->_value = $value;
        $this->setPublic();
    }

    // }}}
    // {{{ setName()

    /**
     * sets the property name.
     *
     * @param string $name  Propety name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    // }}}
    // {{{ getName()

    /**
     * Gets the property name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    // }}}
    // {{{ setValue()

    /**
     * sets the property value.
     *
     * @param string $value  Propety value
     */
    public function setValue($value)
    {
        $this->_value = $value;
    }

    // }}}
    // {{{ getValue()

    /**
     * Gets the property value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->_value;
    }

    // }}}
    // {{{ getVisivility()

    /**
     * Gets the property visivility.
     *
     * @return string
     */
    public function getVisibility()
    {
        return $this->_visibility;
    }

    // }}}
    // {{{ setPublic()

    /**
     * Sets the visibility to public.
     */
    public function setPublic()
    {
        return $this->_visibility = 'public';
    }

    // }}}
    // {{{ setProtected()

    /**
     * Sets the visibility to protected.
     */
    public function setProtected()
    {
        return $this->_visibility = 'protected';
    }

    // }}}
    // {{{ setPrivate()

    /**
     * Sets the visibility to private.
     */
    public function setPrivate()
    {
        return $this->_visibility = 'private';
    }

    // }}}
    // {{{ isPublic()

    /**
     * Returns whether the property is public visibility or not.
     */
    public function isPublic()
    {
        return ($this->_visibility === 'public') ? true : false;
    }

    // }}}
    // {{{ isProtected()

    /**
     * Returns whether the property is protected visibility or not.
     */
    public function isProtected()
    {
        return ($this->_visibility === 'protected') ? true : false;
    }

    // }}}
    // {{{ isPrivate()

    /**
     * Returns whether the property is private visibility or not.
     */
    public function isPrivate()
    {
        return ($this->_visibility === 'private') ? true : false;
    }

    // }}}
    // {{{ getPartialCode()

    /**
     * Gets a partial code for class property.
     */
    public function getPartialCode()
    {
        $code = "{$this->_visibility} \${$this->_name}";
        if ($this->_value) {
            $code .= " = '{$this->_value}'";
        }

        return "$code;";
    }

    /**#@-*/

    /**#@+
     * @access protected
     */

    /**#@-*/

    /**#@+
     * @access private
     */

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
