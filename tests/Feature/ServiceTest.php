<?php

use DDD\Domain\Base\Users\User;

// it('has service page', function () {
//     $response = $this->getJson(route('google.connect'))
//             ->assertOk()
//             ->json();

//         // $this->assertEquals('http://localhost', $respdonse['url']);
//         $this->assertNotNull($response['url']);
// });

test('can connect to google', function () {
    $user = User::factory()->create();
    
    $this->actingAs($user)
        ->get('/api/google/connect')
        ->assertStatus(200);
        
});
