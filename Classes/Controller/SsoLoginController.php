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
namespace Gerh\Evesso\Controller;

use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class SsoLoginController extends ActionController
{

    /**
     * @var string
     */
    protected $authorizePath = '/oauth/authorize';

    /**
     * @var string
     */
    protected $tokenPath = '/oauth/token';

    /**
     * @var string
     */
    protected $verifyPath = '/oauth/verify';

    /**
     * action index
     *
     * @return void
     */
    public function indexAction()
    {

        $loginSystem = $this->settings['loginSystem'];
        $clientId = $this->settings['clientId'];

        $showSubmitButton = \TRUE;
        if (empty($loginSystem) || empty($clientId)) {
            $message = 'Plugin not configured!';
            $this->addFlashMessage($message, '', AbstractMessage::ERROR);
            $showSubmitButton = \FALSE;
        }

        // hard coding values to get SSO working
        $noCache = \TRUE;
        $noCacheHash = \FALSE;

        $redirectUri = $this->uriBuilder
            ->setCreateAbsoluteUri(\TRUE)
            ->setNoCache($noCache)
            ->setUseCacheHash($noCacheHash)
            ->uriFor('callback');

        $authUri = $loginSystem . $this->authorizePath;

        $this->view->assign('authUri', $authUri);
        $this->view->assign('redirectUri', $redirectUri);
        $this->view->assign('clientId', $clientId);
        $this->view->assign('noCache', $noCache);
        $this->view->assign('noCacheHash', $noCacheHash);
        $stateId = \uniqid();
        $this->view->assign('state', $stateId);
        $this->view->assign('showSubmitButton', $showSubmitButton);
        $this->view->assign('showCallbackLink', $this->settings['showCallbackLink']);

        if ($GLOBALS["TSFE"]->loginUser) {
            $GLOBALS["TSFE"]->fe_user->setKey("user", "EveStateId", $stateId);
        } else {
            $GLOBALS["TSFE"]->fe_user->setKey("ses", "EveStateId", $stateId);
        }
    }

    /**
     * call back action
     *
     * @return void
     */
    public function callbackAction()
    {
        if ($GLOBALS["TSFE"]->loginUser) {
            $eveStateId = $GLOBALS["TSFE"]->fe_user->getKey('user', 'EveStateId');
        } else {
            $eveStateId = $GLOBALS["TSFE"]->fe_user->getKey('ses', 'EveStateId');
        }

        $loginSystem = $this->settings['loginSystem'];
        $clientId = $this->settings['clientId'];
        $secretKey = $this->settings['secretKey'];

        $backStateId = GeneralUtility::_GET('state');
        $codeValue = GeneralUtility::_GET('code');

        if (empty($loginSystem) || empty($clientId) || empty($secretKey)) {
            $this->addFlashMessage('Plugin not configured', '', AbstractMessage::ERROR);
            return;
        }

        if ($backStateId !== $eveStateId) {
            $this->addFlashMessage('Wrong state is returned back!', '', AbstractMessage::ERROR);
            return;
        }

        if (empty($codeValue)) {
            $this->addFlashMessage('No authorization code returned!', '', AbstractMessage::ERROR);
            return;
        }

        $this->addFlashMessage('Everything looks nice - but nothing has done yet with the data!');
    }
}
