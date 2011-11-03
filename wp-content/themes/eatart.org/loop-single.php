<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post();  ?>

	<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
		<header>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<time class="updated" datetime="<?php the_time('c'); ?>" pubdate>Posted on <?php the_time('l, F jS, Y') ?> at <?php the_time() ?>.</time>
			<?php if (get_option('roots_post_author') == 'checked') { ?>
			<p class="byline author vcard">
				Written by <span class="fn"><?php the_author(); ?></span>
			</p>
			<?php } ?>
			<?php if (get_option('roots_post_tweet') == 'checked') { ?>
			<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
			<?php } ?>
		</header>
		<div class="entry-content">
			<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>
		</div>
		<footer>
			<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>' )); ?>
			<p><?php the_tags(); ?></p>
		</footer>
		<?php comments_template(); ?>
	</article>

<?php endwhile; // End the loop ?>

