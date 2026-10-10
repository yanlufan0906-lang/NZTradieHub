<?php

namespace Tests\Feature;

use Tests\TestCase;

class ResponsiveFormTypographyTest extends TestCase
{
    public function test_mobile_form_controls_keep_safe_text_size_with_smaller_placeholders(): void
    {
        $css = file_get_contents(public_path('css/responsive-typography.css'));

        $this->assertIsString($css);
        $this->assertStringContainsString('.service-request-form .form-field input::placeholder', $css);
        $this->assertStringContainsString('.filter-box input::placeholder', $css);
        $this->assertStringContainsString('select option[value=""]', $css);
        $this->assertStringContainsString('select:has(option[value=""]:checked)', $css);
        $this->assertStringContainsString('select:focus', $css);
        $this->assertMatchesRegularExpression('/font-size:\s*14px;/', $css);
        $this->assertMatchesRegularExpression('/\.filter-box\s+:is\(input,\s*select\).*?font-size:\s*16px;/s', $css);
    }
}
