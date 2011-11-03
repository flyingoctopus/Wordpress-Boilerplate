
		<table class="widefat" style="width: 99%;">
	
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
					
					<td style="padding:10px"><?php echo($block->updated_at);?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>