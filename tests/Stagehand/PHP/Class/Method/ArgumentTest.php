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

// {{{ Stagehand_PHP_Class_Method_ArgumentTest

/**
 * Some tests for Stagehand_PHP_Class_Method
 *
 * @package    stagehand-php-class
 * @copyright  2009 KUMAKURA Yousuke <kumatch@gmail.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License (revised)
 * @version    Release: @package_version@
 * @since      Class available since Release 0.1.0
 */
class Stagehand_PHP_Class_Method_ArgumentTest extends PHPUnit_Framework_TestCase
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

    /**#@-*/

    /**#@+
     * @access public
     */

    public function setUp() { }

    public function tearDown() { }

    /**
     * @test
     */
    public function createAnArgument()
    {
        $argument = new Stagehand_PHP_Class_Method_Argument('foo');

        $this->assertEquals($argument->getName(), 'foo');
        $this->assertTrue($argument->isRequired());

        $argument->setName('bar');

        $this->assertEquals($argument->getName(), 'bar');
    }

    /**
     * @test
     */
    public function createAnNonRequirementArgument()
    {
        $argument = new Stagehand_PHP_Class_Method_Argument('foo');
        $argument->setRequirement(false);

        $this->assertEquals($argument->getName(), 'foo');
        $this->assertFalse($argument->isRequired());
        $this->assertNull($argument->getValue());

        $argument = new Stagehand_PHP_Class_Method_Argument('bar');
        $argument->setRequirement(false);
        $argument->setValue(10);

        $this->assertEquals($argument->getName(), 'bar');
        $this->assertFalse($argument->isRequired());
        $this->assertEquals($argument->getValue(), 10);
    }

    /**
     * @test
     * @expectedException Stagehand_PHP_Class_Exception
     */
    public function catchTheExceptionIfDeclaringObjectToArgumentsValue()
    {
        $foo = new stdClass();
        $argument = new Stagehand_PHP_Class_Method_Argument('foo');
        $argument->setRequirement(false);
        $argument->setValue($foo);
    }

    /**
     * @test
     * @expectedException Stagehand_PHP_Class_Exception
     */
    public function catchTheExceptionIfDeclaringNestedTrapArgumentsValue()
    {
        $foo = new stdClass();
        $trap = array(1, array(2, array(3, $foo)));
        $argument = new Stagehand_PHP_Class_Method_Argument('foo');
        $argument->setRequirement(false);
        $argument->setValue($trap);
    }

    /**
     * @test
     */
    public function createAnArgumentWithTypeHinting()
    {
        $argument1 = new Stagehand_PHP_Class_Method_Argument('foo');
        $argument2 = new Stagehand_PHP_Class_Method_Argument('bar');
        $argument3 = new Stagehand_PHP_Class_Method_Argument('baz');
        $argument4 = new Stagehand_PHP_Class_Method_Argument('qux');
        $argument1->setTypeHinting('array');
        $argument2->setTypeHinting('Array');
        $argument3->setTypeHinting('stdClass');

        $this->assertEquals($argument1->getTypeHinting(), 'array');
        $this->assertEquals($argument2->getTypeHinting(), 'array');
        $this->assertEquals($argument3->getTypeHinting(), 'stdclass');
        $this->assertNull($argument4->getTypeHinting());
    }

    /**
     * @test
     */
    public function createAnReferenceArgument()
    {
        $argument1 = new Stagehand_PHP_Class_Method_Argument('foo');
        $argument2 = new Stagehand_PHP_Class_Method_Argument('bar');
        $argument2->setReference();

        $this->assertFalse($argument1->isReference());
        $this->assertTrue($argument2->isReference());
    }

    /**
     * @test
     */
    public function renderArgument()
    {
        $argument = new Stagehand_PHP_Class_Method_Argument('foo');

        $this->assertEquals($argument->render(), '$foo');

        $argument->setRequirement(false);
        $argument->setValue(10);

        $this->assertEquals($argument->render(), '$foo = 10');

        $argument->setRequirement(true);
        $argument->setTypeHinting('array');

        $this->assertEquals($argument->render(), 'array $foo');

        $argument->setReference();

        $this->assertEquals($argument->render(), 'array &$foo');
    }

    /**
     * @test
     */
    public function useParsableValue()
    {
        $argument = new Stagehand_PHP_Class_Method_Argument('foo');
        $argument->setRequirement(false);
        $argument->setValue('Foo::value', true);

        $this->assertTrue($argument->isParsable());
        $this->assertEquals($argument->getValue(), 'Foo::value');
        $this->assertEquals($argument->render(), '$foo = Foo::value');

        $argument->setValue('Foo::value');

        $this->assertFalse($argument->isParsable());
        $this->assertEquals($argument->getValue(), 'Foo::value');
        $this->assertEquals($argument->render(), '$foo = \'Foo::value\'');
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
