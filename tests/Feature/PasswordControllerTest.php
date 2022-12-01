<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class PasswordControllerTest extends TestCase
{
    public function test_password_with_all_conditions_should_pass()
    {
        $query = [
            "password" => "#Alt123#"
        ];

        $response = $this->post(
            route('verify.password'), $query
        );

        $response->assertStatus(Response::HTTP_OK)->assertJson([
            'verify' => true,
            'noMatch' => []
        ]);
    }

    public function test_password_without_lowercase_letter_should_not_pass()
    {
        $query = [
            "password" => "#ALTO123#"
        ];

        $response = $this->post(
            route('verify.password'), $query
        );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)->assertJson([
            'verify' => false,
            'noMatch' => [
                'password' => [
                    0 => 'The password must contain at least one lowercase letter.'
                ]
            ]
        ]);
    }

    public function test_password_without_uppercase_letter_should_not_pass()
    {
        $query = [
            "password" => "#alto123#"
        ];

        $response = $this->post(
            route('verify.password'), $query
        );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)->assertJson([
            'verify' => false,
            'noMatch' => [
                'password' => [
                    0 => 'The password must contain at least one uppercase letter.'
                ]
            ]
        ]);
    }

    public function test_password_without_special_character_should_not_pass()
    {
        $query = [
            "password" => "Altos123"
        ];

        $response = $this->post(
            route('verify.password'), $query
        );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)->assertJson([
            'verify' => false,
            'noMatch' => [
                'password' => [
                    0 => 'The password must contain at least one symbol.'
                ]
            ]
        ]);
    }

    public function test_password_without_digits_should_not_pass()
    {
        $query = [
            "password" => "#Altura#"
        ];

        $response = $this->post(
            route('verify.password'), $query
        );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)->assertJson([
            'verify' => false,
            'noMatch' => [
                'password' => [
                    0 => 'The password must contain at least one number.'
                ]
            ]
        ]);
    }

    public function test_password_with_repeated_characters_should_not_pass()
    {
        $query = [
            "password" => "#Altoo123#"
        ];

        $response = $this->post(
            route('verify.password'), $query
        );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)->assertJson([
            'verify' => false,
            'noMatch' => [
                'password' => [
                    0 => 'The password must not contain two repeated characters in sequence.'
                ]
            ]
        ]);
    }
}
