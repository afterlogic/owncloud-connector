<?php

/**
 * ownCloud - AfterLogic WebMail
 * @copyright 2002-2017 AfterLogic Corp.
 */

OCP\User::checkAdminUser();

OCP\Util::addScript('afterlogic', 'afterlogic');

$oTemplate = new OCP\Template('afterlogic', 'admin');
$oTemplate->assign('afterlogic-url', OCP\Config::getAppValue('afterlogic', 'afterlogic-url', ''));
$oTemplate->assign('afterlogic-path', OCP\Config::getAppValue('afterlogic', 'afterlogic-path', ''));
return $oTemplate->fetchPage();
