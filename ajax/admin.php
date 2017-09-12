<?php

/**
 * ownCloud - AfterLogic WebMail
 * @copyright 2002-2017 AfterLogic Corp.
 */

OCP\JSON::checkAdminUser();
OCP\JSON::checkAppEnabled('afterlogic');
OCP\JSON::callCheck();

if (isset($_POST['appname'], $_POST['afterlogic-url'], $_POST['afterlogic-path']) && 'afterlogic' === $_POST['appname'])
{
	OCP\Config::setAppValue('afterlogic', 'afterlogic-url', $_POST['afterlogic-url']);
	OCP\Config::setAppValue('afterlogic', 'afterlogic-path', $_POST['afterlogic-path']);

	OCP\JSON::success(array('Message' => 'Saved successfully'));
	return true;
}

OC_JSON::error(array('Message' => 'Invalid Argument(s)'));
return false;
