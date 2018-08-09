<?php

namespace Modules\Colorgenerator\Repositories\Cache;

use Modules\Colorgenerator\Repositories\StudentRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheStudentDecorator extends BaseCacheDecorator implements StudentRepository
{
    public function __construct(StudentRepository $student)
    {
        parent::__construct();
        $this->entityName = 'colorgenerator.students';
        $this->repository = $student;
    }
}
