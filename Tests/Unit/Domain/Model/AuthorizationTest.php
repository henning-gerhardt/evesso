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
namespace Gerh\Evesso\Domain\Model;

use TYPO3\CMS\Core\Tests\UnitTestCase;

class AuthorizationTest extends UnitTestCase
{

    /**
     * @test
     */
    public function classCouldBeEmptyInstiated()
    {
        $auth = new Authorization();

        $this->assertInstanceOf(Authorization::class, $auth);
    }

    /**
     * @test
     */
    public function authorizationCodeCouldBeSet()
    {
        $expected = 'auth code';

        $auth = new Authorization();
        $auth->setAuthorizationCode($expected);

        $this->assertEquals($expected, $auth->getAuthorizationCode());
    }

    /**
     * @test
     */
    public function authorizationCodeIsEmptyForNewClass()
    {
        $auth = new Authorization();

        $this->assertEmpty($auth->getAuthorizationCode());
    }

    /**
     * @test
     */
    public function authorizePathIsNotEmptyForNewClass()
    {
        $auth = new Authorization();

        $this->assertNotEmpty($auth->getAuthorizePath());
    }

    /**
     * @test
     */
    public function clientIdCouldBeSet()
    {
        $expected = 'client id 123456';

        $auth = new Authorization();
        $auth->setClientId($expected);

        $this->assertEquals($expected, $auth->getClientId());
    }

    /**
     * @test
     */
    public function clientIdIsEmptyForNewClass()
    {
        $auth = new Authorization();

        $this->assertEmpty($auth->getClientId());
    }

    /**
     * @test
     */
    public function isValidReturnsPositiveResult()
    {
        $auth = new Authorization();
        $auth->setAuthorizationCode('auth code 1');
        $auth->setClientId('client id 1');
        $auth->setLoginSystemUri('http://example.org');
        $auth->setSecretKey('secret key 1');

        /** @var $result \Gerh\Evesso\Domain\Validation\Result */
        $result = $auth->isValid();

        $this->assertNotEmpty($result->getMessage());
        $this->assertTrue($result->isResult());
    }

    /**
     * @test
     */
    public function isValidReturnsNegativeResultsWithoutAuthorizationCode()
    {
        $auth = new Authorization();

        /** @var $result \Gerh\Evesso\Domain\Validation\Result */
        $result = $auth->isValid();

        $this->assertNotEmpty($result->getMessage());
        $this->assertFalse($result->isResult());
    }

    /**
     * @test
     */
    public function isValidReturnsNegativeResultWithoutClientId()
    {
        $auth = new Authorization();
        $auth->setAuthorizationCode('auth code 1');

        /** @var $result \Gerh\Evesso\Domain\Validation\Result */
        $result = $auth->isValid();

        $this->assertNotEmpty($result->getMessage());
        $this->assertFalse($result->isResult());
    }

    /**
     * @test
     */
    public function isValidReturnsNegativeResultWithoutLoginSystemUri()
    {
        $auth = new Authorization();
        $auth->setAuthorizationCode('auth code 1');
        $auth->setClientId('client id 1');

        /** @var $result \Gerh\Evesso\Domain\Validation\Result */
        $result = $auth->isValid();

        $this->assertNotEmpty($result->getMessage());
        $this->assertFalse($result->isResult());
    }

    /**
     * @test
     */
    public function isValidReturnsNegativeResultWithoutSecretKey()
    {
        $auth = new Authorization();
        $auth->setAuthorizationCode('auth code 1');
        $auth->setClientId('client id 1');
        $auth->setLoginSystemUri('http://example.org');

        /** @var $result \Gerh\Evesso\Domain\Validation\Result */
        $result = $auth->isValid();

        $this->assertNotEmpty($result->getMessage());
        $this->assertFalse($result->isResult());
    }

    /**
     * @test
     */
    public function loginSystemUriCouldBeSet()
    {
        $expected = 'http://example.org';

        $auth = new Authorization();
        $auth->setLoginSystemUri($expected);

        $this->assertEquals($expected, $auth->getLoginSystemUri());
    }

    /**
     * @test
     */
    public function loginSystemUriIsEmptyForNewClass()
    {
        $auth = new Authorization();

        $this->assertEmpty($auth->getLoginSystemUri());
    }

    /**
     * @test
     */
    public function secretKeyCouldBeSet()
    {
        $expected = 'secret key 0987654321';

        $auth = new Authorization();
        $auth->setSecretKey($expected);

        $this->assertEquals($expected, $auth->getSecretKey());
    }

    /**
     * @test
     */
    public function secretKeyIsEmptyForNewClass()
    {
        $auth = new Authorization();

        $this->assertEmpty($auth->getSecretKey());
    }

    /**
     * @test
     */
    public function tokenPathIsNotEmptyForNewInstance()
    {
        $auth = new Authorization();

        $this->assertNotEmpty($auth->getTokenPath());
    }

    /**
     * @test
     */
    public function verifyPathIsNotEmptyForNewInstance()
    {
        $auth = new Authorization();

        $this->assertNotEmpty($auth->getVerifyPath());
    }
}
