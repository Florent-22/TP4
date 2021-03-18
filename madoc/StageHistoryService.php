<?php
namespace App\Service;

use App\Entity\Stage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class StageHistoryService
{
    private const MAX = 3;

    /** @var SessionInterface */
    private $session;

    /** @var EntityManagerInterface */
    private $em;

    /**
     * @param SessionInterface $session
     * @param EntityManagerInterface $em
     */
    public function __construct(SessionInterface $session, EntityManagerInterface $em)
    {
        $this->session = $session;
        $this->em = $em;
    }

    /**
     * @param Stage $stage
     *
     * @return void
     */
    public function addStage(Stage $stage) : void
    {

        $stages = $this->getStagesIds();

        // Ajoute l'identifiant d'un stage au début du tableau
        array_unshift($stages, $stage->getId());
        dump($stages);

        // supprimer les id. redondants
        $stages = array_unique($stages);

        // Garder uniquement 3 elements
        $stages = array_slice($stages, 0, self::MAX);
        // Sauvegarder les ids dans la session
        $this->session->set('stage_history', $stages);
    }

    /**
     * @return array
     */
    private function getStagesIds() : array
    {
        return $this->session->get('stage_history', []);
    }

    /**
     * @return Stage[]
     */
    public function getStages() : array
    {
        $jobs = [];
        $jobRepository = $this->em->getRepository(Stage::class);
        dump($this->getStagesIds());
        foreach ($this->getStagesIds() as $stageId) {
            $jobs[] = $jobRepository->find($stageId);
        }

        return array_filter($jobs);
    }
}
