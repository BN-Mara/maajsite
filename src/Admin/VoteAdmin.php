<?php

namespace App\Admin;

use App\Entity\Candidate;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

final class VoteAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        
        $formMapper->add('candidate',EntityType::class,[
            // looks for choices from this entity
            'class' => Candidate::class,
        
            // uses the User.username property as the visible option string
            'choice_label' => 'firstname',
        
            // used to render a select box, check boxes or radios
            // 'multiple' => true,
            // 'expanded' => true,
        ]);
        $formMapper->add('creation_date', DateTimeType::class);
        $formMapper->add('subscription', EntityType::class,[
            // looks for choices from this entity
            'class' => Subscription::class,
        
            // uses the User.username property as the visible option string
            'choice_label' => 'firstname',
        
            // used to render a select box, check boxes or radios
            // 'multiple' => true,
            // 'expanded' => true,
        ]);
        $formMapper->add('numberOfVote', NumberType::class);
             
    
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('candidate.firstname');
        $datagridMapper->add('creation_date');
        $datagridMapper->add('subscription.firstname');
        $datagridMapper->add('numberOfVote');

        
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('candidate.firstname');
        $listMapper->addIdentifier('creation_date');
        $listMapper->addIdentifier('subscription.firstname');
        $listMapper->addIdentifier('numberOfVote');
    }
}