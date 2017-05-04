<?php

namespace Projet\StatisfootBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class joueurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomJ', TextType::class)
            ->add('prenomJ', TextType::class)
            ->add('dateNaiss', DateType::class)
            ->add('poste', EntityType::class, array(
                'class' => 'ProjetStatisfootBundle:poste',
                'choice_label' => 'libellePoste'))
            ->add('Enregistrer', SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Projet\StatisfootBundle\Entity\joueur'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'projet_statisfootbundle_joueur';
    }


}
