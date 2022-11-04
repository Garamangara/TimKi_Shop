<?php

namespace TimKi\Shop\Console;

use Magento\Framework\Console\Cli;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Laminas\Soap\Client;
use Laminas\Server\Client as ServerClient;
use Laminas\Soap\Client\Common;
use Magento\Framework\ObjectManagerInterface;

class SoapExecuteExample extends Command
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName('apitraining:soapexecute')
            ->setDescription(__('Quick data import with memory and flexible settings'))
            ->setDefinition($this->getCommandOptions());

        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $statusCode = Cli::RETURN_FAILURE;

        $wsdlUrl = "https://www.w3schools.com/xml/tempconvert.asmx?WSDL";
        try {
            $params = array('Celsius' => '25');

            $soapClient = new Client($wsdlUrl);
            $soapClient->setSoapVersion(SOAP_1_2);
        } catch (\Exception $e) {
            echo 'Error1 : '.$e->getMessage();
        }

        try {
            $response = $soapClient->CelsiusToFahrenheit($params);
            var_dump($response);
        } catch (\Exception $e) {
            echo 'Error2 : ' . $e->getMessage();
        }

        return $statusCode;
    }

    /**
     * @return array
     */
    public function getCommandOptions()
    {
        return [

        ];
    }
}
