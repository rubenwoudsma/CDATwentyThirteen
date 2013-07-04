<?php
/**
 * CDATwentyThirteen - Author profile adjustments
 * -------------------------------------------
 * Seperate file handling all the items for the author profile adjustments.
 *
 * @package CDATwentyThirteen
 * @since CDATwentyThirteen 1.0
 */
 
add_action('show_user_profile', 'cdatwentythirteen_show_user_profile');
add_action('edit_user_profile', 'cdatwentythirteen_show_user_profile');
add_action('personal_options_update', 'cdatwentythirteen_process_option_update');
add_action('edit_user_profile_update', 'cdatwentythirteen_process_option_update');


function cdatwentythirteen_profile_extras() {
	//Load scripts
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('profile-upload', get_template_directory_uri().'/inc/js/author-profile.js', array('jquery','media-upload','thickbox') );

	//Load styles
	wp_enqueue_style('thickbox');
}

global $pagenow;
if( in_array( $pagenow, array( 'profile.php' , 'user-edit.php' ) ) ) {
	add_action('admin_print_scripts', 'cdatwentythirteen_profile_extras');
}

function cdatwentythirteen_show_user_profile( $user ) {
	?>
	<h3><?php _e( 'CDA Author profile - Additional author settings', 'cdatwentythirteen' ); ?></h3>

	<table class="form-table">
		<tr>
			<th><label for="listposition"><?php _e( 'List position', 'cdatwentythirteen' ); ?></label></th>
			<td>
		  <select name="listposition" id="listposition">
					<?php
					echo '<option value=""' . (esc_attr(get_the_author_meta('listposition',$user->ID)) == '' ? ' selected="selected"' : '') . '>- Selecteer positie -</option>';

					for ($i = 1; $i <= 30; $i++)
					{
						echo '<option value="' . $i . '" ' . ($i == esc_attr(get_the_author_meta('listposition', $user->ID) ) ? 'selected="selected"' : '') . '>' . $i . '</option>';
					}
					?>
					</select>
					</td>
		</tr>
		<tr>
			<th><label for="subjects"><?php _e( 'Author subjects', 'cdatwentythirteen'); ?></label></th>
			<td>
			<?php
				
				$tax = get_taxonomy( 'subjects' );
	
				/* Get the terms of the 'subjects' taxonomy. */
				$terms = get_terms( 'subjects', array( 'hide_empty' => false ) );

				/* If there are any subjects terms, loop through them and display checkboxes. */
				if ( !empty( $terms ) ) {

					foreach ( $terms as $term ) { ?>
						<input type="checkbox" name="subjects[]" id="subjects-<?php echo esc_attr( $term->slug ); ?>" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( true, is_object_in_term( $user->ID, 'subjects', $term ) ); ?> /> <label for="subjects-<?php echo esc_attr( $term->slug ); ?>"><?php echo $term->name; ?></label> <br />
					<?php }
				}

				/* If there are no subject terms, display a message. */
				else {
					_e( 'There are no subjects available.', 'cdatwentythirteen' );
				}

			?>
			</td>
		</tr>
		<tr>
			<th><label for="phonenumber"><?php _e( 'Phone number', 'cdatwentythirteen' ); ?></label></th>
			<td><input type="text" name="phonenumber" id="phonenumber" value="<?php echo esc_attr(get_the_author_meta('phonenumber', $user->ID ) ); ?>" class="regular-text" /><span class="description">Vul hier een telefoonnummer in met het formaat <code>035-5212345</code>.</span></td>
		</tr>
		<tr>
			<th><label for="streetname"><?php _e( 'Street', 'cdatwentythirteen' ); ?></label></th>
			<td><input type="text" name="streetname" id="streetname" value="<?php echo esc_attr(get_the_author_meta('streetname', $user->ID ) ); ?>" class="regular-text" /></td>
		</tr>
		<tr>
			<th><label for="postalcode"><?php _e( 'Postal code', 'cdatwentythirteen' ); ?></label></th>
			<td><input type="text" name="postalcode" id="postalcode" value="<?php echo esc_attr(get_the_author_meta('postalcode', $user->ID ) ); ?>" class="regular-text" /></td>
		</tr>
		<tr>
			<th><label for="city"><?php _e( 'City', 'cdatwentythirteen' ); ?></label></th>
			<td><input type="text" name="city" id="city" value="<?php echo esc_attr(get_the_author_meta('city', $user->ID ) ); ?>" class="regular-text" /></td>
		</tr>
		<tr>
			<th><label for="maritalstatus"><?php _e( 'Marital Status', 'cdatwentythirteen' ); ?></label></th>
			<td><input type="text" name="maritalstatus" id="maritalstatus" value="<?php echo esc_attr(get_the_author_meta('maritalstatus', $user->ID) ); ?>" class="regular-text" /></td>
		</tr>
		<tr>
			<th><label for="religion"><?php _e( 'Religion', 'cdatwentythirteen' ); ?></label></th>
			<td><input type="text" name="religion" id="religion" value="<?php echo esc_attr(get_the_author_meta('religion', $user->ID) ); ?>" class="regular-text" /></td>
		</tr>
		<tr>
			<th><label for="education"><?php _e( 'Education', 'cdatwentythirteen' ); ?></label></th>
			<td><input type="text" name="education" id="education" value="<?php echo esc_attr(get_the_author_meta('education', $user->ID) ); ?>" class="regular-text" /></td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e( 'Author Image', 'cdatwentythirteen' ); ?></th>
			<td>
				<label for="upload_image">
					<input id="author_profile_image" type="text" size="36" name="author_profile_image" value="<?php the_author_meta( 'author_profile_image', $user->ID ); ?>" />
					<input id="author_profile_image_button" type="button" value="Upload Image" />
					<br /><?php _e( 'Enter a URL or upload an image to use in the author profile biography.', 'cdatwentythirteen' ); ?>
				</label>
				<br/>
				<img id="author_profile_image_preview" src="<?php the_author_meta( 'author_profile_image', $user->ID ); ?>" style="max-width:300px;" />
			</td>
		</tr>
	</table>
	<?php
}

function cdatwentythirteen_process_option_update( $user_id ) {

	$tax = get_taxonomy( 'subjects' );

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	update_user_meta( $user_id, 'listposition', ( isset($_POST['listposition']) ? $_POST['listposition'] : '' ) );
	update_user_meta( $user_id, 'phonenumber', ( isset($_POST['phonenumber']) ? $_POST['phonenumber'] : '' ) );
	update_user_meta( $user_id, 'streetname', ( isset($_POST['streetname']) ? $_POST['streetname'] : '' ) );
	update_user_meta( $user_id, 'postalcode', ( isset($_POST['postalcode']) ? $_POST['postalcode'] : '' ) );
	update_user_meta( $user_id, 'city', ( isset($_POST['city']) ? $_POST['city'] : '' ) );
	update_user_meta( $user_id, 'maritalstatus', ( isset($_POST['maritalstatus']) ? $_POST['maritalstatus'] : '' ) );
	update_user_meta( $user_id, 'religion', ( isset($_POST['religion']) ? $_POST['religion'] : '' ) );
	update_user_meta( $user_id, 'education', ( isset($_POST['education']) ? $_POST['education'] : '' ) );
	update_user_meta( $user_id, 'author_profile_image', $_POST['author_profile_image'] );
	
	$term = $_POST['subjects'];

	/* Sets the terms (we're just using a single term) for the user. */
	wp_set_object_terms( $user_id, $term, 'subjects', false);

	clean_object_term_cache( $user_id, 'subjects' );
	
}