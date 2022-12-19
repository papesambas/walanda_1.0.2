<?php

namespace App\Test\Controller;

use App\Entity\Contrats;
use App\Repository\ContratsRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContratsControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ContratsRepository $repository;
    private string $path = '/contrats/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Contrats::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Contrat index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'contrat[designation]' => 'Testing',
            'contrat[slug]' => 'Testing',
            'contrat[type]' => 'Testing',
            'contrat[remuneration]' => 'Testing',
            'contrat[dateDebut]' => 'Testing',
            'contrat[dateFin]' => 'Testing',
            'contrat[motiFinContrat]' => 'Testing',
            'contrat[createdAt]' => 'Testing',
            'contrat[updatedAt]' => 'Testing',
            'contrat[etablissement]' => 'Testing',
            'contrat[personnel]' => 'Testing',
        ]);

        self::assertResponseRedirects('/contrats/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Contrats();
        $fixture->setDesignation('My Title');
        $fixture->setSlug('My Title');
        $fixture->setType('My Title');
        $fixture->setRemuneration('My Title');
        $fixture->setDateDebut('My Title');
        $fixture->setDateFin('My Title');
        $fixture->setMotiFinContrat('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setEtablissement('My Title');
        $fixture->setPersonnel('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Contrat');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Contrats();
        $fixture->setDesignation('My Title');
        $fixture->setSlug('My Title');
        $fixture->setType('My Title');
        $fixture->setRemuneration('My Title');
        $fixture->setDateDebut('My Title');
        $fixture->setDateFin('My Title');
        $fixture->setMotiFinContrat('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setEtablissement('My Title');
        $fixture->setPersonnel('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'contrat[designation]' => 'Something New',
            'contrat[slug]' => 'Something New',
            'contrat[type]' => 'Something New',
            'contrat[remuneration]' => 'Something New',
            'contrat[dateDebut]' => 'Something New',
            'contrat[dateFin]' => 'Something New',
            'contrat[motiFinContrat]' => 'Something New',
            'contrat[createdAt]' => 'Something New',
            'contrat[updatedAt]' => 'Something New',
            'contrat[etablissement]' => 'Something New',
            'contrat[personnel]' => 'Something New',
        ]);

        self::assertResponseRedirects('/contrats/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDesignation());
        self::assertSame('Something New', $fixture[0]->getSlug());
        self::assertSame('Something New', $fixture[0]->getType());
        self::assertSame('Something New', $fixture[0]->getRemuneration());
        self::assertSame('Something New', $fixture[0]->getDateDebut());
        self::assertSame('Something New', $fixture[0]->getDateFin());
        self::assertSame('Something New', $fixture[0]->getMotiFinContrat());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getUpdatedAt());
        self::assertSame('Something New', $fixture[0]->getEtablissement());
        self::assertSame('Something New', $fixture[0]->getPersonnel());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Contrats();
        $fixture->setDesignation('My Title');
        $fixture->setSlug('My Title');
        $fixture->setType('My Title');
        $fixture->setRemuneration('My Title');
        $fixture->setDateDebut('My Title');
        $fixture->setDateFin('My Title');
        $fixture->setMotiFinContrat('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setEtablissement('My Title');
        $fixture->setPersonnel('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/contrats/');
    }
}
