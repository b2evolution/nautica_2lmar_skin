<?php
/**
 * This is the BODY header include template.
 *
 * For a quick explanation of b2evo 2.0 skins, please start here:
 * {@link http://manual.b2evolution.net/Skins_2.0}
 *
 * This is meant to be included in a page template.
 *
 * @package evoskins
 * @subpackage Nautica2l marine
 */
if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );

?>

<div id="outer_wrap">
<div id="wrap">



<div id="menu-top">
	<ul>
<?php
		// Display container and contents:
		skin_container( NT_('Menu'), array(
				// The following params will be used as defaults for widgets included in this container:
				'block_start' => '',
				'block_end' => '',
				'block_display_title' => false,
				'list_start' => '',
				'list_end' => '',
				'item_start' => '<li class="$wi_class$">',
				'item_end' => '</li>',
			) );
	?>
	</ul>
</div>

<div id="wrapper-header">
	<div id="header">
		<div id="wrapper-header2">	
		<div id="wrapper-header3">	
		<?php
		// ------------------------- "Header" CONTAINER EMBEDDED HERE --------------------------
		// Display container and contents:
		skin_container( NT_('Header'), array(
				// The following params will be used as defaults for widgets included in this container:
				'block_start' => '<div class="$wi_class$">',
				'block_end' => '</div>',
				'block_title_start' => '<h1>',
				'block_title_end' => '</h1>',
			) );
		// ----------------------------- END OF "Header" CONTAINER -----------------------------
	?>
	</div>
	</div>
	</div>
</div>


