<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class MarkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject', ChoiceType::class, [
                'choices'  => [
                    'mark.french' => 'french',
                    'mark.math' => 'math',
                    'mark.english' => 'english',
                    'mark.spanish' => 'spanish',
                    'mark.biology' => 'biology',
                    'mark.chemistry' => 'chemistry',
                    'mark.physics' => 'physics',
                    'mark.physical education' => 'physical education',
                    'mark.art' => 'art',
                ],
            ])
            ->add('value')
            ->add('save', SubmitType::class)
        ;
    }
}