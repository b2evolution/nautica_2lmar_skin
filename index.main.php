<?php
/**
 * This is the main/default page template for the "custom" skin.
 *
 * This skin only uses one single template which includes most of its features.
 * It will also rely on default includes for specific dispays (like the comment form).
 *
 * For a quick explanation of b2evo 2.0 skins, please start here:
 * {@link http://manual.b2evolution.net/Skins_2.0}
 *
 * The main page template is used to display the blog when no specific page template is available
 * to handle the request (based on $disp).
 *
 * @package evoskins
 * @subpackage nautica2l marine
 *
 * @version $Id: index.main.php,v 1.9 2007/11/03 23:54:39 fplanque Exp $
 */
if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );

// This is the main template; it may be used to display very different things.
// Do inits depending on current $disp:
skin_init( $disp );


// -------------------------- HTML HEADER INCLUDED HERE --------------------------
skin_include( '_html_header.inc.php' );
// Note: You can customize the default HTML header by copying the generic
// /skins/_html_header.inc.php file into the current skin folder.
// -------------------------------- END OF HEADER --------------------------------
?>


<?php
// ------------------------- BODY HEADER INCLUDED HERE --------------------------
skin_include( '_body_header.inc.php' );
// Note: You can customize the default BODY heder by copying the generic
// /skins/_body_footer.inc.php file into the current skin folder.
// ------------------------------- END OF FOOTER --------------------------------
?>

<div id="wrapper-content">
	<div id="wrapper-menu-page">
		<?php
		// ------------------------- SIDEBAR INCLUDED HERE --------------------------
		skin_include( '_sidebar_right.inc.php' );
		// Note: You can customize the default BODY footer by copying the
		// _body_footer.inc.php file into the current skin folder.
		// ----------------------------- END OF SIDEBAR -----------------------------
		?>
	</div>
	
	<div id="content">
		<div id="content_layout">
			<!-- =================================== START OF MAIN AREA =================================== -->
			<div class="bPosts">

				<?php
					// ------------------------- MESSAGES GENERATED FROM ACTIONS -------------------------
					messages( array(
							'block_start' => '<div class="action_messages">',
							'block_end'   => '</div>',
						) );
					// --------------------------------- END OF MESSAGES ---------------------------------
				?>

				<?php
					// ------------------- PREV/NEXT POST LINKS (SINGLE POST MODE) -------------------
					item_prevnext_links( array(
							'block_start' => '<table class="prevnext_post"><tr>',
							'prev_start'  => '<td>',
							'prev_end'    => '</td>',
							'next_start'  => '<td class="right">',
							'next_end'    => '</td>',
							'block_end'   => '</tr></table>',
						) );
					// ------------------------- END OF PREV/NEXT POST LINKS -------------------------
				?>

				<?php
					// ------------------------ TITLE FOR THE CURRENT REQUEST ------------------------
					request_title( array(
							'title_before'=> '<h2>',
							'title_after' => '</h2>',
							'title_none'  => '',
							'glue'        => ' - ',
							'title_single_disp' => false,
							'title_page_disp' => false,
							'format'      => 'htmlbody',
						) );
					// ----------------------------- END OF REQUEST TITLE ----------------------------
				?>

				<?php
					// --------------------------------- START OF POSTS -------------------------------------
					// Display message if no post:
					display_if_empty();

					while( $Item = & mainlist_get_item() )
					{	// For each blog post, do everything below up to the closing curly brace "}"
					?>

						<div class="bPost bPost<?php $Item->status_raw() ?>" lang="<?php $Item->lang() ?>">

							<?php
								$Item->locale_temp_switch(); // Temporarily switch to post locale (useful for multilingual blogs)
								$Item->anchor(); // Anchor for permalinks to refer to.
							?>

							<h2 class="bTitle"><?php $Item->title(); ?></h2>

							<?php
								// ---------------------- POST CONTENT INCLUDED HERE ----------------------
								skin_include( '_item_content.inc.php', array(
										'image_size'	=>	'fit-400x320',
									) );
								// Note: You can customize the default item feedback by copying the generic
								// /skins/_item_feedback.inc.php file into the current skin folder.
								// -------------------------- END OF POST CONTENT -------------------------
							?>

							<?php
								// List all tags attached to this post:
								$Item->tags( array(
										'before' =>         '<div class="bSmallPrint">'.T_('Tags').': ',
										'after' =>          '</div>',
										'separator' =>      ', ',
									) );
							?>

							<div class="bSmallPrint">
								
								<?php
									$Item->author( array(
											'before'    => ' '.T_('by').' <big>',
											'after'     => '</big>',

										) );	echo '<br>';				
									$Item->issue_date( array(
											'before'    => ' ',
											'after'     => '',
										)); echo '. ';

									$Item->issue_time( array(
											'before'    => ' ',
											'after'     => '',
										)); echo '. ';


									$Item->wordcount();
									echo ' '.T_('words');
									echo ', ';
									$Item->views(); echo '. ';

								?>

								<?php
									$Item->categories( array(
										'before'          => T_('Categories').': ',
										'after'           => ' ',
										'include_main'    => true,
										'include_other'   => true,
										'include_external'=> true,
										'link_categories' => true,
									) );
								?>
								,
								
								<?php

									// Link to comments, trackbacks, etc.:
									$Item->feedback_link( array(
													'type' => 'comments',
													'link_before' => '',
													'link_after' => '',
													'link_text_zero' => '#',
													'link_text_one' => '#',
													'link_text_more' => '#',
													'link_title' => '#',
													'use_popup' => false,
												) );

									// Link to comments, trackbacks, etc.:
									$Item->feedback_link( array(
													'type' => 'trackbacks',
													'link_before' => ' &bull; ',
													'link_after' => '',
													'link_text_zero' => '#',
													'link_text_one' => '#',
													'link_text_more' => '#',
													'link_title' => '#',
													'use_popup' => false,
												) );

									$Item->edit_link( array( // Link to backoffice for editing
											'before'    => ' &bull; ',
											'after'     => '',
										) );
								?>
							</div>

							<?php
								// ------------------ FEEDBACK (COMMENTS/TRACKBACKS) INCLUDED HERE ------------------
								skin_include( '_item_feedback.inc.php', array(
										'before_section_title' => '<h4>',
										'after_section_title'  => '</h4>',
									) );
								// Note: You can customize the default item feedback by copying the generic
								// /skins/_item_feedback.inc.php file into the current skin folder.
								// ---------------------- END OF FEEDBACK (COMMENTS/TRACKBACKS) ---------------------
							?>

							<?php
								locale_restore_previous();	// Restore previous locale (Blog locale)
							?>
						</div>
					<?php
					} // ---------------------------------- END OF POSTS ------------------------------------
					?>

					<?php
						// -------------------- PREV/NEXT PAGE LINKS (POST LIST MODE) --------------------
						mainlist_page_links( array(
							'block_start' => '<p class="center"><strong>',
							'block_end' => '</strong></p>',
				   			'prev_text' => '&lt;&lt;',
				   			'next_text' => '&gt;&gt;',
							) );
						// ------------------------- END OF PREV/NEXT PAGE LINKS -------------------------
					?>


					<?php
						// -------------- MAIN CONTENT TEMPLATE INCLUDED HERE (Based on $disp) --------------
						skin_include( '$disp$', array(
								'disp_posts'  => '',		// We already handled this case above
								'disp_single' => '',		// We already handled this case above
								'disp_page'   => '',		// We already handled this case above
							) );
						// Note: you can customize any of the sub templates included here by
						// copying the matching php file into your skin directory.
						// ------------------------- END OF MAIN CONTENT TEMPLATE ---------------------------
				?>
			</div>
		</div>
	</div>

	<!-- =================================== START OF FOOTER =================================== -->
	<div id="wrapper-footer">
		<div id="footer">
			<?php
				// Display container and contents:
				skin_container( NT_("Footer"), array(
						// The following params will be used as defaults for widgets included in this container:
					) );
				// Note: Double quotes have been used around "Footer" only for test purposes.
			?>
			<p class="baseline">
				<?php
					// Display a link to contact the owner of this blog (if owner accepts messages):
					$Blog->contact_link( array(
							'before'      => '',
							'after'       => ' &bull; ',
							'text'   => T_('Contact'),
							'title'  => T_('Send a message to the owner of this blog...'),
						) );
				?>
				Design by <a href="http://www.studio7designs.com">studio7designs</a>&nbsp;|&nbsp;
				evoskin by <a href="http://www.brendoman.com/dbc" title="Danny's Blog Cabin">Danny Ferguson</a>&nbsp;|&nbsp;
				powered by <a href="http://b2evolution.net" title="The multilingual multiuser multi-blog engine.">b<sub>2</sub>evolution</a>&nbsp;|&nbsp;
				Marine by <a href="http://www.betz.lu">Charles Betz</a>
				<br />

				<?php
					// Display additional credits (see /conf/):
		 			// If you can add your own credits without removing the defaults, you'll be very cool :))
				 	// Please leave this at the bottom of the page to make sure your blog gets listed on b2evolution.net
					credits( array(
							'list_start'  => T_('Credits').': ',
							'list_end'    => ' ',
							'separator'   => '|',
							'item_start'  => ' ',
							'item_end'    => ' ',
						) );
				?>
			</p>
		</div>
	</div>
</div>

<?php
	// ------------------------- HTML FOOTER INCLUDED HERE --------------------------
	skin_include( '_html_footer.inc.php' );
	// Note: You can customize the default HTML footer by copying the
	// _html_footer.inc.php file into the current skin folder.
	// ------------------------------- END OF FOOTER --------------------------------
?>