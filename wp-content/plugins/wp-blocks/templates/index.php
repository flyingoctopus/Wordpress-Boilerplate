<div class="wrap">
	<div id="icon-edit" class="icon32"></div>
	<h2>WP-Blocks</h2>
	<br />
	<a href="?page=wpb-admin&action=block_add" class="button add-new-h2" id="add-block">Add New Content Block</a>
	<?php if (isset($message)): ?><br /><div id="message" class="updated"><p><?php echo($message); ?>. <a href="?page=carsonifeed">Dismiss.</a></p></div><?php endif; ?>
</div>
<br /><br />
		<table class="widefat" style="width: 99%;">
		<thead>
			<tr>
				<th width="20%">Name</th>
				<th  width="10%" style="text-align: center;">Show on Site</th>
				<th width="50%">Template Code Snippet</th>
				<th width="20%">Last Updated</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>Name</th>
				<th style="text-align: center;">Show on Site</th>
				<th>Template Code Snippet</th>
				<th>Last Updated</th>
			</tr>
		</tfoot>		
		<tbody>
			<?php $i = 0; foreach($data['blocks'] as $block): $i++; $alternate = (($i % 2) == 0) ? '' : ' alternate'; ?>
				<tr class="active<?php echo($alternate); ?>">
					<td style="padding:10px">
						<strong><a href="?page=wpb-admin&action=block_edit&block_id=<?php echo($block->id); ?>" title="Edit this item"><?php echo($block->name); ?></a></strong>
						<div class="row-actions">
							<span class='edit'><a href="?page=wpb-admin&action=block_edit&block_id=<?php echo($block->id); ?>" title="Edit this item">Edit Block</a> | </span>
							<span class='trash'><a href="?page=wpb-admin&action=block_delete&block_id=<?php echo($block->id); ?>" class='submitdelete wp-block-delete' title="Delete block '<?php echo($block->name); ?>'" >Delete Block</a>
						</div>		
					</td>
					<td style="padding:10px; text-align: center;"><?php echo (($block->active == 1) ? 'Yes' : 'No'); ?></td>
					<td style="padding:10px"><input name="name" size="50" tabindex="1" value="&lt;?php get_wp_block('<?php echo($block->name); ?>'); ?&gt;" id="name" autocomplete="off" type="text" class="wp-code-snippet"/></td>						
					<td style="padding:10px"><?php echo($block->updated_at);?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<p class="version">WP-Blocks Version 1.4 by <a href="http://keirwhitaker.com/?ref=wp-blocks-plugin">Keir Whitaker</a>. Please <a href="mailto:keir+wpblocks@keirwhitaker?subject=wpblocks-beta-feedback">email me</a> for help and feedback.</p>
</div>