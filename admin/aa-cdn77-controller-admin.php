<?php
/*
Plugin Name: 2ACES BP Profile Widget
Plugin URI: http://2aces.com.br
Description: A simple widget to show buddypress profile, avatar, trophies and social links
Author: Celso Bessa / 2ACES
Version: 1
Author URI: http://2aces.com.br
*/
/**
 * Adds Foo_Widget widget.
 */
class AA_BP_Profile_Widget extends WP_Widget {
	
public function fs_truncate($content,$length) {
        // rather than just use substr, let's make sure we cut it at the end of a word
        $arr = explode(' ', $content);
        $out = '';
        $count = 0;
        foreach( $arr as $str ){
            $count += ( strlen($str) + 1); // +1 is for the space we removed
            if ($count > $this->length)
                break;
            $out .= $str . ' ';
        }
        // make sure we got SOMEthing
        if (!$out) {
            $out = $arr[0];
        } 
        $out = trim($out);
        return $out;
    }	
	

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'aa_bp_profile_widget', // Base ID
			'2ACES Buddpress Profile', // Name
			array( 'description' => __( '2ACES Buddypress Profile and Social', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		if(is_single() && !is_singular('achievement')){
			global $post;
			$user_id = $post->post_author;
			$user_profile_url = esc_url( bp_core_get_user_domain( $user_id ) );
			$user_posts_url = esc_url( get_author_posts_url( $user_id ) );
		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;?>
<section class="post-meta">
	<section class="user-info">
		<a href="<?php echo $user_profile_url; ?>" rel="author" class="avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 50 ); ?></a>
		<p class="meta">P&aacute;gina criada por <strong><a href="<?php echo $user_profile_url; ?>" rel="author"><?php echo the_author_meta('display_name', $user_id); ?></a></strong></p>
		<p class="meta clearfix">P&aacute;ginas criadas: <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="author-pages badge"><strong><?php echo count_user_posts($user_id); ?></strong></a></p>
		<p class="user-bio clearfix"><?php if ( get_the_author_meta('description') ) : the_author_meta( 'description', $user_id ); endif; ?></p>
	</section>
	<section class="social-share clearfix">
		<p>
			<span class='st_plusone'></span>
			<span class='st_twitter'></span>
			<span class='st_pinterest'></span>
			<span class='st_delicious'></span>
			<span class='st_fblike'></span>&nbsp;<a href="#respond" class='btn btn-paqt btn-mini' displayText='Comente este post' id="btn-comments"><?php comments_number( 'coment&aacute;rios' , '1 coment&aacute;rio' , '% coment&aacute;rios' ); ?></a>
		</p>
	</section><!-- / Sidebar's .social-share -->
	<!--<p class="create clearfix">Participe e ganhe tamb&eacute;m! <a href="http://paqt.com.br/#featurette-2" class="btn btn-paqt btn-mini btn-info">Saiba mais</a></p>-->
</section><!-- / Sidebar's .post-meta -->
			<?php
		echo $after_widget;
		};
	}
} // class Foo_Widget
// register Foo_Widget widget
add_action( 'widgets_init', create_function( '', 'register_widget( "aa_bp_profile_widget" );' ) );
?>