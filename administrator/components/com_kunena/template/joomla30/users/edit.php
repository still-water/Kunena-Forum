<?php
/**
 * Kunena Component
 * @package Kunena.Administrator.Template
 * @subpackage Users
 *
 * @copyright (C) 2008 - 2012 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.org
 **/
defined ( '_JEXEC' ) or die ();

$db = JFactory::getDBO();
$document = JFactory::getDocument();
if (JFactory::getLanguage()->isRTL()) $document->addStyleSheet ( JUri::base(true).'/components/com_kunena/media/css/admin.rtl.css' );
$document->addScriptDeclaration(' var current_count = '.JString::strlen($this->user->signature).'
var max_count = '.(int) $this->config->maxsig.'

function textCounter(field, target) {
	if (field.value.length > max_count) {
		field.value = field.value.substring(0, max_count);
	} else {
		current_count = max_count - field.value.length;
		target.value = current_count;
	}
}');

$paneOptions = array(
		'onActive' => 'function(title, description){
		description.setStyle("display", "block");
		title.addClass("tab-pane active").removeClass("tab-pane");
}',
		'onBackground' => 'function(title, description){
		description.setStyle("display", "none");
		title.addClass("tab-pane").removeClass("tab-pane active");
}',
		'startOffset' => 0,  // 0 starts on the first tab, 1 starts the second, etc...
		'useCookie' => true, // this must not be a string. Don't use quotes.
);
JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('dropdown.init');
JHtml::_('formbehavior.chosen', 'select');
?>
<div class="container-fluid">
<div class="row-fluid">
 <div class="span2">
	<div><?php include KPATH_ADMIN.'/template/joomla30/common/menu.php'; ?></div>
	</div>
		<!-- Right side -->
			<div class="span10">
            <div class="well well-small" style="min-height:120px;">
                       <div class="nav-header"><?php echo JText::_('COM_KUNENA_PROFFOR'); ?>: <?php echo $this->escape($this->user->name) .' ('. $this->escape($this->user->username) .')'; ?></div>
                         <div class="row-striped">
                         <br />				
		<form action="<?php echo KunenaRoute::_('administrator/index.php?option=com_kunena') ?>" method="post" id="adminForm" name="adminForm">
		<input type="hidden" name="view" value="users" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="1" />
		<input type="hidden" name="uid" value="<?php echo $this->user->userid; ?>" />
		<?php echo JHtml::_( 'form.token' ); ?>
             <article class="data-block">
			   <div class="data-container">
		<div class="tabbable" style="margin-bottom: 18px;">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab"><?php echo JText::_('COM_KUNENA_A_BASIC_SETTINGS'); ?></a></li>
                <li><a href="#tab2" data-toggle="tab"><?php echo JText::_('User Info'); ?></a></li>
                <li><a href="#tab3" data-toggle="tab"><?php echo JText::_('COM_KUNENA_MOD_NEW'); ?></a></li>
                <li><a href="#tab4" data-toggle="tab"><?php echo JText::_('COM_KUNENA_CATEGORY_SUBSCRIPTIONS'); ?></a></li>
                <li><a href="#tab5" data-toggle="tab"><?php echo JText::_('COM_KUNENA_TOPIC_SUBSCRIPTIONS'); ?></a></li>
                <li><a href="#tab6" data-toggle="tab"><?php echo JText::_('COM_KUNENA_TRASH_IP'); ?></a></li>
                <li><a href="#tab7" data-toggle="tab"><?php echo JText::_('Forum Settings'); ?></a></li>
              </ul>
              <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
              <div class="tab-pane  active" id="tab1">
			<fieldset>
				<table class="kadmin-adminform">
				<tr>
				<th colspan="2" class="title"><?php echo JText::_('COM_KUNENA_UAVATAR'); ?></th>
			</tr>
			<tr>
				<td class="contentpane">
                <div class="img-polaroid">
				<?php echo $this->avatar;
				
				if ($this->editavatar) { ?></div>
					<p><input type="checkbox" value="1"
					name="deleteAvatar" /> <em><?php echo JText::_('COM_KUNENA_DELAV'); ?></em></p></td>
				<?php } else {
					echo "<td>&nbsp;</td>";
					echo '<input type="hidden" value="" name="avatar" />';
				}
				?>

				<td><?php if ($this->editavatar) {
					 } else {
					echo "<td>&nbsp;</td>";
				}
				?></td>
			</tr>
		</table>

	</fieldset>
</div>
                <div class="tab-pane" id="tab2">
		<fieldset>
		<table class="kadmin-adminform">
			<tr class="krow2">
			<td class="kcol-first">Personal Text</td>
			<td class="kcol-mid"><input type="text" maxlength="50" name="personaltext" value="" /></td>
		</tr>
		<tr class="krow1">
			<td class="kcol-first">Birthdate</td>
						<td class="kcol-mid">
				<span class="editlinktip hasTip" title="Birthdate::Year (YYYY) - Month (MM) - Day (DD)" >
					<input type="text" size="4" maxlength="4" class="input-mini" name="birthdate1" value="0001" />
					<input type="text" size="2" maxlength="2" class="input-mini" name="birthdate2" value="01" />
					<input type="text" size="2" maxlength="2" class="input-mini" name="birthdate3" value="01" />
				</span>
			</td>
		</tr>
		<tr class="krow2">
			<td class="kcol-first">Location</td>
			<td class="kcol-mid"><input type="text" name="location" value="" /></td>
		</tr>
		<tr class="krow1">
			<td class="kcol-first">Gender</td>
			<td class="kcol-mid">
				<select id="gender" name="gender" class="inputbox" size="1">
	<option value="0" selected="selected">Unknown</option>
	<option value="1">Male</option>
	<option value="2">Female</option>
</select>
			</td>
		</tr>
		<tr class="krow2">
			<td class="kcol-first">Web site Name</td>
			<td class="kcol-mid">
				<span class="editlinktip hasTip" title="Web site Name::Example: Kunena" >
					<input type="text" name="websitename" value="" />
				</span>
			</td>
		</tr>
		<tr class="krow1">
			<td class="kcol-first">Web site URL</td>
			<td class="kcol-mid">
				<span class="editlinktip hasTip" title="Web site URL::Example: www.kunena.org" >
					<input type="text" name="websiteurl" value="" />
				</span>
			</td>
		</tr>
				<tr class="krow1">
			<td class="kcol-first">Twitter</td>
			<td class="kcol-mid">
				<span class="editlinktip hasTip" title="Twitter::This is your Twitter username." >
					<input type="text" name="twitter" value="" />
				</span>
			</td>
		</tr>
				<tr class="krow2">
			<td class="kcol-first">Facebook</td>
			<td class="kcol-mid">
				<span class="editlinktip hasTip" title="Facebook::This is your Facebook username." >
					<input type="text" name="facebook" value="" />
				</span>
			</td>
		</tr>
				<tr class="krow1">
			<td class="kcol-first">MySpace</td>
			<td class="kcol-mid">
				<span class="editlinktip hasTip" title="MySpace::This is your MySpace username." >
					<input type="text" name="myspace" value="" />
				</span>
			</td>
		</tr>
				<tr class="krow2">
			<td class="kcol-first">SKYPE</td>
			<td class="kcol-mid">
				<span class="editlinktip hasTip" title="SKYPE::This is your Skype handle." >
					<input type="text" name="skype" value="jelle810" />
				</span>
			</td>
		</tr>
				<tr class="krow1">
			<td class="kcol-first">Linkedin</td>
			<td class="kcol-mid">
				<span class="editlinktip hasTip" title="Linkedin::This is your LinkedIn username." >
					<input type="text" name="linkedin" value="" />
				</span>
			</td>
		</tr>
				<tr class="krow2">
			<td class="kcol-first">Delicious</td>
			<td class="kcol-mid">
				<span class="editlinktip hasTip" title="Delicious::This is your Delicious username." >
					<input type="text" name="delicious" value="" />
				</span>
			</td>
		</tr>
				<tr class="krow1">
			<td class="kcol-first">FriendFeed</td>
			<td class="kcol-mid">
				<span class="editlinktip hasTip" title="FriendFeed::This is your FriendFeed username." >
					<input type="text" name="friendfeed" value="" />
				</span>
			</td>
		</tr>
				<tr class="krow2">
			<td class="kcol-first">Digg</td>
			<td class="kcol-mid">
				<span class="editlinktip hasTip" title="Digg::This is your Digg username." >
					<input type="text" name="digg" value="" />
				</span>
			</td>
		</tr>
				<tr class="krow1">
			<td class="kcol-first">YIM</td>
			<td class="kcol-mid">
				<span class="editlinktip hasTip" title="YIM::This is your Yahoo! Instant Messenger nickname." >
					<input type="text" name="yim" value="" />
				</span>
			</td>
		</tr>
				<tr class="krow2">
			<td class="kcol-first">AIM</td>
			<td class="kcol-mid">
				<span class="editlinktip hasTip" title="AIM::This is your AOL Instant Messenger nickname." >
					<input type="text" name="aim" value="" />
				</span>
			</td>
		</tr>
				<tr class="krow1">
			<td class="kcol-first">GTALK</td>
			<td class="kcol-mid">
				<span class="editlinktip hasTip" title="GTALK::This is your Gtalk nickname." >
					<input type="text" name="gtalk" value="" />
				</span>
			</td>
		</tr>
				<tr class="krow2">
			<td class="kcol-first">ICQ</td>
			<td class="kcol-mid">
				<span class="editlinktip hasTip" title="ICQ::This is your ICQ number." >
					<input type="text" name="icq" value="" />
				</span>
			</td>
		</tr>
				<tr class="krow1">
			<td class="kcol-first">MSN</td>
			<td class="kcol-mid">
				<span class="editlinktip hasTip" title="MSN::Your MSN messenger e-mail address." >
					<input type="text" name="msn" value="" />
				</span>
			</td>
		</tr>
				<tr class="krow2">
			<td class="kcol-first">Blogger</td>
			<td class="kcol-mid">
				<span class="editlinktip hasTip" title="Blogger::This is your Blogger username." >
					<input type="text" name="blogspot" value="" />
				</span>
			</td>
		</tr>
				<tr class="krow1">
			<td class="kcol-first">Flickr</td>
			<td class="kcol-mid">
				<span class="editlinktip hasTip" title="Flickr::This is your Flickr username." >
					<input type="text" name="flickr" value="" />
				</span>
			</td>
		</tr>
				<tr class="krow2">
			<td class="kcol-first">Bebo</td>
			<td class="kcol-mid">
				<span class="editlinktip hasTip" title="Bebo::This is your Bebo member ID." >
					<input type="text" name="bebo" value="" />
				</span>
			</td>
		</tr>
			<tr>
				<td width="150" valign="top" class="contentpane"><?php echo JText::_('COM_KUNENA_GEN_SIGNATURE'); ?>:
				</td>
				<td align="left" valign="top" class="contentpane">
	<textarea class="inputbox" name="signature" cols="4" rows="6"
	onkeyup="textCounter(this, this.form.current_count);"><?php echo $this->escape( $this->user->signature ); ?></textarea>
	<br /><br />
	<div><?php echo JText::sprintf('COM_KUNENA_SIGNATURE_LENGTH_COUNTER', intval($this->config->maxsig),
			'<input readonly="readonly" type="text" name="current_count" value="'.(intval($this->config->maxsig)-JString::strlen($this->user->signature)).'" size="3" />');?>
	</div>
	<br />
	<div> <input type="checkbox" value="1" name="deleteSig" /> <em><?php echo JText::_('COM_KUNENA_DELSIG'); ?></em></div>

	</td>
	</tr>
	</table>
</fieldset>
</div>

<div class="tab-pane" id="tab3">
		<fieldset>
				<table class="kadmin-adminform">
					<tr>
						<th colspan="2" class="title"><?php echo JText::_('COM_KUNENA_MODCHANGE'); ?></th>
					</tr>
					<tr>
						<td width="150" class="contentpane"><?php echo JText::_('COM_KUNENA_ISMOD'); ?></td>
						<td><?php echo JText::_('COM_KUNENA_MODCATS'); ?></td>
					</tr>
					<tr>
						<td width="150" class="contentpane"><?php
						echo $this->selectMod;
						?>
						</td>
						<td><?php echo $this->modCats; ?></td>
					</tr>
				</table>
			</fieldset>
</div>
<div class="tab-pane" id="tab4">
			<fieldset>
				<table class="kadmin-adminform">
					<tr>
						<th colspan="2" class="title"><?php echo JText::_('COM_KUNENA_SUBFOR') . ' ' . $this->escape($this->user->username); ?></th>
					</tr>
					<?php
					$enum = 1; //reset value
					$k = 0; //value for alternating rows

					if (!empty($this->subscatslist)) {
						foreach($this->subscatslist as $subscats) { //get all category details for each subscription
							$db->setQuery ( "select cat.name AS catname, cat.id, msg.subject, msg.id, msg.catid, msg.name AS username from #__kunena_categories AS cat INNER JOIN #__kunena_messages AS msg ON cat.id=msg.catid where cat.id='$subscats->category_id' GROUP BY cat.id" );
							$catdetail = $db->loadObjectList ();
							if (KunenaError::checkDatabaseError()) break;

							foreach ( $catdetail as $cat ) {
								$k = 1 - $k;
								echo "<tr class=\"row$k\">";
								echo "  <td width=\"30\">$enum</td>";
								echo " <td><strong>" . $this->escape ( $cat->catname ) ."</strong>" ." &nbsp;". JText::_('COM_KUNENA_LAST_MESSAGE'). "<em>".$this->escape ( $cat->subject )."</em>" ." &nbsp;". JText::_('COM_KUNENA_BY') ." &nbsp;". "<em>".$this->escape ( $cat->username )."</em></td>";
								echo "</tr>";
								$enum ++;
							}
						}
					} else {
						echo "<tr><td class=\"message\">" . JText::_('COM_KUNENA_NOCATSUBS') . "</td></tr>";
					}
					?>
				</table>
			</fieldset>
</div>
<div class="tab-pane" id="tab5">
			<fieldset>
				<table class="kadmin-adminform">
					<tr>
						<th colspan="2" class="title"><?php echo JText::_('COM_KUNENA_SUBFOR') . ' ' . $this->escape($this->user->username); ?></th>
					</tr>
					<?php
						$enum = 1; //reset value
						$k = 0; //value for alternating rows


					if ($this->sub) {
						foreach ( $this->sub as $subs ) { //get all message details for each subscription
							$db->setQuery ( "select * from #__kunena_messages where id='$subs->thread'" );
							$subdet = $db->loadObjectList ();
							if (KunenaError::checkDatabaseError()) break;

							foreach ( $subdet as $sub ) {
								$k = 1 - $k;
								echo "<tr class=\"row$k\">";
								echo "  <td width=\"30\">$enum</td>";
								echo " <td><strong>" . $this->escape ( $sub->subject ) ."</strong>" ." &nbsp;". JText::_('COM_KUNENA_BY' ) ." &nbsp;". "<em>".$this->escape ( $sub->name )."</em></td>";
								echo "</tr>";
								$enum ++;
							}
						}
					} else {
						echo "<tr><td class=\"message\">" . JText::_('COM_KUNENA_NOSUBS') . "</td></tr>";
					}
					?>
				</table>
			</fieldset>
            </div>
            <div class="tab-pane" id="tab6">
			<fieldset>
				<table class="kadmin-adminform">
					<tr>
						<th colspan="3" class="title"><?php
						echo JText::sprintf('COM_KUNENA_IPFOR', $this->escape($this->user->username));
						?>
						</th>
					</tr>
					<?php
					$i = 0;
					$k = 0; //value for alternating rows

					$userids='';
					foreach ($this->ipslist as $ip => $list) {
						$k = 1 - $k;
						$i++;
						$userlist = array();
						$mescnt = 0;
						foreach ($list as $curuser) {
							if ($curuser->userid == $this->user->userid) {
								$mescnt += intval($curuser->mescnt);
								continue;
							}
							$userlist[] = $this->escape($curuser->username).' ('.$this->escape($curuser->mescnt).')';
						}
						$userlist = implode(', ', $userlist);
						echo "<tr class=\"row$k\">";
						echo "  <td width=\"30\">".$i."</td>";
						echo "  <td width=\"60\"><strong>".$this->escape($ip)."</strong></td>";
						echo "  <td>(".JText::sprintf('COM_KUNENA_IP_OCCURENCES', $mescnt).(!empty($userlist)?" ".JText::sprintf('COM_KUNENA_USERIDUSED', $this->escape($userlist)):'').")</td>";
						//echo "  <td>&nbsp;</td>";
						echo "</tr>";
					}
					?>
				</table>
			</fieldset>
</div>
<div class="tab-pane" id="tab7">
			<fieldset>
				<table class="kadmin-adminform">
			<tr>
				<td width="150" class="contentpane"><?php echo JText::_('COM_KUNENA_PREFOR'); ?></td>
				<td align="left" valign="top" class="contentpane"><?php echo $this->selectOrder; ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td width="150" class="contentpane"><?php echo JText::_('COM_KUNENA_RANKS'); ?></td>
				<td align="left" valign="top" class="contentpane"><?php echo $this->selectRank; ?></td>
				<td>&nbsp;</td>
			</tr>
				</table>
			</fieldset>
</div>
			<?php echo JHtml::_('tabs.end'); ?>
             </article>
</div>
</div>
	
    
    </form>
    </div>
    </div>
    </div>
	<div class="kadmin-footer center">
		<?php echo KunenaVersion::getLongVersionHTML (); ?>
	</div>
   </div>
    </div>