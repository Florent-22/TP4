<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Stopwatch\Stopwatch;

class AddUserCommand extends Command
{
    protected static $defaultName = 'add:user';

    private $entityManager;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        parent::__construct();

        $this->entityManager = $em;
        $this->passwordEncoder = $encoder;
    }

    protected function configure()
    {
        $this
            ->setDescription('Créer un nouveau utilisateur dans la base de données')
            ->setHelp($this->getCommandHelp())
            ->addArgument('email', InputArgument::REQUIRED, "L'email de l'utilisateur")
            ->addArgument('password', InputArgument::REQUIRED, "Le mot de passe")
            ->addOption('admin', null, InputOption::VALUE_NONE, "Cette option, si présente, définit un nouveau utilisateur comme administrateur")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $io = new SymfonyStyle($input, $output);

        $stopwatch = new Stopwatch();
        $stopwatch->start('add-user-command');

        $plainPassword = $input->getArgument('password');
        $email = $input->getArgument('email');
        $isAdmin = $input->getOption('admin');

        // create the user and encode its password
        $user = new User();
        $user->setEmail($email);
        $user->setRoles([$isAdmin ? 'ROLE_ADMIN' : 'ROLE_USER']);
        $encodedPassword = $this->passwordEncoder->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $io->success(sprintf('%s was successfully created: %s ', $isAdmin ? 'Administrator user' : 'User', $user->getEmail()));

        $event = $stopwatch->stop('add-user-command');
        if ($output->isVerbose()) {
            $io->comment(sprintf('New user database id: %d / Elapsed time: %.2f ms / Consumed memory: %.2f MB', $user->getId(), $event->getDuration(), $event->getMemory() / (1024 ** 2)));
        }
    }

    private function getCommandHelp(): string
    {
        return <<<'HELP'
La commande  <info>%command.name%</info> crée un nouveau utilisateur dans la base de données:

  <info>php %command.full_name%</info> <comment>email password</comment>

Par défaut, la commande crée un utilisateur avec rôle ROLE_USER. Pour créer un administrateur,
Ajouter l'option <comment>--admin</comment> :

  <info>php %command.full_name%</info> email password  <comment>--admin</comment>
HELP;
    }
}
