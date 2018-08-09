<?php

namespace Modules\Oldcpsk\Repositories\Cache;

use Modules\Oldcpsk\Repositories\StudentRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheStudentDecorator extends BaseCacheDecorator implements StudentRepository
{
    public function __construct(StudentRepository $student)
    {
        parent::__construct();
        $this->entityName = 'oldcpsk.students';
        $this->repository = $student;
    }
}
