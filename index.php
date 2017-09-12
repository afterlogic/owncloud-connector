<?php

/**
 * ownCloud - AfterLogic WebMail
 * @copyright 2002-2017 AfterLogic Corp.
 */

OCP\User::checkLoggedIn();
OCP\App::checkAppEnabled('afterlogic');
OCP\App::setActiveNavigationEntry('afterlogic_index');

$sUrl = trim(OCP\Config::getAppValue('afterlogic', 'afterlogic-url', ''));
$sPath = trim(OCP\Config::getAppValue('afterlogic', 'afterlogic-path', ''));

if ('' === $sUrl || '' === $sPath)
{
	$oTemplate = new OCP\Template('afterlogic', 'not-configured', 'user');
}
else
{
	$sUser = OCP\User::getUser();

	$sEmail = OCP\Config::getUserValue($sUser, 'afterlogic', 'afterlogic-email', '');
	$sLogin = OCP\Config::getUserValue($sUser, 'afterlogic', 'afterlogic-login', '');
	$sPassword = OCP\Config::getUserValue($sUser, 'afterlogic', 'afterlogic-password', '');

	include_once OC_App::getAppPath('afterlogic').'/functions.php';
	
	$sPassword = aftDecodePassword($sPassword, md5($sEmail));
	$sSsoHash = aftSsoKey($sPath, $sEmail, $sPassword, $sLogin);

	$sUrl = rtrim($sUrl, '/\\');
	if ('.php' !== strtolower(substr($sUrl, -4)))
	{
		$sUrl .= '/';
	}
	
	$sResultUrl = empty($sSsoHash) ? $sUrl.'?sso' : $sUrl.'?sso&hash='.$sSsoHash;

	$oTemplate = new OCP\Template('afterlogic', 'iframe', 'user');
	$oTemplate->assign('afterlogic-url', $sResultUrl);
}

$oTemplate->printpage();
