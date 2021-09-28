<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\Form\Type\CollectionType;;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Sonata\MediaBundle\Provider\Pool;

final class CandidateAdmin extends AbstractAdmin
{
    /**
     * @var Pool
     */
    protected $pool;

    protected $classnameLabel = 'Candidate';

    /**
     * @param string $code
     * @param string $class
     * @param string $baseControllerName
     */
    public function __construct($code, $class, $baseControllerName, Pool $pool)
    {
        parent::__construct($code, $class, $baseControllerName);

        $this->pool = $pool;
    }
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $context = $this->getPersistentParameter('context');
        if (!$context) {
            $context = $this->pool->getDefaultContext();
        }
        $formMapper->add('firstname', TextType::class)
        ->add('lastname', TextType::class)
        ->add('sex', ChoiceType::class, [
            'choices' => [
                'Male' => 'male',
                'Female' => "female",
            ],
        ])
        ->add('numero', IntegerType::class)
        ->add('coverImage', ModelListType::class, array(), array('link_parameters' => array(
            'context' => 'widgets',
            'provider' => 'sonata.media.provider.image'
        )))
        ->add('candidateHasMedias', CollectionType::class, [], [
            'edit' => 'inline',
            'inline' => 'table',
            'sortable' => 'position',
            'link_parameters' => ['context' => 'widgets'],
            'admin_code' => 'admin.candidates_has_media',
        ]
        );

        
    
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('firstname');
        $datagridMapper->add('lastname');
        $datagridMapper->add('numero');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('firstname');
        $listMapper->addIdentifier('lastname');
        $listMapper->addIdentifier('sex');
        $listMapper->addIdentifier('numero');
       
    }
    /*public function prePersist($object)
    {

        // fix weird bug with setter object not being call
        $object->setCandidateHasMedias($object->getCandidateHasMedias());
        parent::prePersist($object);
    }*/

    public function prePersist($candidate)
    {
        $parameters = $this->getPersistentParameters();

        //$candidate->setContext($parameters['context']);
    }
    public function postUpdate($candidate)
    {
        $candidate->reorderGalleryHasMedia();
    }
    public function getPersistentParameters()
    {
        $parameters = parent::getPersistentParameters();

        if (!$this->hasRequest()) {
            return $parameters;
        }

        return array_merge($parameters, [
            'context' => $this->getRequest()->get('context', $this->pool->getDefaultContext()),
        ]);
    }
    public function getNewInstance()
    {
        $candidate = parent::getNewInstance();

        if ($this->hasRequest()) {
           // $candidate->setContext($this->getRequest()->get('context'));
        }

        return $candidate;
    }


    

}