<?php

namespace Tests\Unit;

use Tests\TestCase;

class ApiTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */

    private $headers;

    public function __construct(string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $encoded_details = base64_encode('admin@infromane.com:1234567');
        $this->headers =  [
            'HTTP_Authorization' => 'Basic '. $encoded_details
        ];
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_api_post()
    {
        $response = $this->withHeaders($this->headers)->postJson('api/store-post',['title' => 'test title','text'=>'test text']);

        $response->assertStatus(200);
    }

    public function test_api_patch()
    {
        $response = $this->withHeaders($this->headers)->patchJson('api/update-post/3',['title' => '12 yeah','text'=>'12 text']);

        $response->assertJson([

                'post'=>['title' => '12 yeah']

        ])->assertStatus(200);
    }

    public function test_api_delete()
    {
        $response = $this->withHeaders($this->headers)->deleteJson('api/delete-post/3');

        $response->assertJson(['result'=>'deleting success'])->assertStatus(200);
    }

    public function test_api_get_all()
    {
        $response = $this->withHeaders($this->headers)->getJson('/api/view-posts');

        $response->assertStatus(200);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_api_get()
    {
        $response = $this->withHeaders($this->headers)->getJson('api/view-post/4');

        $response->assertJson(['id'=>'4','title' => '12 yeah'])->assertStatus(200);
    }
}
