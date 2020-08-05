<?php
/**
 * @package Hello_Dolly
 * @version 1.6
 */
/*
Plugin Name: Hello Bob Marley
Plugin URI: http://wordpress.org/extend/plugins/hello-dolly/
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
Author: Matt Mullenweg
Version: 1.6
Author URI: http://ma.tt/
*/

function hello_dolly_get_lyric() {
	/** These are the lyrics to Hello Dolly */
	$lyrics = "Ooh, yeah
	Well, alright
	We're jammin'
	Sing it, I want to jam it with you
	We're jammin', we're jammin'
	And I hope you like jammin' too
	Ain't no rules, ain't no vow
	You can do it anyhow
	'Cause I and I will see you through
	But every day we pay the price
	Come a little sacrifice
	Jammin' 'til the jam is through
	Ooh yeah, we're jammin', hey
	To think that jammin' was a thing of the past
	We're jammin', we're jammin'
	And I hope this jam is gonna last
	No bullet can stop us now, we neither beg nor we won't bow
	Neither can be bought nor sold
	We all defend the right, Jah-Jah children must unite
	'Cause life is worth much more than gold
	Ooh yeah, we're jammin'
	And we're jammin' in the name of the Lord
	We're jammin', we're jammin'
	And we're jammin' right straight from yard
	Ay
	Holy…";

	// Here we split it into lines
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function hello_dolly() {
	$chosen = hello_dolly_get_lyric();
	echo "<p id='dolly'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'hello_dolly' );

// We need some CSS to position the paragraph
function dolly_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#dolly {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', 'dolly_css' );

?>