<?php

namespace AbsenceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AbsenceParClasseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('classe', EntityType::class, array(
                'class' => 'AbsenceBundle:Classe',
                'choice_label' => 'nom'
            ))
            ->remove('date', DateType::class)
            ->remove('nb_vacation', IntegerType::class)
            ->remove('etudiant', EntityType::class, array(
                'class' => 'AbsenceBundle:Etudiant',
                'choice_label' => 'nom'
            ))
            ->remove("Valider", SubmitType::class)

        ;
        $builder
            ->add("Valider", SubmitType::class);
    }

    public function getParent()
    {
        return AbsenceType::class;
    }
}
