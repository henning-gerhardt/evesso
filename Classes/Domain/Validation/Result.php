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

class Result
{

    /**
     * @var string
     */
    private $message;

    /**
     * @var bool
     */
    private $result;

    /**
     * Class constructor for setting a validation result.
     *
     * @param string $message
     * @param bool $result
     * @throws InvalidArgumentException thrown, if result is not a boolean value
     */
    public function __construct($message, $result)
    {
        $this->message = $message;

        if (\is_bool($result)) {
            $this->result = \boolval($result);
        } else {
            throw new InvalidArgumentException('Given result is not a boolean value!');
        }
    }

    /**
     * Return validation message.
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Return validation result.
     *
     * @return bool
     */
    public function isResult(): bool
    {
        return $this->result;
    }
}
