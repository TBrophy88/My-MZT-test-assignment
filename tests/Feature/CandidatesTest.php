<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CandidatesTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCandidatesPageLoads()
    {
        $response = $this->get('/candidates');

        $response->assertStatus(200);
    }

    /**
     * Tests that the candidates and wallet data loads correctly
     *
     * @return void
     */
    public function testCandidatesAndWalletDataLoads()
    {
        $this
            ->get('/candidates-list')
            ->assertSuccessful()
            ->assertJsonCount(2);
    }

    /**
     * Tests that the candidate contact feature updates candidates' contacted status
     *
     * @return void
     */
    public function testCandidateContactWorks()
    {
        $candidateID = 1;

        $response = $this->call('POST', '/candidates-contact', array(
            'candidateID' => $candidateID
        ));

        $response->assertStatus(200);

        $data = $response->decodeResponseJson();
        $this->assertTrue($data[0][$candidateID - 1]['contacted']);
    }

    /**
     * Tests that the candidate contact feature deducts 5 coins from the wallet
     *
     * @return void
     */
    public function testCandidateContactDeductsCoins()
    {
        $candidateID = 1;

        $response = $this->call('POST', '/candidates-contact', array(
            'candidateID' => $candidateID
        ));

        $response->assertStatus(200);

        $data = $response->decodeResponseJson();
        $this->assertEquals(15, $data[1]['coins']);
    }

    /**
     * Tests that the candidate hire does not work if candidate is not yet contacted
     *
     * @return void
     */
    public function testCandidateHireFailsWithoutContact()
    {
        $candidateID = 1;

        $response = $this->call('POST', '/candidates-hire', array(
            'candidateID' => $candidateID
        ));

        $response->assertStatus(200);

        $data = $response->decodeResponseJson();
        $this->assertEquals(0, $data[0][$candidateID - 1]['hired']);
    }

    /**
     * Tests that the candidate hire feature updates candidates' hired status
     *
     * @return void
     */
    public function testCandidateHireWorksAfterContact()
    {
        $candidateID = 1;

        $response = $this->call('POST', '/candidates-contact', array(
            'candidateID' => $candidateID
        ));
        $response = $this->call('POST', '/candidates-hire', array(
            'candidateID' => $candidateID
        ));

        $response->assertStatus(200);

        $data = $response->decodeResponseJson();
        $this->assertTrue($data[0][$candidateID - 1]['hired']);
    }

    /**
     * Tests that the candidate hire feature adds coins
     *
     * @return void
     */
    public function testCandidateHireAddsCoins()
    {
        $candidateID = 1;

        $response = $this->call('POST', '/candidates-contact', array(
            'candidateID' => $candidateID
        ));
        $response = $this->call('POST', '/candidates-hire', array(
            'candidateID' => $candidateID
        ));

        $response->assertStatus(200);

        $data = $response->decodeResponseJson();
        $this->assertEquals(20, $data[1]['coins']);
    }
}
