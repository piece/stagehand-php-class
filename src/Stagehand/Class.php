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
    // {{{ load()

    /**
     * Loads the class.
     *
     */
    public function load()
    {
        $propertyContent = null;
        $methodContent = null;
        foreach ($this->_properties as $property) {
            $propertyContent .= "    {$property['visibility']} \${$property['name']};\n";
        }
        foreach ($this->_methods as $method) {
            $methodContent .= "    {$method['visibility']} function {$method['name']}()
    {
        {$method['code']}
        ;
    }
";
        }

        $classContent = "class {$this->_name}
{
{$propertyContent}
{$methodContent}
}
";
        eval($classContent);
    }

    // }}}
    // {{{ setProperty()

    /**
     * Sets the property.
     *
     * @param string $name
     * @param string $visibility
     */
    public function setProperty($name, $visibility = null)
    {
        $visibility = $this->_normalizeVisibility($visibility);
        $this->_properties[$name] = array('name' => $name, 'visibility' => $visibility);
    }

    // }}}
    // {{{ setMethod()

    /**
     * Sets the method.
     *
     * @param string $name
     * @param string $visibility
     * @param string $name
     */
    public function setMethod($name, $args, $code, $visibility = null)
    {
        $visibility = $this->_normalizeVisibility($visibility);
        $this->_methods[$name] = array('name' => $name,
                                       'args' => $args,
                                       'code' => $code,
                                       'visibility' => $visibility,
                                       );
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
    // {{{ _normalizeVisibility()

    /**
     * Normalizes a visibility value.
     *
     * @param string $name
     */
    public function _normalizeVisibility($visibility = null)
    {
        $visibilityEntries = array('public', 'protected', 'private');
        if (!in_array($visibility, $visibilityEntries)) {
            $visibility = 'public';
        }

        return $visibility;
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
