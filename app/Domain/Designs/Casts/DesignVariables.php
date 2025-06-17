<?php

namespace DDD\Domain\Designs\Casts;
define('DEFAULT_BTN_BORDER_W', 2);
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class DesignVariables implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        $value = isset($value) ? json_decode($value, true) : [];
        
        $defaults = [
            // Colors
            'color_white' => '#ffffff',
            'color_black' => '#404040',
            'color_primary' => '#404040',
            'color_accent' => '#16e09a',
            'color_brand_alternate_1'=>null,
            'color_brand_alternate_2'=>null,
            'color_contrast_high' => '#404040',
            'color_contrast_higher' => '#404040',
            'color_background' => '#ffffff',

            'pretitle_size' => 'sm',
            'pretitle_color' => null,
            'pretitle_transform' => 'none',
            'pretitle_letter_spacing' => 0,

            'h1_size' => 'xxl',
            'h1_color' => null,
            'h1_color_bg_1' => null,
            'h1_color_bg_2' => null,
            'h1_transform' => 'none',
            'h1_letter_spacing' => 0,

            'h2_size' => 'xl',
            'h2_color' => null,
            'h2_color_bg_1' => null,
            'h2_color_bg_2' => null,
            'h2_transform' => 'none',
            'h2_letter_spacing' => 0,

            'h3_size' => 'lg',
            'h3_color' => null,
            'h3_color_bg_1' => null,
            'h3_color_bg_2' => null,
            'h3_transform' => 'none',
            'h3_letter_spacing' => 0,

            'h4_size' => 'md',
            'h4_color' => null,
            'h4_color_bg_1' => null,
            'h4_color_bg_2' => null,
            'h4_transform' => 'none',
            'h4_letter_spacing' => 0,

            'h5_size' => 'normal',
            'h5_color' => null,
            'h5_color_bg_1' => null,
            'h5_color_bg_2' => null,
            'h5_transform' => 'none',
            'h5_letter_spacing' => 0,

            // Base text
            'text_base_size' => '1.3',

            // Primary font
            'font_primary' => [
                'source' => null,
                'name' => null,
                'url' => null,
                'weight' => '400',
            ],

            // Secondary font
            'font_secondary' => [
                'source' => null,
                'name' => null,
                'url' => null,
                'weight' => '400',
            ],

            // Buttons font
            'font_buttons' => [
                'source' => null,
                'name' => null,
                'url' => null,
                'weight' => '400',
            ],

            // Buttons text colors
            'btn_primary_text_color' => null,
            'btn_primary_bg_color' => null,
            'btn_primary_hover_text_color' => null,
            'btn_primary_hover_bg_color' => null,

            'btn_primary_border_top_width' => DEFAULT_BTN_BORDER_W,
            'btn_primary_hover_border_top_width' => DEFAULT_BTN_BORDER_W,
            'btn_primary_border_right_width' => DEFAULT_BTN_BORDER_W,
            'btn_primary_hover_border_right_width' => DEFAULT_BTN_BORDER_W,
            'btn_primary_border_bottom_width' => DEFAULT_BTN_BORDER_W,
            'btn_primary_hover_border_bottom_width' => DEFAULT_BTN_BORDER_W,
            'btn_primary_border_left_width' => DEFAULT_BTN_BORDER_W,
            'btn_primary_hover_border_left_width' => DEFAULT_BTN_BORDER_W,

            'btn_primary_border_top_color' => 'transparent',
            'btn_primary_hover_border_top_color' => 'transparent',
            'btn_primary_border_right_color' => 'transparent',
            'btn_primary_hover_border_right_color' => 'transparent',
            'btn_primary_border_bottom_color' => 'transparent',
            'btn_primary_hover_border_bottom_color' => 'transparent',
            'btn_primary_border_left_color' => 'transparent',
            'btn_primary_hover_border_left_color' => 'transparent',
            
            // Secondary buttons
            'btn_secondary_text_color' => null,
            'btn_secondary_hover_text_color' => null,
            'btn_secondary_bg_color' => null,
            'btn_secondary_hover_bg_color' => null,

            'btn_secondary_border_top_width' => DEFAULT_BTN_BORDER_W,
            'btn_secondary_hover_border_top_width' => DEFAULT_BTN_BORDER_W,
            'btn_secondary_border_right_width' => DEFAULT_BTN_BORDER_W,
            'btn_secondary_hover_border_right_width' => DEFAULT_BTN_BORDER_W,
            'btn_secondary_border_bottom_width' => DEFAULT_BTN_BORDER_W,
            'btn_secondary_hover_border_bottom_width' => DEFAULT_BTN_BORDER_W,
            'btn_secondary_border_left_width' => DEFAULT_BTN_BORDER_W,
            'btn_secondary_hover_border_left_width' => DEFAULT_BTN_BORDER_W,

            'btn_secondary_border_top_color' => 'transparent',
            'btn_secondary_hover_border_top_color' => 'transparent',
            'btn_secondary_border_right_color' => 'transparent',
            'btn_secondary_hover_border_right_color' => 'transparent',
            'btn_secondary_border_bottom_color' => 'transparent',
            'btn_secondary_hover_border_bottom_color' => 'transparent',
            'btn_secondary_border_left_color' => 'transparent',
            'btn_secondary_hover_border_left_color' => 'transparent',

            // Tertiary buttons
            'btn_tertiary_text_color' => null,
            'btn_tertiary_hover_text_color' => null,
            'btn_tertiary_bg_color'=>null,
            'btn_tertiary_hover_bg_color'=>null,

            'btn_tertiary_border_top_width' => DEFAULT_BTN_BORDER_W,
            'btn_tertiary_hover_border_top_width' => DEFAULT_BTN_BORDER_W,
            'btn_tertiary_border_right_width' => DEFAULT_BTN_BORDER_W,
            'btn_tertiary_hover_border_right_width' => DEFAULT_BTN_BORDER_W,
            'btn_tertiary_border_bottom_width' => DEFAULT_BTN_BORDER_W,
            'btn_tertiary_hover_border_bottom_width' => DEFAULT_BTN_BORDER_W,
            'btn_tertiary_border_left_width' => DEFAULT_BTN_BORDER_W,
            'btn_tertiary_hover_border_left_width' => DEFAULT_BTN_BORDER_W,

            'btn_tertiary_border_top_color' => 'transparent',
            'btn_tertiary_hover_border_top_color' => 'transparent',
            'btn_tertiary_border_right_color' => 'transparent',
            'btn_tertiary_hover_border_right_color' => 'transparent',
            'btn_tertiary_border_bottom_color' => 'transparent',
            'btn_tertiary_hover_border_bottom_color' => 'transparent',
            'btn_tertiary_border_left_color' => 'transparent',
            'btn_tertiary_hover_border_left_color' => 'transparent',


            // Buttons styles
            'btn_adjust_borders' => false,
            'btn_padding_y' => '0.5',
            'btn_padding_x' => '0.75',
            'btn_radius' => '0.25',
            'btn_text_transform' => 'none',
            'btn_letter_spacing' => '0',
        ];

        return array_merge($defaults, $value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if (isset($value)) {
            return json_encode($value);
        }
    }
}
