<?php
namespace Sizuhiko\Phpkansai2017\Task\PrintTask;

trait loadTasks
{
  protected function taskPrint($message = null)
  {
    return $this->task(PrintTask::class, $message);
  }
}

class PrintTask extends \Robo\Task\BaseTask implements \Robo\Contract\RollbackInterface
{
  protected $message;
  protected $fail = false;

  function __construct($message)
  {
    $this->message = $message;
  }

  function reject()
  {
    $this->fail = true;
    return $this;
  }

  function run()
  {
    if ($this->fail) {
      return \Robo\Result::error($this, $this->message.' は失敗した');
    } else {
      $this->printTaskSuccess($this->message.' は成功した');
      return \Robo\Result::success($this);
    }
  }

  function rollback() {
    $this->printTaskInfo($this->message.' をロールバックした');
  }
}