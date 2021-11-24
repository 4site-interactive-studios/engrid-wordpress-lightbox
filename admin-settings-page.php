<?php
	function fsedl_render_text_input($label, $name, $value) {
		$unique_id = 'input-' . uniqid();
		echo "
		<label for='$unique_id '>$label</label>
		<input id='$unique_id ' type='text' name='$name' value='$value' placeholder='$label' />
		";
	}
	function fsedl_render_textarea_input($label, $name, $value) {
		$unique_id = 'input-' . uniqid();
		echo "
		<label for='$unique_id '>$label</label>
		<textarea id='$unique_id 'name='$name' placeholder='$label' rows='8'>$value</textarea>
		";		
	}
	function fsedl_render_checkbox_input($label, $name, $checked) {
		$unique_id = 'input-' . uniqid();
		$checked = ($checked) ? 'checked' : '';
		echo "
		<label for='$unique_id'>$label
		<input id='$unique_id' type='checkbox' name='$name' value='true' $checked />
		</label>
		";
	}
?>
<h1><?php echo get_admin_page_title(); ?></h1>

<?php if(is_array($messages) && count($messages)): ?>
	<div class='messages'>
		<?php foreach($messages as $message): ?>
			<div class='message'><?php echo $message; ?></div>
		<?php endforeach; ?>		
	</div>
<?php endif; ?>

<hr>
<h2>How to Use</h2>
<p>To have the lightbox display automatically on a page when a user visits, fill out the below fields and then use the shortcode: <code>[en_donation_lightbox]</code>.</p>
<p>You can override the fields for an individual page by specifying them as attributes on the shortcode.<br><br>
	<strong>Example:</strong> <code>[en_donation_lightbox url='https://somedomain.com/overridden-by-this-string/1' title='Overridden by this String' script='https://somedomain.com/overridden-by-this-string.js' image='https://somedomain.com/overridden-by-this-string.jpg' logo='https://somedomain.com/overridden-by-this-string.jpg' footer='Overridden by this string'].</code><br><br>

	<strong>NOTE:</strong> To override the 'paragraph' field, the procedure is a little different.  You must set the shortcode to have both an open and close tag, and set the paragraph content in-between.<br><br>
	<strong>Example:</strong> <code>[en_donation_lightbox url='https://somedomain.com/overridden-by-this-string/1' title='Overridden by this String' script='https://somedomain.com/overridden-by-this-string.js' image='https://somedomain.com/overridden-by-this-string.jpg' logo='https://somedomain.com/overridden-by-this-string.jpg' footer='Overridden by this string']This is my overridden content for the lightbox.[/en_donation_lightbox]</code>
</p>
<p>
	Additionally, you have the option of adding data attributes to &lt;a&gt; tags (links) in your page, so that a click of that link will open a donation form modal.  You <strong>MUST</strong> have the "autoload" field checked to use this feature (see below form).<br><br>
	<strong>Example:</strong> <code>
		&lt;a href='https://domain.com/link-to-the-form/1' data-donation-lightbox data-title='your-title' data-paragraph='your-paragraph-content' data-image='https://domain.com/link-to-your-image.jpg' data-footer='your-footer-content' data-logo='https://domain.com/link-to-your-logo.svg'&gt;Click here&lt;/a&gt;
	</code>
</p>
<hr>

<h2>Donation Form Default Settings</h2>

<form method='POST'>
	<?php wp_nonce_field('fsedl-settings'); ?>
	<?php fsedl_render_text_input('Script',			'script',	$script);	?>
	<?php fsedl_render_text_input('URL',			'url',		$url);		?>
	<?php fsedl_render_text_input('Title',			'title',	$title);	?>
	<?php fsedl_render_textarea_input('Paragraph',	'paragraph',$paragraph);?>
	<?php fsedl_render_text_input('Image',			'image',	$image);	?>
	<?php fsedl_render_text_input('Logo',			'logo',		$logo);		?>
	<?php fsedl_render_text_input('Footer',			'footer',	$footer);	?>
	<?php fsedl_render_checkbox_input('Autoload',	'autoload',	$autoload); ?>
	<?php fsedl_render_checkbox_input('Sitewide',	'sitewide',	$sitewide); ?>
	<input type='submit' value='Update' />
</form>
<style>
	form label {
		display:  block;		
	}
	form input, form textarea {
		width:  100%;
		max-width:  600px;
		display:  block;
	}
	form input, form textarea, form label {
		margin-bottom:  12px;
	}
	.messages .message {
		background-color:  red;
		color:  white;
		padding:  20px;
		font-size:  16px;
	}
</style>