<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
require_once '../../vendor/autoload.php';
class RoboFile extends \Robo\Tasks
{
    // define public methods as commands
    use \Codeception\Task\MergeReports;
    use \Codeception\Task\SplitTestsByGroups;

    public function parallelSplitTests()
    {
    	// Split your tests by files
        /*$this->taskSplitTestFilesByGroups(2)
            ->projectRoot('.')
            ->testsFrom('tests/acceptance')
             ->groupsTo('tests/_data/paracept_')
            ->run();*/


        
        // Split your tests by single tests (alternatively)
        $this->taskSplitTestsByGroups(5)
            ->projectRoot('.')
            ->testsFrom('tests/acceptance')
            ->groupsTo('tests/_data/paracept_')
            ->run();
        
    }

    public function parallelRun()
    {
    	$parallel = $this->taskParallelExec();
    for ($i = 1; $i <= 2; $i++) {
        $parallel->process(
            $this->taskCodecept() // use built-in Codecept task
            ->suite('acceptance') // run acceptance tests
            ->env("env_$i")//env("env_$i") 
           /* ->env('firefox')*/
            ->group("paracept_$i") // for all paracept_* groups
            ->xml("TestResult/result_$i.xml") // save XML results
        );


    }
    return $parallel->run();
    }

    public function parallelMergeResults()
    {
    /*	$merge = $this->taskMergexmlReports();
        for ($i=1; $i<=2; $i++) {
            $merge->from("TestResult/result_$i.xml");
        }
        $merge->into("TestResult/result.xml")->run();*/
        $this->taskMergeHtmlReports()
    ->from('tests/result/result_1.html')
    ->from('tests/result/result_2.html')
    ->into('tests/result/merged.html')
    ->run();
    }
  public  function parallelAll()
    {
        $this->parallelSplitTests();
        $result = $this->parallelRun();
        $this->parallelMergeResults();
        return $result;
    }
}