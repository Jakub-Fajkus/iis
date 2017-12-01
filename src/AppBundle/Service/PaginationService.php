<?php
/**
 * Created by PhpStorm.
 * User: rockuo
 * Date: 1.12.17
 * Time: 11:42
 */

namespace AppBundle\Service;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PaginationService
 * @package AppBundle\Service
 */
class PaginationService
{

    const PAGE_SIZE = 10;

    private $lastPage;

    /**
     * @param array $all
     * @param int $page
     * @param string $elementsKey
     * @return array
     */
    public function handlePageWithPagination(array $all, int $page, string $elementsKey = 'elements')
    {
        if ($page < 1) {
            $this->lastPage = 1;
            return ['redirectPage' => 1];
        }

        $offset = ($page - 1) * self::PAGE_SIZE;
        $count = \count($all);
        if ($count === 0) {
            return [
                $elementsKey => [],
                'pages' => 1,
                'page' => 1
            ];
        }

        if ($offset >= $count) {
            $this->lastPage = \ceil($count / self::PAGE_SIZE);
            return ['redirectPage' => $this->lastPage];
        }
        $length = self::PAGE_SIZE;
        if ($offset + $length > $count) {
            $length = null;
        }

        return [
            $elementsKey => \array_slice($all, $offset, $length),
            'pages' => \ceil($count / self::PAGE_SIZE),
            'page' => $page
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getRedirectParams(Request $request)
    {
        $parameters = $request->query->all();
        $parameters['page'] = $this->lastPage;
        return $parameters;
    }
}
