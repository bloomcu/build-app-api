<?php

namespace DDD\Domain\Designs\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DesignUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'designer_name' => 'nullable|string',
            'designer_email' => 'nullable|email',
            'variables' => 'nullable|array',

            // Colors
            'variables.color_white' => 'nullable|string',
            'variables.color_black' => 'nullable|string',
            'variables.color_primary' => 'nullable|string',
            'variables.color_accent' => 'nullable|string',
            'variables.color_brand_alternate_1'=>'nullable|string',
            'variables.color_brand_alternate_2'=>'nullable|string',
            'variables.color_contrast_high' => 'nullable|string',
            'variables.color_contrast_higher' => 'nullable|string',
            'variables.color_background' => 'nullable|string',

            // Pre-title
            'variables.pretitle_size' => 'nullable|string',
            'variables.pretitle_color' => 'nullable|string',
            'variables.pretitle_transform' => 'nullable|string',
            'variables.pretitle_letter_spacing' => 'nullable|decimal:0,2',

            'variables.h1_size' => 'nullable|string',
            'variables.h1_color' => 'nullable|string',
            'variables.h1_transform' => 'nullable|string',
            'variables.h1_letter_spacing' => 'nullable|decimal:0,2',

            'variables.h2_size' => 'nullable|string',
            'variables.h2_color' => 'nullable|string',
            'variables.h2_transform' => 'nullable|string',
            'variables.h2_letter_spacing' => 'nullable|decimal:0,2',

            'variables.h3_size' => 'nullable|string',
            'variables.h3_color' => 'nullable|string',
            'variables.h3_transform' => 'nullable|string',
            'variables.h3_letter_spacing' => 'nullable|decimal:0,2',

            'variables.h4_size' => 'nullable|string',
            'variables.h4_color' => 'nullable|string',
            'variables.h4_transform' => 'nullable|string',
            'variables.h4_letter_spacing' => 'nullable|decimal:0,2',

            'variables.h5_size' => 'nullable|string',
            'variables.h5_color' => 'nullable|string',
            'variables.h5_transform' => 'nullable|string',
            'variables.h5_letter_spacing' => 'nullable|decimal:0,2',

            // Base text
            'variables.text_base_size' => 'nullable|string',

            // Primary font
            'variables.font_primary' => 'nullable|array',
            'variables.font_primary.source' => 'nullable|string',
            'variables.font_primary.name' => 'nullable|string',
            'variables.font_primary.url' => 'nullable|string',
            'variables.font_primary.weight' => 'nullable|string',

            // Secondary font
            'variables.font_secondary' => 'nullable|array',
            'variables.font_secondary.source' => 'nullable|string',
            'variables.font_secondary.name' => 'nullable|string',
            'variables.font_secondary.url' => 'nullable|string',
            'variables.font_secondary.weight' => 'nullable|string',

            // Buttons font
            'variables.font_buttons' => 'nullable|array',
            'variables.font_buttons.source' => 'nullable|string',
            'variables.font_buttons.name' => 'nullable|string',
            'variables.font_buttons.url' => 'nullable|string',
            'variables.font_buttons.weight' => 'nullable|string',

            // Buttons text colors
            'variables.btn_primary_text_color' => 'nullable|string',
            'variables.btn_secondary_text_color' => 'nullable|string',
            'variables.btn_tertiary_text_color' => 'nullable|string',
            
            // Buttons BG colors
            'variables.btn_primary_bg_color' => 'nullable|string',
            'variables.btn_secondary_bg_color' => 'nullable|string',
            'variables.btn_tertiary_bg_color' => 'nullable|string',
            
            // Buttons border styles
            'variables.btn_primary_border_top_width' => 'nullable|numeric',
            'variables.btn_primary_border_right_width' => 'nullable|numeric',
            'variables.btn_primary_border_bottom_width' => 'nullable|numeric',
            'variables.btn_primary_border_left_width' => 'nullable|numeric',

            'variables.btn_primary_border_top_color' => 'nullable|string',
            'variables.btn_primary_border_right_color' => 'nullable|string',
            'variables.btn_primary_border_bottom_color' => 'nullable|string',
            'variables.btn_primary_border_left_color' => 'nullable|string',

            'variables.btn_secondary_border_top_width' => 'nullable|numeric',
            'variables.btn_secondary_border_right_width' => 'nullable|numeric',
            'variables.btn_secondary_border_bottom_width' => 'nullable|numeric',
            'variables.btn_secondary_border_left_width' => 'nullable|numeric',

            'variables.btn_secondary_border_top_color' => 'nullable|string',
            'variables.btn_secondary_border_right_color' => 'nullable|string',
            'variables.btn_secondary_border_bottom_color' => 'nullable|string',
            'variables.btn_secondary_border_left_color' => 'nullable|string',

            'variables.btn_tertiary_border_top_width' => 'nullable|numeric',
            'variables.btn_tertiary_border_right_width' => 'nullable|numeric',
            'variables.btn_tertiary_border_bottom_width' => 'nullable|numeric',
            'variables.btn_tertiary_border_left_width' => 'nullable|numeric',

            'variables.btn_tertiary_border_top_color' => 'nullable|string',
            'variables.btn_tertiary_border_right_color' => 'nullable|string',
            'variables.btn_tertiary_border_bottom_color' => 'nullable|string',
            'variables.btn_tertiary_border_left_color' => 'nullable|string',



            // Buttons style
            'variables.btn_adjust_borders'=>'boolean',

            'variables.btn_padding_y' => 'nullable|string',
            'variables.btn_padding_x' => 'nullable|string',
            'variables.btn_radius' => 'nullable|string',
            'variables.btn_text_transform' => 'nullable|string',
            'variables.btn_letter_spacing' => 'nullable|string',
        ];
    }

    /**
     * Return exception as json
     *
     * @return Exception
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors()
        ], 422));
    }
}
