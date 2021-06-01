<?php

namespace App\Form;

use App\Entity\Candidate;
use App\Entity\Vote;
use App\Entity\VoteMode;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numberOfVote',EntityType::class,[
                'class' => VoteMode::class,
                'choice_label' => 'description',
                'label'=> "Select artist",
                'attr' => ['class' => 'sign__input']
            ])
            ->add('candidate', EntityType::class,[
                'class' => Candidate::class,
                'choice_label' => 'firstname',
                'label'=> "Select artist",
                'attr' => ['class' => 'sign__input']
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vote::class,
        ]);
    }
}
