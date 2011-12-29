<?php defined( '_JEXEC' ) or die( JText::_('Restricted access') ) ?>

<div id="mdlhdr_<?php echo $this_id ?>" class="mdlhdr_cont ninja-module-hider panel-<?php echo $params->get('panel') ?> <?php echo $params->get('mode', 'vertical') ?>">

	<?php if ($top_bot) echo $module->handle ?>
	
	<div class="nf-module ninja-module-hider initial-hide" id="ninja-module-hider-<?php echo $module->id ?>">
	<?php foreach($modIDArray as $mod) : ?>
	
		<?php echo modNinjaModulehiderHelper::renderModule( $mod, $mod_style ) ?>
			
	<?php endforeach ?>
	</div>
	
	<?php if (!$top_bot) echo $module->handle ?>
	
</div>