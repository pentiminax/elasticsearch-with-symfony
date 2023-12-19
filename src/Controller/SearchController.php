<?php

namespace App\Controller;

use App\Entity\Course;
use App\Form\Model\SearchModel;
use App\Form\Type\SearchFormType;
use Elastica\Query\BoolQuery;
use Elastica\Query\MatchPhrase;
use Elastica\Query\MatchQuery;
use Elastica\Query\MultiMatch;
use Elastica\Query\Range;
use Elastica\Query\Term;
use FOS\ElasticaBundle\Finder\PaginatedFinderInterface;
use FOS\ElasticaBundle\Manager\RepositoryManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    public function __construct(
        private readonly PaginatedFinderInterface $finder
    ) {
    }

    #[Route('/search', name: 'app_search')]
    public function index(Request $request, RepositoryManagerInterface $repositoryManager): Response
    {
        $form = $this->createForm(SearchFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $q = $request->query->get('query');
            $createdThisMonth = $request->query->getBoolean('createdThisMonth');

            $boolQuery = new BoolQuery();

            $boolQuery->addShould(new MatchPhrase('title', $q));
            $boolQuery->addShould(new MatchPhrase('category.title', $q));

            if ($createdThisMonth) {
                $rangeQuery = new Range('createdAt', ['gte' => (new \DateTimeImmutable('-1 month'))->format('Y-m-d')]);
                $boolQuery->addFilter($rangeQuery);
            }

            /** @var Course[] $results */
            $results = $this->finder->find($boolQuery);
        }

        return $this->render('search/index.html.twig', [
            'form' => $form->createView(),
            'query' => $q ?? '',
            'results' => $results ?? [],
        ]);
    }
}
