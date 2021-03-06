<?php
defined('ABSPATH') or die('No direct script access allowed.');

if (!class_exists('Editorial_Metadata_Input_User_Handler')) {
    require_once 'editorial-metadata-input-handler.php';

    class Editorial_Metadata_Input_User_Handler extends Editorial_Metadata_Input_Handler
    {
        /**
         * Class constructor that defines input type.
         *
         * @since   @todo
         */
        public function __construct()
        {
            $this->type = 'user';
        }

        /**
         * Render input html.
         *
         * @access  protected
         * @since   @todo
         *
         * @param   array   $inputOptions   Input options
         * @param   mixed   $value          Actual input value
         */
        protected function renderInput($inputOptions = array(), $value = null)
        {
            $input_name = isset($inputOptions['name']) ? $inputOptions['name'] : '';
            $input_label = isset($inputOptions['label']) ? $inputOptions['label'] : '';
            $input_description = isset($inputOptions['description']) ? $inputOptions['description'] : '';

            self::renderLabel(
                $input_label . self::generateDescriptionHtml($input_description),
                $input_name
            );

            $user_dropdown_args = [
                'show_option_all' => self::getOptionShowAll(),
                'name'            => $input_name,
                'selected'        => $value,
            ];

            $user_dropdown_args = apply_filters('pp_editorial_metadata_user_dropdown_args', $user_dropdown_args);
            wp_dropdown_users($user_dropdown_args);
        }

        /**
         * Return "Show All" option label.
         *
         * @static
         * @access  protected
         *
         * @return  string
         */
        protected static function getOptionShowAll()
        {
            return __('-- Select a user --', 'publishpress');
        }

        /**
         * Render input-preview html.
         *
         * @access  protected
         * @since   @todo
         *
         * @param   array   $inputOptions   Input options
         * @param   mixed   $value          Actual input value
         */
        protected function renderInputPreview($inputOptions = array(), $value = null)
        {
            $input_name = isset($inputOptions['name']) ? $inputOptions['name'] : '';
            $input_label = isset($inputOptions['label']) ? $inputOptions['label'] : '';
            $input_description = isset($inputOptions['description']) ? $inputOptions['description'] : '';

            self::renderLabel(
                $input_label . self::generateDescriptionHtml($input_description),
                $input_name
            );

            $user = get_user_by('ID', $value);
            if (is_object($user)) {
                printf(
                    '<span class="pp_editorial_metadata_value">%s</span>',
                    $user->user_nicename
                );
            } else {
                self::renderValuePlaceholder();
            }

            printf(
                '<input
                    type="hidden"
                    id="%s"
                    name="%1$s"
                    value="%2$s"
                />',
                $input_name,
                $value
            );
        }

        /**
         * Get meta-input value html formatted.
         *
         * @static
         * @since   @todo
         *
         * @param   mixed   $value  Actual input value
         *
         * @return  string
         */
        public static function getMetaValueHtml($value = null)
        {
            if (empty($value)) {
                return '';
            }

            $user = get_user_by('id', (int)$value);
            if (!is_object($user)) {
                return '';
            }

            return esc_html($user->display_name);
        }
    }
}
