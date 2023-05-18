<?php

namespace Tests\Feature\Repositories;

use App\Repositories\ProgramStudiRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProgramStudiRepositoryTest extends TestCase
{
    protected ProgramStudiRepository $repo;
    protected function setUp():void
    {
        parent::setUp();
        $this->repo = \App::make(ProgramStudiRepository::class);
    }
    public function test_getDosenProdi(): void
    {
        // self::assertTrue(true);
        $result = $this->repo->getDosenProdi(1);
        self::assertNotEmpty($result, 'Data Kosong');
    }
}
