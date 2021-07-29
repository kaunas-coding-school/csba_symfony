<?php

namespace App\Command;

use App\Manager\OrderManager;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'orders:archive',
    description: 'Change order state from completed to archive',
)]
class OrdersArchiveCommand extends Command
{
    public function __construct(private OrderManager $orderManager)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption('period', ['-p'], InputOption::VALUE_OPTIONAL, 'Senesni uzsakymai negu nurodytas dienu skaicius', 365)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $period = $input->getOption('period');

        $io->success("Select orders after $period days.");

        $orders = $this->orderManager->getOldOrders($period);
        $this->orderManager->archiveOrders($orders);

        return Command::SUCCESS;
    }
}
