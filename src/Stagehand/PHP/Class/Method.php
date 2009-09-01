<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

/**
 * PHP version 5
 *
 * Copyright (c) 2009 KUMAKURA Yousuke <kumatch@gmail.com>,
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
 * @package    stagehand-php-class
 * @copyright  2009 KUMAKURA Yousuke <kumatch@gmail.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License (revised)
 * @version    Release: @package_version@
 * @since      File available since Release 0.1.0
 */

// {{{ Stagehand_PHP_Class_Method

/**
 * A class for method of a PHP class.
 *
 * @package    stagehand-php-class
 * @copyright  2009 KUMAKURA Yousuke <kumatch@gmail.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License (revised)
 * @version    Release: @package_version@
 * @since      Class available since Release 0.1.0
 */
class Stagehand_PHP_Class_Method extends Stagehand_PHP_Class_Declaration
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
    private $_arguments = array();
    private $_code;
    private $_docComment;

    private $_isAbstract  = false;
    private $_isFinal     = false;
    private $_isReference = false;

    /**#@-*/

    /**#@+
     * @access public
     */

    // }}}
    // {{{ __construct()

    /**
     * Sets this method name.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->_name = $name;
        $this->definePublic();
    }

    // }}}
    // {{{ setName()

    /**
     * Sets a method name.
     *
     * @param string $name  method name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    // }}}
    // {{{ getName()

    /**
     * Gets a method name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    // }}}
    // {{{ addArgument()

    /**
     * Addes a argument.
     *
     * @param Stagehand_PHP_Class_Method_Argument $argument
     */
    public function addArgument(Stagehand_PHP_Class_Method_Argument $argument)
    {
        if ($this->hasArgument($argument->getName())) {
            throw new Stagehand_PHP_Class_Exception("The argument [{$argument->getName()}] is duplicated.");
        }

        $this->setArgument($argument);
    }

    // }}}
    // {{{ getArguments()

    /**
     * Gets all arguments.
     *
     * @return array
     */
    public function getArguments()
    {
        return $this->_arguments;
    }

    // }}}
    // {{{ getArgument()

    /**
     * Gets a target argument.
     *
     * @param string $name  argument name
     * @return mixed
     */
    public function getArgument($name)
    {
        if (!$this->hasArgument($name)) {
            return;
        }

        return $this->_arguments[$name];
    }

    // }}}
    // {{{ setArgument()

    /**
     * Sets a argument.
     *
     * @param Stagehand_PHP_Class_Argument $argument
     */
    public function setArgument(Stagehand_PHP_Class_Method_Argument $argument)
    {
        $this->_arguments[ $argument->getName() ] = $argument;
    }

    // }}}
    // {{{ hasArgument()

    /**
     * Returns whether a method has target name's argument.
     *
     * @param string $name  argument name.
     */
    public function hasArgument($name)
    {
        if (!array_key_exists($name, $this->_arguments)) {
            return false;
        }

        return true;
    }

    // }}}
    // {{{ setCode()

    /**
     * Sets a method code.
     *
     * @param string  $code  a method code.
     */
    public function setCode($code)
    {
        $this->_code = $code;
    }

    // }}}
    // {{{ getCode()

    /**
     * Gets a method code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->_code;
    }

    // }}}
    // {{{ defineAbstract()

    /**
     * Defines a method to abstract.
     *
     */
    public function defineAbstract($isAbstract = true)
    {
        $this->_isAbstract = $isAbstract ? true : false;
        if ($this->isAbstract()) {
            $this->defineFinal(false);
        }
    }

    // }}}
    // {{{ isAbstract()

    /**
     * Returns whether a method is abstract or not.
     *
     * @return boolean
     */
    public function isAbstract()
    {
        return $this->_isAbstract ? true : false;
    }

    // }}}
    // {{{ defineFinal()

    /**
     * Defines a method to final.
     *
     */
    public function defineFinal($isFinal = true)
    {
        $this->_isFinal = $isFinal ? true : false;
        if ($this->isFinal()) {
            $this->defineAbstract(false);
        }
    }

    // }}}
    // {{{ isFinal()

    /**
     * Returns whether a method is final or not.
     *
     * @return boolean
     */
    public function isFinal()
    {
        return $this->_isFinal ? true : false;
    }

    // }}}
    // {{{ setReference()

    /**
     * Sets a method to reference.
     *
     * @param boolean $isReference
     */
    public function setReference($isReference = true)
    {
        $this->_isReference = $isReference ? true : false;
    }

    // }}}
    // {{{ isReference()

    /**
     * Returns whether a method is reference or not.
     *
     * @return boolean
     */
    public function isReference()
    {
        return $this->_isReference ? true : false;
    }

    // }}}
    // {{{ setDocComment()

    /**
     * Sets a doc comment.
     *
     * @param string  $docComment  A DocComment value.
     * @param boolean $isFormated  A DocComment is formated (default false).
     */
    public function setDocComment($docComment, $isFormated = false)
    {
        if (!$isFormated) {
            $docComment = Stagehand_PHP_Class_CodeGenerator::formatDocComment($docComment);
        }

        $this->_docComment = $docComment;
    }

    // }}}
    // {{{ getDocComment()

    /**
     * Gets a doc comment.
     *
     * @return string
     */
    public function getDocComment()
    {
        return $this->_docComment;
    }

    // }}}
    // {{{ render()

    /**
     * Renders a method code.
     *
     * @return string
     */
    public function render()
    {
        if ($docComment = $this->getDocComment()) {
            $docComment .= "\n";
        }

        $code = sprintf($this->_getMethodFormat(),
                        $docComment,
                        $this->getVisibility(),
                        $this->isStatic() ? ' static' : null,
                        $this->isReference() ? '&' : null,
                        $this->getName(),
                        $this->_formatArguments($this->getArguments()),
                        Stagehand_PHP_Class_CodeGenerator::indent($this->getCode())
                        );

        if ($this->isFinal()) {
            $code = 'final ' . $code;
        }

        return $code;
    }

    // }}}
    // {{{ renderInterface()

    /**
     * Renders a interface method code.
     *
     * @return string
     */
    public function renderInterface()
    {
        if (!$this->isPublic()) {
            return;
        }

        if ($docComment = $this->getDocComment()) {
            $docComment .= "\n";
        }

        $format = "%s%s%s function %s%s(%s);";
        $code = sprintf($format,
                        $docComment,
                        $this->getVisibility(),
                        $this->isStatic() ? ' static' : null,
                        $this->isReference() ? '&' : null,
                        $this->getName(),
                        $this->_formatArguments($this->getArguments())
                        );

        return $code;
    }

    /**#@-*/

    /**#@+
     * @access protected
     */

    // }}}
    // {{{ _getMethodFormat

    /**
     * Gets a method code Format
     *
     * @return string
     */
    protected function _getMethodFormat()
    {
        if ($this->isAbstract()) {
            $format = "%sabstract %s%s function %s%s(%s);";
        } else {
            $format = "%s%s%s function %s%s(%s)
{
%s}";
        }

        return $format;
    }

    // }}}
    // {{{ _formatArguments()

    /**
     * Formats arguments available to class method.
     *
     * @param string  $code
     * @return string
     */
    protected function _formatArguments($arguments)
    {
        $formatedArguments = array();
        foreach ($arguments as $argument) {
            array_push($formatedArguments, $argument->render());
        }

        return implode(', ', $formatedArguments);
    }

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