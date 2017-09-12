<?php

/**
 * ownCloud - AfterLogic WebMail
 * @copyright 2002-2017 AfterLogic Corp.
 */

OCP\App::registerAdmin('afterlogic', 'admin');
OCP\App::registerPersonal('afterlogic', 'personal');

$sUrl = trim(OCP\Config::getAppValue('afterlogic', 'afterlogic-url', ''));
$sPath = trim(OCP\Config::getAppValue('afterlogic', 'afterlogic-path', ''));

if (('' !== $sUrl && '' !== $sPath) || OC_User::isAdminUser(OC_User::getUser()))
{
	OCP\Util::addScript('afterlogic', 'afterlogic');

	OCP\App::addNavigationEntry(array(
		'id' => 'afterlogic_index',
		'order' => 10,
		'href' => OCP\Util::linkTo('afterlogic', 'index.php'),
		'icon' => OCP\Util::imagePath('afterlogic', 'mail.svg'),
		'name' => 'Mail'
	));
}
