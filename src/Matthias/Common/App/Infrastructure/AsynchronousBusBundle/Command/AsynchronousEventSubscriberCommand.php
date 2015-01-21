<?php


namespace Matthias\Common\App\Infrastructure\AsynchronousBusBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AsynchronousEventSubscriberCommand extends ContainerAwareCommand
{
	const MAX_EXECUTION_TIME = 60; // secs. Max execution time allowed.
	const MAX_ITER = 30; // Max num interactions. To avoid possible infinite loop.
	const DELAY_BETWEEN_ITERS = 2; // secs.
	
	private $debug = true;
	private $maxIter = self::MAX_ITER;

    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setName('matthias:asyn-bus:asyn-event-subscriber')
            ->setDescription('Asynchronous event subscriber. It obtains events from message queue and inject them in the asynchronous event bus.')
            /*->setDefinition(array(
            		new InputArgument('username', InputArgument::REQUIRED, 'The username'),
            		new InputArgument('password', InputArgument::REQUIRED, 'The password'),
            ))*/
            ->addOption(
            		'debug',
            		null,
            		InputOption::VALUE_NONE,
            		'If set, the task will be run in debug mode'
            )                        
            ->setHelp(<<<EOT
The <info>matthias:asyn-bus:asyn-event-subscriber</info> command pulls events from a message queue:

  <info>php app/console matthias:asyn-bus:asyn-event-subscriber --debug</info>
EOT
            );
    }

    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	$output->writeln(sprintf('Pulling events from message queue ...'));

    	if ($input->getOption('debug')) {
    		// Debug mode
    		$this->debug = true;
    		$this->maxIter = 1;
    	}
    	    	
    	$startTime = time();
    	$endLimitTime = $startTime + self::MAX_EXECUTION_TIME;
    	$iter = 1;
    	$comment = '';
    	
    	$output->writeln(sprintf('Start time: %s',$startTime));

		/** @var \Matthias\Common\App\MessageQueue\MessageQueue $messageQueue */
		$messageQueue = $this->getContainer()->get('matthias_common_app_infrastructure_common.message_queue');

        /** @var \SimpleBus\Message\Bus\MessageBus $asynchronousEventBus */
        $asynchronousEventBus = $this->getContainer()->get('asynchronous_event_bus');
		
    	// crontab min interval is 1 minute. In order to pull API more often the same command execution
    	// will be running until the next command will be executed.
    	while (($iter++ <= $this->maxIter) && (time() < $endLimitTime)) {
    		
    		$output->writeln(sprintf('Starting iter %s ...', (string)$iter-1));
    	
			$message = $messageQueue->consume();

            if ( $message != null) {

                //var_dump($message);

                $output->writeln(sprintf('Message: %s', var_export($message,true)));

                $asynchronousEventBus->handle($message);
            }

	    	$output->writeln(sprintf('End iter %s', (string)$iter-1));
	    	
	    	sleep(self::DELAY_BETWEEN_ITERS);
	    	
    	} // End while
    	
    	$endTime = time();
    	
    	$output->writeln(sprintf('End time: %s Start time: %s Duration: %s secs',$endTime, $startTime, $endTime-$startTime));

        $output->writeln(sprintf('Sync finished. <comment>%s</comment>', $comment));
    }

    /**
     * @see Command
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        /*if (!$input->getArgument('username')) {
            $username = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a username: ',
                function($username) {
                    if (empty($username)) {
                        throw new \Exception('Username can not be empty');
                    }

                    return $username;
                }
            );
            $input->setArgument('username', $username);
        }

        if (!$input->getArgument('password')) {
        	$dialog = $this->getHelperSet()->get('dialog');
        	$password = $dialog->askHiddenResponse($output, 'Please choose a password: ');
        	        	
			if (empty($password)) {
				throw new \Exception('Password can not be empty');
        	}
        	$input->setArgument('password', $password);
        }*/
    }
}
