<?php

declare(strict_types=1);

namespace App\Console;

use App\Auth\Entity\User\Email;
use App\Auth\Entity\User\Token;
use App\Auth\Service\JoinConfirmationSender;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;
use Swift_Mailer;
use Swift_SmtpTransport;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MailerCheckCommand extends Command
{
    public function __construct(private readonly JoinConfirmationSender $sender)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('mailer:check');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<comment>Sending...</comment>');

        $this->sender->send(
            new Email('user@app.test'),
            new Token(Uuid::uuid4()->toString(), new DateTimeImmutable())
        );

        $output->writeln('<info>Done!</info>');

        return 0;
    }
}