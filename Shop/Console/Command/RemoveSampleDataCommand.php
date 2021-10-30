<?php
namespace TimKi\Shop\Console\Command;

use TimKi\Shop\Model\ResourceModel\Company as CompanyResource;
use Magento\Framework\App\ResourceConnection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class RemoveSampleDataCommand
 * @package TimKi\Shop\Console\Command
 */
class RemoveSampleDataCommand extends Command
{
    /**
     * @var ResourceConnection
     */
    private $resourceConnection;

    /**
     * @param ResourceConnection $resourceConnection
     */
    public function __construct(
        ResourceConnection $resourceConnection
    ) {
        parent::__construct();
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('timki:shop:remove_sample_data')
            ->setDescription('shop: remove sample data')
        ;
        parent::configure();
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $connection = $this->resourceConnection->getConnection();
        $connection->truncateTable($connection->getTableName(CompanyResource::TABLE_NAME));
        if ($output->getVerbosity() > 1) {
            $output->writeln('<info>Sample data has been successfully removed.</info>');
        }
    }
}
