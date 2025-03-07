<?php

/**
 * Handles 'address' custom field type.
 */
class CMB2_Render_Address_Field extends CMB2_Type_Base {

	/**
	 * List of states. To translate, pass array of states in the 'state_list' field param.
	 *
	 * @var array
	 */
	protected static $state_list = array( 'AL' => 'Alabama', 'AK' => 'Alaska', 'AZ' => 'Arizona', 'AR' => 'Arkansas', 'CA' => 'California', 'CO' => 'Colorado', 'CT' => 'Connecticut', 'DE' => 'Delaware', 'DC' => 'District Of Columbia', 'FL' => 'Florida', 'GA' => 'Georgia', 'HI' => 'Hawaii', 'ID' => 'Idaho', 'IL' => 'Illinois', 'IN' => 'Indiana', 'IA' => 'Iowa', 'KS' => 'Kansas', 'KY' => 'Kentucky', 'LA' => 'Louisiana', 'ME' => 'Maine', 'MD' => 'Maryland', 'MA' => 'Massachusetts', 'MI' => 'Michigan', 'MN' => 'Minnesota', 'MS' => 'Mississippi', 'MO' => 'Missouri', 'MT' => 'Montana', 'NE' => 'Nebraska', 'NV' => 'Nevada', 'NH' => 'New Hampshire', 'NJ' => 'New Jersey', 'NM' => 'New Mexico', 'NY' => 'New York', 'NC' => 'North Carolina', 'ND' => 'North Dakota', 'OH' => 'Ohio', 'OK' => 'Oklahoma', 'OR' => 'Oregon', 'PA' => 'Pennsylvania', 'RI' => 'Rhode Island', 'SC' => 'South Carolina', 'SD' => 'South Dakota', 'TN' => 'Tennessee', 'TX' => 'Texas', 'UT' => 'Utah', 'VT' => 'Vermont', 'VA' => 'Virginia', 'WA' => 'Washington', 'WV' => 'West Virginia', 'WI' => 'Wisconsin', 'WY' => 'Wyoming' );

	public static function init() {
		add_filter( 'cmb2_render_class_address', array( __CLASS__, 'class_name' ) );
		add_filter( 'cmb2_sanitize_address', array( __CLASS__, 'maybe_save_split_values' ), 12, 4 );

		/**
		 * The following snippets are required for allowing the address field
		 * to work as a repeatable field, or in a repeatable group.
		 */
		add_filter( 'cmb2_sanitize_address', array( __CLASS__, 'sanitize' ), 10, 5 );
		add_filter( 'cmb2_types_esc_address', array( __CLASS__, 'escape' ), 10, 4 );
		add_filter( 'cmb2_override_meta_value', array( __CLASS__, 'get_split_meta_value' ), 12, 4 );
	}

	public static function class_name() { return __CLASS__; }

	/**
	 * Handles outputting the address field.
	 */
	public function render() {

		// make sure we assign each part of the value we need.
		$value = wp_parse_args( $this->field->escaped_value(), array(
			'title' => '',
			'link' => '',

		) );

		

		

		ob_start();
		// Do html.
		?>
		<div><p><label for="<?php echo $this->_id( '_title_', false ); ?>"><?php echo esc_html( $this->_text( 'download_title__text', 'عنوان دکمه' ) ); ?></label></p>
			<?php echo $this->types->input( array(
				'name'  => $this->_name( '[title]' ),
				'id'    => $this->_id( '_title_' ),
				'value' => $value['title'],
				'desc'  => '',
			) ); ?>
		</div>
		<div><p><label for="<?php echo $this->_id( '_link_', false ); ?>'"><?php echo esc_html( $this->_text( 'download_link__text', 'لینک دکمه' ) ); ?></label></p>
			<?php echo $this->types->input( array(
				'name'  => $this->_name( '[link]' ),
				'id'    => $this->_id( '_link_' ),
				'value' => $value['link'],
				'desc'  => '',
			) ); ?>
		</div>
		
		
		<p class="clear">
			<?php echo $this->_desc();?>
		</p>
		<?php

		// grab the data from the output buffer.
		return $this->rendered( ob_get_clean() );
	}

	/**
	 * Optionally save the Address values into separate fields
	 */
	public static function maybe_save_split_values( $override_value, $value, $object_id, $field_args ) {
		if ( ! isset( $field_args['split_values'] ) || ! $field_args['split_values'] ) {
			// Don't do the override.
			return $override_value;
		}

		$address_keys = array( 'title', 'link', 'city', 'state', 'zip' );

		foreach ( $address_keys as $key ) {
			if ( ! empty( $value[ $key ] ) ) {
				update_post_meta( $object_id, $field_args['id'] . 'addr_' . $key, sanitize_text_field( $value[ $key ] ) );
			}
		}

		remove_filter( 'cmb2_sanitize_address', array( __CLASS__, 'sanitize' ), 10, 5 );

		// Tell CMB2 we already did the update.
		return true;
	}

	public static function sanitize( $check, $meta_value, $object_id, $field_args, $sanitize_object ) {

		// if not repeatable, bail out.
		if ( ! is_array( $meta_value ) || ! $field_args['repeatable'] ) {
			return $check;
		}

		foreach ( $meta_value as $key => $val ) {
			$meta_value[ $key ] = array_filter( array_map( 'sanitize_text_field', $val ) );
		}

		return array_filter( $meta_value );
	}

	public static function escape( $check, $meta_value, $field_args, $field_object ) {
		// if not repeatable, bail out.
		if ( ! is_array( $meta_value ) || ! $field_args['repeatable'] ) {
			return $check;
		}

		foreach ( $meta_value as $key => $val ) {
			$meta_value[ $key ] = array_filter( array_map( 'esc_attr', $val ) );
		}

		return array_filter( $meta_value );
	}

	public static function get_split_meta_value( $data, $object_id, $field_args, $field ) {
		if ( 'address' !== $field->args['type'] ) {
			return $data;
		}
		if ( ! isset( $field->args['split_values'] ) || ! $field->args['split_values'] ) {
			// Don't do the override.
			return $data;
		}

		$prefix = $field->args['id'] . 'addr_';
		// Construct an array to iterate to fetch individual meta values for our override.
		// Should match the values in the render() method.
		$metakeys = array(
			'title',
			'link',

		);

		$newdata = array();
		foreach ( $metakeys as $metakey ) {
			// Use our prefix to construct the whole meta key from the postmeta table.
			$newdata[ $metakey ] = get_post_meta( $object_id, $prefix . $metakey, true );
		}

		return $newdata;
	}
}