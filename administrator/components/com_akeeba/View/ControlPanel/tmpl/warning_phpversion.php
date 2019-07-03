<?php
/**
 * @package   AkeebaBackup
 * @copyright Copyright (c)2006-2017 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

/** @var $this \Akeeba\Backup\Admin\View\ControlPanel\Html */

// Protect from unauthorized access
defined('_JEXEC') or die();

?>
<?php /* Old PHP version reminder */ ?>
<?php if(version_compare(PHP_VERSION, '5.5.0', 'lt')): ?>
	<?php
	JLoader::import('joomla.utilities.date');
	$akeebaCommonDatePHP = new JDate('2015-09-03 00:00:00', 'GMT');
	$akeebaCommonDateObsolescence = new JDate('2016-06-03 00:00:00', 'GMT');
	?>
	<div id="phpVersionCheck" class="alert alert-warning">
		<h3><?php echo \JText::_('COM_AKEEBA_COMMON_PHPVERSIONTOOOLD_WARNING_TITLE'); ?></h3>
		<p>
			<?php echo \JText::sprintf(
				'COM_AKEEBA_COMMON_PHPVERSIONTOOOLD_WARNING_BODY',
				PHP_VERSION,
				$akeebaCommonDatePHP->format(JText::_('DATE_FORMAT_LC1')),
				$akeebaCommonDateObsolescence->format(JText::_('DATE_FORMAT_LC1')),
				'5.6'
			); ?>
		</p>
	</div>
<?php endif; ?>