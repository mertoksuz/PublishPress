<?php
/**
 * @package     PublishPress\Notifications
 * @author      PressShack <help@pressshack.com>
 * @copyright   Copyright (C) 2017 PressShack. All rights reserved.
 * @license     GPLv2 or later
 * @since       1.0.0
 */

namespace PublishPress\Notifications\Traits;

trait Metadata {
	/**
	 * Returns the metadata of the current post.
	 *
	 * @param string  $meta_key
	 * @param bool    $single
	 * @return mixed
	 */
	public function get_metadata( $meta_key, $single = false ) {
		global $post;

		return get_post_meta( $post->ID, $meta_key, $single );
	}

	/**
	 * Deletes the metadata for the current post. If not single, set the value.
	 *
	 * @param string  $meta_key
	 * @param mixed   $meta_value
	 * @return mixed
	 */
	public function delete_metadata( $meta_key, $meta_value = '', $id = null ) {
		global $post;

		if ( empty( $id ) ) {
			$id = $post->ID;
		}

		return delete_post_meta( $id, $meta_key, $meta_value );
	}

	/**
	 * Updates the metadata for the current post using an array as input.
	 *
	 * @param int     $post_id
	 * @param string  $meta_key
	 * @param array   $meta_value
	 * @param bool    $all_if_empty
	 */
	public function update_metadata_array( $post_id, $meta_key, $meta_value = [], $all_if_empty = false ) {
		// Cleanup the metadata
		$this->delete_metadata( $meta_key );

		if ( empty( $meta_value ) ) {
			if ( $all_if_empty ) {
				// Make sure we have the 'all' value
				add_post_meta( $post_id, $meta_key, 'all' );
			}
		} else {
			foreach ( $meta_value as $value ) {
				add_post_meta( $post_id, $meta_key, $value );
			}
		}
	}
}