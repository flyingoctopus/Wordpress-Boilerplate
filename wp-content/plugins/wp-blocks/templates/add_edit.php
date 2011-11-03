<div class="wrap">
<div id="icon-edit" class="icon32"></div>
<?php if(isset($_GET['block_id'])): ?>
<h2>Edit Content Block '<?php echo($data['name']); ?>'</h2>	
<?php else: ?>
<h2>Add Content Block</h2>
<?php endif; ?>
<a href="?page=wpb-admin" class="blocks-list">&larr; View Blocks List</a>
<?php if(isset($data['message'])): ?>
<div id="message" class="updated">
<p><?php echo($data['message']); ?></p>
</div><?php endif; ?>
<?php if(isset($data['error'])): ?>
<div id="message" class="error">
<p><?php echo($data['error']); ?></p>
</div><?php endif; ?>
<form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="add_edit">
<div class="formwrap">
	<label for="name">Content Block Name:</label>
	<input name="name" size="30" tabindex="1" value="<?php echo($data['name']); ?>" id="name" autocomplete="off" type="text" />
</div>
<!-- the_editor($content, $id  = 'content', $prev_id  = 'title', $media_buttons  = true, $tab_index  = 2)  -->
<div id="poststuff">
	<div id="<?php echo user_can_richedit() ? 'postdivrich' : 'postdiv'; ?>" class="postarea"><?php the_editor(stripslashes($data['content']),'content','content', TRUE, 3); ?></div>
</div>
<div class="formwrap block"> 
	<label for="html_prepend">HTML Prepend <em>(code to be displayed before your content block)</em>:</label>
	<textarea name="html_prepend" rows="3" cols="60"><?php echo(htmlspecialchars(wp_kses_stripslashes($data['html_prepend']))); ?></textarea>
</div>
<div class="formwrap block">
	<label for="html_append">HTML Append: <em>(code to be displayed after your content block)</em></label>
	<textarea name="html_append" rows="3" cols="60"><?php echo(htmlspecialchars(wp_kses_stripslashes($data['html_append']))); ?></textarea>
</div>
<div class="formwrap">
	<label for="name">Display Block on Site:</label>
	<?php WPBlocks::active_dropdown_options($_POST); ?>
</div>
<input type="hidden" name="wpb_hidden" value="Y">
<input type='submit' value='Save Content Block' class='button-secondary' />
</form>
</div>