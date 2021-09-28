<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\Form\Type\BooleanType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class CandidateHasMediaAdmin extends AbstractAdmin
{
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $link_parameters = [];

        if ($this->hasParentFieldDescription()) {
            $link_parameters = $this->getParentFieldDescription()->getOption('link_parameters', array());
            
        }

        if ($this->hasRequest()) {
            $context = $this->getRequest()->get('context', null);

            if (null !== $context) {
                $link_parameters['context'] = $context;
            }
        }

        $formMapper
           
            ->add('media', ModelListType::class, array('required' => false), array(
                'link_parameters' => $link_parameters
            ))
            ->add('enabled', null, ['required' => false])
            ->add('position', HiddenType::class)
        ;
    }

    
    protected function configureListFields(ListMapper $listMapper)
    {
        
        $listMapper
        ->add('media')
        ->add('position')
        ->add('enabled')
        ;
    }


}
