<?php

namespace Modules\Firstyearinfo\Repositories\Cache;

use Modules\Firstyearinfo\Repositories\StudentRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheStudentDecorator extends BaseCacheDecorator implements StudentRepository
{
    public function __construct(StudentRepository $student)
    {
        parent::__construct();
        $this->entityName = 'firstyearinfo.students';
        $this->repository = $student;
    }
}
