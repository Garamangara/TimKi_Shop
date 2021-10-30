<?php
namespace TimKi\Shop\Console\Command;

use TimKi\Shop\Api\CompanyRepositoryInterface;
use TimKi\Shop\Model\Company;
use TimKi\Shop\Model\CompanyFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DeploySampleDataCommand
 * @package TimKi\Shop\Console\Command
 */
class DeploySampleDataCommand extends Command
{
    /**#@+
     * @var string
     */
    const DEFAULT_NUMBER_OF_RECORDS = 3;
    const ARGUMENT_NUMBER_OF_RECORDS = 'number_of_records';
    /**#@-*/

    /**
     * @var CompanyFactory
     */
    private $companyFactory;

    /**
     * @var CompanyRepositoryInterface
     */
    private $companyRepository;

    /**
     * @param CompanyFactory $companyFactory
     * @param CompanyRepositoryInterface $companyRepository
     */
    public function __construct(
        CompanyFactory $companyFactory,
        CompanyRepositoryInterface $companyRepository
    ) {
        parent::__construct();
        $this->companyFactory = $companyFactory;
        $this->companyRepository = $companyRepository;
    }

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('timki:shop:deploy_sample_data')
            ->setDescription('shop: deploy sample data')
            ->setDefinition([
                new InputArgument(
                    self::ARGUMENT_NUMBER_OF_RECORDS,
                    InputArgument::OPTIONAL,
                    'Number of test records'
                ),
            ])
        ;
        parent::configure();
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $records = $input->getArgument(self::ARGUMENT_NUMBER_OF_RECORDS) ?: self::DEFAULT_NUMBER_OF_RECORDS;
        for ($i = 1; $i <= (int)$records; $i++) {
            /** @var Company $company */
            $company = $this->companyFactory->create();
            $company->setDescription('test content ' . $i);
            $company->setTitle('test title ' . $i);
            $this->companyRepository->save($company);
            if ($output->getVerbosity() > 1) {
                $output->writeln('<info>Company with the ID #' . $company->getId() . ' has been created.</info>');
            }
        }
    }
}
