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

use Gerh\Evesso\Domain\Validation\Result;

/**
 * Description of Authentication
 *
 * @author Henning Gerhardt
 */
class Authorization
{

    /**
     * @var string
     */
    private $authorizationCode = '';

    /**
     * @var string
     */
    protected $authorizePath = '/oauth/authorize';

    /**
     * @var string
     */
    private $clientId = '';

    /**
     * @var string
     */
    private $loginSystemUri = '';

    /**
     * @var string
     */
    private $secretKey = '';

    /**
     * @var string
     */
    protected $tokenPath = '/oauth/token';

    /**
     * @var string
     */
    protected $verifyPath = '/oauth/verify';

    /**
     * Return authorization code.
     *
     * @return string
     */
    public function getAuthorizationCode(): string
    {
        return $this->authorizationCode;
    }

    /**
     * Set authorization code.
     *
     * @param string $authorizationCode
     */
    public function setAuthorizationCode($authorizationCode)
    {
        $this->authorizationCode = $authorizationCode;
    }

    /**
     * Return authorize path.
     *
     * @return string
     */
    public function getAuthorizePath(): string
    {
        return $this->authorizePath;
    }

    /**
     * Return client id.
     *
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * Set client id.
     *
     * @param string $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * Return login system uri.
     *
     * @return string
     */
    public function getLoginSystemUri(): string
    {
        return $this->loginSystemUri;
    }

    /**
     * Set login system uri.
     *
     * @param string $loginSystemUri
     */
    public function setLoginSystemUri($loginSystemUri)
    {
        $this->loginSystemUri = $loginSystemUri;
    }

    /**
     * Return secret key.
     *
     * @return string
     */
    public function getSecretKey(): string
    {
        return $this->secretKey;
    }

    /**
     * Set secret key.
     *
     * @param string $secretKey
     */
    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * Return token path.
     *
     * @return string
     */
    public function getTokenPath(): string
    {
        return $this->tokenPath;
    }

    /**
     * Check if given values are correct.
     *
     * @return Result
     */
    public function isValid(): Result
    {
        if (empty($this->authorizationCode)) {
            return new Result('Authorization code is empty!', false);
        }

        if (empty($this->clientId)) {
            return new Result('Client id is empty!', false);
        }

        if (empty($this->loginSystemUri)) {
            return new Result('Login system uri is empty!', false);
        }

        if (empty($this->secretKey)) {
            return new Result('Secret key is empty!', false);
        }

        return new Result('Everything looks ok.', true);
    }

    /**
     * Return verify path.
     *
     * @return string
     */
    public function getVerifyPath(): string
    {
        return $this->verifyPath;
    }
}
