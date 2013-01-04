<?php
/**
 * Kunena Component
 * @package Kunena.Administrator.Template
 * @subpackage PurgeRe
 *
 * @copyright (C) 2008 - 2012 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.org
 **/
defined ( '_JEXEC' ) or die ();
?>

<div class="container-fluid">
<div class="row-fluid">
 <div class="span2">
	<div><?php include KPATH_ADMIN.'/template/joomla30/common/menu.php'; ?></div>
	</div>
		<!-- Right side -->
			<div class="span10"><h4><?php echo JText::_('COM_KUNENA_A_PURGE_RE_STATEMENTS'); ?></h4>
		<form action="<?php echo KunenaRoute::_('administrator/index.php?option=com_kunena&view=tools') ?>" method="post" id="adminForm" name="adminForm">
				<input type="hidden" name="task" value="purgeReStatements" />
				<?php echo JHtml::_( 'form.token' ); ?>

				<fieldset>
					<legend><?php echo JText::_('COM_KUNENA_A_PURGE_RE_STATEMENTS'); ?></legend>
					<table class="kadmin-adminform">
						<tr>
							<td><?php echo JText::_('COM_KUNENA_A_PURGE_ENTER_RE_STATEMENTS'); ?><br />
							<input type="text" name="re_string" value="" />
							</td>
						</tr>
					</table>
				</fieldset>
			</form>
	</div>
	<div class="kadmin-footer">
		<?php echo KunenaVersion::getLongVersionHTML (); ?>
	</div>
</div>