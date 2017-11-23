<?php
/*
 * Copyright notice
 *
 * (c) 2017 Henning Gerhardt
 *
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 3
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
namespace Gerh\Evesso\Domain\Validation;

use InvalidArgumentException;
use TYPO3\CMS\Core\Tests\UnitTestCase;

class ResultTest extends UnitTestCase
{

    /**
     * @ignore
     */
    public function classCanNotEmptyBeInstiated()
    {
        $result = new Result();

        $this->assertInstanceOf(Result::class, $result);
        $this->assertEmpty($result->getMessage());
        $this->assertTrue($result->isResult());
    }

    /**
     * @test
     */
    public function classCanBeInstiated()
    {
        $result = new Result('', false);

        $this->assertInstanceOf(Result::class, $result);
    }

    /**
     * @test
     */
    public function validResult()
    {
        $expectedMessage = 'valid validation';
        $expectedResult = true;
        $result = new Result($expectedMessage, $expectedResult);

        $this->assertEquals($expectedMessage, $result->getMessage());
        $this->assertEquals($expectedResult, $result->isResult());
    }

    /**
     * @test
     */
    public function invalidResult()
    {
        $expectedMessage = 'invalid validation';
        $expectedResult = false;
        $result = new Result($expectedMessage, $expectedResult);

        $this->assertEquals($expectedMessage, $result->getMessage());
        $this->assertEquals($expectedResult, $result->isResult());
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function notBooleanResultThrowsException()
    {
        $expectedMessage = 'invalid result';
        $expectedResult = 'bla';
        new Result($expectedMessage, $expectedResult);
    }
}
