<?php

/**
 * ownCloud - AfterLogic WebMail
 * @copyright 2002-2017 AfterLogic Corp.
 */

OCP\User::checkLoggedIn();
OCP\App::checkAppEnabled('afterlogic');

OCP\Util::addScript('afterlogic', 'afterlogic');

$sUrl = trim(OCP\Config::getAppValue('afterlogic', 'afterlogic-url', ''));
$sPath = trim(OCP\Config::getAppValue('afterlogic', 'afterlogic-path', ''));

if ('' === $sUrl || '' === $sPath)
{
	$oTemplate = new OCP\Template('afterlogic', 'empty');
}
else
{
	$sUser = OCP\User::getUser();

	$oTemplate = new OCP\Template('afterlogic', 'personal');

	$sEmail = OCP\Config::getUserValue($sUser, 'afterlogic', 'afterlogic-email', '');
	$sLogin = OCP\Config::getUserValue($sUser, 'afterlogic', 'afterlogic-login', '');

	include_once OC_App::getAppPath('afterlogic').'/functions.php';
	
	$sPassword = OCP\Config::getUserValue($sUser, 'afterlogic', 'afterlogic-password', '');
	$sPassword = aftDecodePassword($sPassword, md5($sEmail));

	$oTemplate->assign('afterlogic-email', $sEmail);
	$oTemplate->assign('afterlogic-login', $sLogin);
	$oTemplate->assign('afterlogic-password', 0 === strlen($sPassword) ? '' : '******');
}

return $oTemplate->fetchPage();
