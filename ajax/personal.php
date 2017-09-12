<?php

/**
 * ownCloud - AfterLogic WebMail
 * @copyright 2002-2017 AfterLogic Corp.
 */

OCP\JSON::checkLoggedIn();
OCP\JSON::checkAppEnabled('afterlogic');
OCP\JSON::callCheck();

if (isset($_POST['appname'], $_POST['afterlogic-password'], $_POST['afterlogic-email'], $_POST['afterlogic-login']) && 'afterlogic' === $_POST['appname'])
{
	$sUser = OCP\User::getUser();

	$sEmail = $_POST['afterlogic-email'];
	$sLogin = $_POST['afterlogic-login'];

	OCP\Config::setUserValue($sUser, 'afterlogic', 'afterlogic-email', $sEmail);
	OCP\Config::setUserValue($sUser, 'afterlogic', 'afterlogic-login', $sLogin);

	$sPass = $_POST['afterlogic-password'];
	if ('******' !== $sPass)
	{
		include_once OC_App::getAppPath('afterlogic').'/functions.php';
		
		OCP\Config::setUserValue($sUser, 'afterlogic', 'afterlogic-password',
			aftEncodePassword($sPass, md5($sEmail)));
	}

	OCP\JSON::success(array('Message' => 'Saved successfully'));
	return true;
}

OC_JSON::error(array('Message' => 'Invalid argument(s)'));
return false;
