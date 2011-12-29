<?php defined('_JEXEC') || die('Direct access to this location is not allowed.'); ?>

<div id="mdlhdr_<?php echo $this_id ?>" class="mdlhdr_cont ninja-module-hider panel-<?php echo $params->get('panel') ?> <?php echo $params->get('mode', 'vertical') ?>">

	<?php if ($top_bot) echo $module->handle ?>

	<div class="nf-module ninja-module-hider initial-hide" id="ninja-module-hider-<?php echo $module->id ?>">
		<table id="nmz<?php echo $thisID;?>" class="nmzbody nmzhoriztable">
			<tr>  	
				<?php foreach($modIDArray as $mod) : ?>
					<td>
						<?php echo modNinjaModulehiderHelper::renderModule( $mod, $mod_style ) ?>
					</td>
				<?php endforeach ?>
			</tr>
		</table>
	</div>       
  
	<?php if (!$top_bot) echo $module->handle ?>
	
</div>
