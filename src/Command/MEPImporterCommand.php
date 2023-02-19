<?php

namespace App\Command;

use App\Entity\MEP;
use App\Repository\MEPRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:mep:import',
    description: 'Add a short description for your command',
)]
class MEPImporterCommand extends Command
{
    const FILE_URL = "https://www.europarl.europa.eu/meps/en/full-list/xml/a";

    /**
     * @var MEPRepository
     */
    private MEPRepository $MEPRepository;

    public function __construct(MEPRepository $MEPRepository)
    {
        $this->MEPRepository = $MEPRepository;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $xmlData = simplexml_load_file(self::FILE_URL);
        if (!$xmlData) {
            $io->error("Error in the file data!");
            return Command::FAILURE;
        }

        foreach ($xmlData as $element){
            $mep = new MEP();
            $mep->setFullName((string)$element->fullName);
            $mep->setCountry((string)$element->country);
            $mep->setIdNumber((int)$element->id);
            $mep->setNationalPoliticalGroup((string)$element->nationalPoliticalGroup);
            $mep->setPoliticalGroup((string)$element->politicalGroup);
            $this->MEPRepository->save($mep, true);
        }
        $io->success("File imported successfully!");

        return Command::SUCCESS;
    }
}
